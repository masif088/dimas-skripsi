<form wire:submit.prevent="{{$action}}">
    <x-form.input type="number" model="data.year" title="Tahun"/>
    <x-form.input type="number" model="data.month" title="Bulan"/>
    <x-form.input type="number" model="data.amount" title="Jumlah" step="any"/>

{{--    <x-form.textarea model="data.address" title="Alamat"/>--}}
    <button type="submit" class="btn btn-primary float-end">Submit</button>
</form>
