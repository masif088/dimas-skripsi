    <form wire:submit.prevent="{{$action}}">
        <x-form.input type="text" model="data.title" title="Nama Supplier"/>
        <x-form.input type="text" model="data.phone" title="No Hp"/>
        <x-form.input type="text" model="data.email" title="Email"/>
        <x-form.textarea model="data.address" title="Alamat"/>
        <button type="submit" class="btn btn-primary float-end">Submit</button>
    </form>
