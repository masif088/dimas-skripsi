<div class="row second-chart-list third-news-update">
    <div class="col-lg-12 col-sm-12">
        <div class="row second-chart-list third-news-update">
            <div class="col-sm-4 col-xl-4 col-lg-6">
                <x-simple-card icon="dollar-sign" value="{{number_format($data['amount'])}}" title="Produk Terjual"
                               color="bg-primary"/>
            </div>
            <div class="col-sm-4 col-xl-4 col-lg-6">
                <x-simple-card icon="dollar-sign" value="{{number_format($data['total'])}}" title="Omzet"
                               color="bg-danger"/>
            </div>
            <div class="col-sm-4 col-xl-4 col-lg-6">
                <x-simple-card icon="dollar-sign" value="{{number_format($data['transaction'])}}" title="Transaksi"
                               color="bg-secondary"/>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr style="font-weight: bold">
                            <td>Metode Pembayaran</td>
                            <td>Total</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($money as $key=>$ma)
                            <tr>
                                <td>{{ \App\Models\PaymentMethod::find($key)->title }}</td>
                                <td>Rp. {{ number_format($ma) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td><b>Total :</b></td>
                            <td><b>Rp. {{ number_format(array_sum($productTotals)) }}</b></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div id="table_pagination" class="py-3">

                </div>
            </div>
        </div>
        <div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr style="font-weight: bold">
                            <td>No</td>
                            <td>Kode Produk</td>
                            <td>Produk</td>
                            <td>Qty</td>
                            <td>Harga</td>
                            <td>Total</td>
                        </tr>
                        </thead>
                        <tbody>
                        @php($count=1)
                        @foreach($productAmounts as $key=>$pa)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $products->find($key)->product_code }}</td>
                                <td>{{ $products->find($key)->title }}</td>
                                <td>{{ number_format($pa) }}</td>
                                <td>Rp. {{ number_format($productTotals[$key]/$pa) }}</td>
                                <td>Rp. {{ number_format($productTotals[$key]) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">Total :</td>
                            <td>Rp. {{ number_format(array_sum($productTotals)) }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div id="table_pagination" class="py-3">

                </div>
            </div>
        </div>
    </div>
    @if(\App\Models\ProductCompany::get()->count()>1)
        @foreach(\App\Models\ProductCompany::get() as $pc)
            <div>
                <div class="card">
                    <div class="card-header">
                        <h1>{{$pc->title}}</h1>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr style="font-weight: bold">
                                <td>No</td>
                                <td>Kode</td>
                                <td>Produk</td>
                                <td>Qty</td>
                                <td>Harga Rata-rata</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count=1)
                            @php($total=0)
                            @foreach($productAmounts as $key=>$pa)
                                @if($products->find($key)->product_company_id==$pc->id)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $products->find($key)->product_code }}</td>
                                        <td>{{ $products->find($key)->title }}</td>
                                        <td>{{ number_format($pa) }}</td>
                                        <td>Rp. {{ number_format($productTotals[$key]/$pa) }}</td>
                                        <td>Rp. {{ number_format($productTotals[$key]) }}</td>
                                    </tr>
                                @endif
                            @endforeach

                            @foreach($productMethod as $key=>$ma)
                                @if($key==$pc->id)
                                    @foreach($ma as $key2=>$m)
                                        <tr>
                                            <td colspan="5">{{ \App\Models\PaymentMethod::find($key2)->title }}</td>
                                            <td>Rp. {{ number_format($m) }}@if(\App\Models\PaymentMethod::find($key2)->take!=1) -> {{ number_format($m*\App\Models\PaymentMethod::find($key2)->take) }}(perkiraan) @endif</td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="5"><b>Total :</b></td>
                                <td><b>Rp. {{ number_format($total) }}</b></td>
                            </tr>

                            {{--                            {{ $productTotals }}--}}
                            </tbody>
                        </table>

                    </div>
                    <div id="table_pagination" class="py-3">

                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <div class="col-lg-8 col-sm-12 product-list">
        <div class="product-wrapper-grid">
            <div class="row">
                @foreach($transactionList as $transaction)
                    <div class="col-xl-3 col-sm-3 xl-3 mobile-cashier" wire:click="detail({{$transaction->id}})">
                        <div class="card">
                            <div class="card-header {{ $transaction->status_order_id=="2"?'bg-primary':'bg-danger' }}"
                                 style="padding: 10px">
                                {{ $transaction->transaction_code }} - {{$transaction->name}}
                            </div>
                            <div class="card-body" style="padding: 10px">
                                @foreach($transaction->transactionDetails as $td)
                                    {{$td->product->title}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header" style="padding: 10px">
                <div class="header-top">
                    <h5 class="m-0">Menu Pesanan</h5>
                </div>
            </div>
            <div class="card-body p-0 transaction-list">
                @php($total=0)
                @php($discount=0)
                @if($transactionDetail!=null)
                    @foreach($transactionDetail->transactionDetails as $order)
                        <div class="news-update" style="padding: 10px">
                            <div class="row">
                                <div class="col-4">
                                    <div>{{ $order->product->title }}</div>
                                    @if($order->product->discount_state)
                                        <div>Rp. {{ number_format($order->product->discount_price) }}</div>
                                        <del>Rp. {{ number_format($order->product->price) }}</del>
                                    @else
                                        <div>Rp. {{ number_format($order->product->price) }}</div>
                                    @endif
                                </div>
                                <div class="col-4 text-center">
                                    <br>
                                    <div class="row">
                                        <div class="col-8">{{ number_format($order->amount) }}x</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    @if($order->product->discount_state)
                                        <br>
                                        <div>
                                            Rp. {{ number_format($order->product->discount_price*$order->amount) }}</div>
                                        <del>Rp. {{ number_format($order->product->price*$order->amount) }}</del>
                                        @php($total+=$order->product->discount_price*$order->amount)
                                        @php($discount+=($order->product->price - $order->product->discount_price)*$order->amount)
                                    @else
                                        <br>
                                        <div>Rp. {{ number_format($order->product->price*$order->amount) }}</div>
                                        @php($total+=$order->product->price*$order->amount)
                                    @endif

                                </div>

                            </div>
                        </div>

                    @endforeach
                    <div class="news-update" style="padding: 10px">
                    </div>
                @endif
            </div>

        </div>

    </div>
    <br>
</div>
