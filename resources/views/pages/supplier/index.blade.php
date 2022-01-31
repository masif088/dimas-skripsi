<x-admin>
    <x-slot name="title">
        Data Supplier
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.supplier.create') }}" class="btn btn-primary">
                                Tambah
                            </a>
                            <livewire:table.product name="supplier" :model="$supplier"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
