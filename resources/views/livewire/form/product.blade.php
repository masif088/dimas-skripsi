<div>
    <form wire:submit.prevent="{{$action}}">
        <x-form.input type="text" model="data.title" title="Nama Produk"/>
        <x-form.input type="text" model="data.product_code" title="Kode Produk"/>
        <x-form.input type="number" model="data.price" title="Harga Produk"/>
        <x-form.input type="number" model="data.discount_price" title="Harga diskon"/>
        <x-form.select :options="$optionDiscount" :selected="$data['discount_state']" model="data.discount_state" title="Diskon" defer="true"/>
        <x-form.select :options="$optionProductType" :selected="$data['product_type_id']" model="data.product_type_id" title="Jenis" defer="true"/>
        <x-form.select :options="$optionProductCompany" :selected="$data['product_company_id']" model="data.product_company_id" title="Usaha" defer="true"/>
        <x-form.select :options="$optionProductStatus" :selected="$data['product_status_id']" model="data.product_status_id" title="Status" defer="true"/>
        <x-form.textarea model="data.description" title="Deskripsi Produk"/>
        <x-form.input type="file" model="thumbnail" title="Foto Produk"/>
        <div wire:loading wire:target="thumbnail">
            Proses upload
        </div>
        @if($action=='create')
            @if($thumbnail)
                <img src="{{$thumbnail->temporaryUrl()}}" alt="" style="max-height: 300px">
            @endif
        @else
            @if($thumbnail)
                <img src="{{$thumbnail->temporaryUrl()}}" alt="" style="max-height: 300px">
            @else
                <img src="{{asset('storage/'.$this->data['thumbnail'])}}" alt="" style="max-height: 300px">
            @endif
        @endif
        <button type="submit" class="btn btn-primary float-end">Submit</button>
    </form>
</div>
