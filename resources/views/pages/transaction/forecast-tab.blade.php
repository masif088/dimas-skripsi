<x-admin>
    <x-slot name="title">
        Peramalan
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.forecast-tab.create') }}" class="btn btn-primary">
                        Tambah data penjualan
                    </a>
                    <livewire:table.main name="forecast"/>
                </div>

            </div>
        </div>
    </div>
</x-admin>
