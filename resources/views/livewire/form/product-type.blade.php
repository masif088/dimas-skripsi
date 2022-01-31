<div>
    <form wire:submit.prevent="{{$action}}">
        <x-form.input type="text" model="data.title" title="Nama Jenis Produk"/>
        <button type="submit" class="btn btn-primary float-end">Submit</button>
    </form>
</div>
