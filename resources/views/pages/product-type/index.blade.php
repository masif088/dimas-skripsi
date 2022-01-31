<x-admin>
    <x-slot name="title">
        Data Jenis Produk
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.product-type.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                            <livewire:table.main name="product-type" :model="$productType"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
