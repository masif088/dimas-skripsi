<x-data-table :model="$stocks">
    <x-slot name="head">
        <tr>
            <th scope="col" wire:click.prevent="sortBy('id')" style="width: 50px">
                # @include('components.sort-icon',['field'=>"id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('title')">
                Barang @include('components.sort-icon',['field'=>"title"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('supplier_id')">
                Supplier @include('components.sort-icon',['field'=>"supplier_id"])
            </th>
            <th scope="col">
                Stock Aman
            </th>
            <th scope="col" wire:click.prevent="sortBy('amount')">
                Stock @include('components.sort-icon',['field'=>"amount"])
            </th>
            <th scope="col">
                Catatan
            </th>
            <th>Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($stocks as $index=>$pt)
            <tr>
                <td scope="row">{{ ($page-1)*$perPage+$index+1 }}</td>
                <td>{{$pt->title}}</td>
                <td>{{$pt->supplier->title}}</td>
                <td>{{number_format($pt->minimal_amount).' - '.number_format($pt->maximal_amount)}}</td>
                <td>{{ number_format($pt->amount) }}</td>
                <td>{{$pt->note}}</td>
                <td>
                    <a href="{{ route('admin.stock.edit',$pt->id) }}" class="btn btn-primary">Ubah</a>
                    <a href="{{ route('admin.stock.add',$pt->id) }}" class="btn btn-primary">Ubah stok</a>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-data-table>
