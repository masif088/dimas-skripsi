<x-admin>
    <x-slot name="title">
        Ubah data penjualan
    </x-slot>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <livewire:form.forecast action="update" data-id="{{ $id }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
