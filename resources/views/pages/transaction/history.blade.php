<x-admin>
    <x-slot name="title">
        Riwayat {{$date->format('d M Y')}}
    </x-slot>
    <div>
        <div class="container-fluid">
            <livewire:transaction-history :date="$date"/>
        </div>
    </div>
</x-admin>
