<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\TransactionDetail;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Transaction extends Component
{
    public $products;
    public $productSearch;
    public $productSold;
    public $orderList = [];
    public $name;
    public $fee;
    public $visitors;
    public $paymentMethod;
    public $reservation;
    public $optionMethod;
    public $optionReservation;
    public $some;
    public $query;
    protected $listeners = ["payment" => "payment"];

    public function mount()
    {
        $this->optionReservation = [
            ['title' => 'take away', 'value' => 'take away'],
            ['title' => 'dine in', 'value' => 'dine in'],
        ];
        $this->reservation = 'take away';
        $this->paymentMethod = 1;
        $this->optionMethod = eloquent_to_options(PaymentMethod::get(), 'id', 'title');
        $this->products = Product::where('product_status_id', 1)->orderBy('product_type_id')->get();
        $this->productSold = Product::where('product_status_id', 3)->orderBy('product_type_id')->get();
    }

    public function add($product)
    {
        if (isset($this->orderList[$product])) {
            $this->orderList[$product] += 1;
        } else {
            $this->orderList[$product] = 1;
        }
    }

    public function decreaseOrderList($id)
    {
        if (isset($this->orderList[$id])) {
            $this->orderList[$id] -= 1;
            if ($this->orderList[$id] == 0) {
                unset($this->orderList[$id]);
            }
        }
    }

    public function increaseOrderList($id)
    {
        $this->orderList[$id] += 1;
    }

    public function render()
    {
        $this->production();
        return view('livewire.transaction');
    }

    public function production()
    {
        $query = $this->query;
        if (empty($query)) {
            $this->productSearch = $this->products;
        } else {
            $this->productSearch = $this->products->filter(function ($item) use ($query) {
                return false !== stristr($item->title, $query);
            });
        }
    }

    public function cancel()
    {
        $this->orderList = [];
        $this->name = '';
        $this->reservation = 'dine in';
        $this->paymentMethod = 1;
        $this->visitors = 1;
    }

    public function feeOnChange($value)
    {
        $this->fee = $value;
    }

    public function methodOnChange($value)
    {
        $this->paymentMethod = $value;
    }

    public function reservationOnChange($value)
    {
        $this->reservation = $value;
    }

    public function proses()
    {
        if ($this->name == null) {
            $this->name = 'guest';
        }
        if ($this->visitors == null or $this->visitors == 0) {
            $this->visitors = 1;
        }
        $total = 0;
        $discount = 0;
        foreach ($this->orderList as $order => $value) {
            if ($this->products->find($order)->discount_state) {
                $total += $this->products->find($order)->discount_price * $value;
                $discount += ($this->products->find($order)->price - $this->products->find($order)->discount_price) * $value;
            } else {
                $total += $this->products->find($order)->price * $value;
            }
        }
        $this->emit('swal:confirm', ['title' => 'Periksa kembali',
            'icon' => 'info',
            'confirmText' => 'Proses',
            'text' => 'pesanan atas nama : ' . $this->name . '<br>total : Rp.' . number_format($total) . '<br>total potongan : Rp.' . number_format($discount) . '<br>jumlah pengunjung : ' . $this->visitors,
            'method' => 'payment']);
    }

    public function payment()
    {
        $transaction = \App\Models\Transaction::create([
            'name' => $this->name,
            'transaction_code' => \App\Models\Transaction::getCode(),
            'user_id' => auth()->id(),
            'status_order_id' => 1,
            'payment_method_id' => $this->paymentMethod,
            'reservation' => $this->reservation,
            'visitors' => $this->visitors,
            'fee' => $this->fee
        ]);
        foreach ($this->orderList as $order => $value) {
            $product = Product::find($order);
            if ($product->discount_state) {
                TransactionDetail::create([
                    'product_id' => $order,
                    'transaction_id' => $transaction->id,
                    'price' => Product::find($order)->discount_price,
                    'amount' => $value
                ]);

            } else {
                TransactionDetail::create([
                    'product_id' => $order,
                    'transaction_id' => $transaction->id,
                    'price' => Product::find($order)->price,
                    'amount' => $value
                ]);
            }
        }
        $this->orderList = [];
        $this->name = '';
        $this->reservation = 'take away';
        $this->paymentMethod = 1;
        $this->visitors = null;
        $this->fee = null;
        $this->emit('notify', [
            'type' => 'primary',
            'title' => $transaction->transaction_code . " dalam waiting list",
        ]);
        $this->emitTo('transaction-active-notification', 'refresh');
        $url = route('admin.transaction.struck', $transaction->id);
        $this->emit('redirect:new', $url);
//        $this->some= "<script>window.open('".$url."', '_blank')</script>";
//        return redirect(route('admin.transaction.struck',$transaction->id));
    }
}
