<x-data-table :model="$forecasts">
    <x-slot name="head">
        <tr>
            <th scope="col" wire:click.prevent="sortBy('id')">
                Periode @include('components.sort-icon',['field'=>"id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('amount')">
                Jumlah orderan @include('components.sort-icon',['field'=>"amount"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('forecast')">
                Peramalan @include('components.sort-icon',['field'=>"forecast"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('error')" class="text-center">
                Tingkat penyimpanan @include('components.sort-icon',['field'=>"error"])
            </th>
            <th style="width: 100px">Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @php($monthName=['','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'])
        @foreach($forecasts as $index=>$forecast)
            <tr>
                <td>{{ $monthName[$forecast->month]. ' '. $forecast->year }}</td>
                <td>{{ $forecast->amount??"Masih perkiraan" }}</td>
                <td>{{ $forecast->forecast??"Masih belum ada perkiraan" }}</td>
                <td class="text-center">{{ number_format($forecast->error*100,2) }}%</td>
                <td>
                    <a href="{{ route('admin.forecast-tab.edit',$forecast->id) }}" class="btn btn-primary"
                       style="width: 100px">Ubah</a>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-data-table>
