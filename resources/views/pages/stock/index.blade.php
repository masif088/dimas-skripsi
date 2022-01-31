<x-admin>
    <x-slot name="title">
        Data Barang
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('admin.stock.create') }}" class="btn btn-primary">
                                Tambah Barang
                            </a>
                            <livewire:table.main name="stock" :model="$stock"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-admin>
