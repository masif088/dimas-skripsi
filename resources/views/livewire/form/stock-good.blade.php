<div>
    <form wire:submit.prevent="{{$action}}">
        <x-form.input type="text" model="data.title" title="Barang"/>
        @if($action=="update")
            <x-form.input type="number" model="data.amount" title="Jumlah"/>
        @endif
        <x-form.input type="number" model="data.minimal_amount" title="Minimal barang"/>
        <x-form.input type="number" model="data.maximal_amount" title="Maksimal barang"/>
        <x-form.select :options="$optionSupplier" :selected="$data['supplier_id']" model="data.supplier_id" title="Supplier"/>
        <x-form.textarea model="data.note" title="Deskripsi Produk"/>
        <button type="submit" class="btn btn-primary float-end">Submit</button>
    </form>
</div>
