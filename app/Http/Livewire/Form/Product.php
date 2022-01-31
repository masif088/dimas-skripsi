<?php

namespace App\Http\Livewire\Form;

use App\Models\ProductStatus;
use App\Models\ProductCompany;
use App\Models\ProductType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;

    public $action;
    public $data;
    public $dataId;
    public $thumbnail;
    public $optionProductType;
    public $optionProductStatus;
    public $optionProductCompany;
    public $optionDiscount;

    public function mount()
    {
        $this->optionDiscount = [
            ['value' => 0, 'title' => 'Non Active'],
            ['value' => 1, 'title' => 'Active'],
        ];
        $this->optionProductCompany = eloquent_to_options(ProductCompany::get(), 'id', 'title');
        $this->optionProductStatus = eloquent_to_options(ProductStatus::get(), 'id', 'title');
        $this->optionProductType = eloquent_to_options(ProductType::get(), 'id', 'title');
        $this->data = [
            'title' => '',
            'product_type_id' => 1,
            'product_company_id' => 1,
            'product_status_id' => 1,
            'price' => 0,
            'thumbnail' => '',
            'description' => '',
            'discount_state' => 0,
            'discount_price' => 0
        ];
        if ($this->dataId != null) {
            $data = \App\Models\Product::find($this->dataId);
            $this->data = [
                'title' => $data->title,
                'product_type_id' => $data->product_type_id,
                'product_company_id' => $data->product_company_id,
                'product_status_id' => $data->product_status_id,
                'price' => $data->price,
                'thumbnail' => $data->thumbnail,
                'description' => $data->description,
                'discount_state' => $data->discount_state,
                'discount_price' => $data->discount_price
            ];
        }
    }

    public function create()
    {
        $this->validate();
        $this->imageUpload();
        \App\Models\Product::create($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil ditambahkan',
        ]);
        $this->emit('redirect', route('admin.product.index'));
    }

    private function imageUpload()
    {
        $image = $this->thumbnail;
        $filename = Str::slug($this->data['title']) . '.' . $image->getClientOriginalExtension();
        $image = Image::make($image)->resize(1080, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->stream();
        $this->data['thumbnail'] = 'products/' . $filename;
        Storage::disk('local')->put('public/products/' . $filename, $image, 'public');
    }

    public function update()
    {
        $this->validate();
        if ($this->thumbnail != null) {
            $this->imageUpload();
        }
        \App\Models\Product::find($this->dataId)->update($this->data);
        $this->emit('notify', [
            'type' => 'success',
            'title' => 'Data berhasil diubah',
        ]);
        $this->emit('redirect', route('admin.product.index'));
    }

    public function render()
    {
        return view('livewire.form.product');
    }

    protected function getRules()
    {
        return [
            'data.title' => 'required|max:255',
            'data.product_type_id' => 'required',
            'data.product_company_id' => 'required',
            'data.product_status_id' => 'required',
            'data.price' => 'required',
            'thumbnail' => 'required'
        ];
    }
}
