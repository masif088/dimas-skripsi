<x-admin>
    <x-slot name="title">
        Data Produk
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                            <livewire:table.product name="product" :model="$product"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
