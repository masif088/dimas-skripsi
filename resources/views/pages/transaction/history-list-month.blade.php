<x-admin>
    <x-slot name="title">
        Riwayat Bulanan
    </x-slot>
    <x-slot name="style">
        <style>
            .apexcharts-toolbar{
                margin: 10px !important;
            }
        </style>
    </x-slot>
    <div>
        <div class="container-fluid">
            <livewire:transaction-history-list-month :month="$month" :year="$year"/>
        </div>
    </div>
</x-admin>
