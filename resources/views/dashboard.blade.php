<x-admin>
    <x-slot name="title">
        Something
    </x-slot>
    <div>
        <div class="container-fluid">
            <x-greeting/>
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="user"/>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <x-simple-card icon="users" value="100" title="Product" color="bg-secondary"/>
                </div>
                <livewire:data-income-outcome/>
            </div>
        </div>
    </div>
</x-admin>
