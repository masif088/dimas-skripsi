<x-admin>
    <x-slot name="title">
        Data Produk Usaha
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.product-company.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                            <livewire:table.main name="product-company" :model="$productCompany"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
