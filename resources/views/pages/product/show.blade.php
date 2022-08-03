<x-admin>
    <x-slot name="title">
        Lihat Data Produk
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <livewire:product :dataId="$id"/>
                </div>
            </div>
        </div>
    </div>
</x-admin>
