<x-data-table :model="$productCompanies">
    <x-slot name="head">
        <tr>
            <th scope="col" wire:click.prevent="sortBy('id')" style="width: 50px">
                # @include('components.sort-icon',['field'=>"id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('title')">
                Nama Produk Usaha @include('components.sort-icon',['field'=>"title"])
            </th>
            <th>Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($productCompanies as $index=>$pc)
            <tr>
                <td scope="row">{{ ($page-1)*$perPage+$index+1 }}</td>
                <td>{{$pc->title}}</td>
                <td>
                    <form method="POST" action="{{ route('admin.product-company.destroy',$pc->id) }}"
                          style="display: inline-block">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('admin.product-company.edit',$pc->id) }}" class="btn btn-primary">Ubah</a>
                        @if($pc->products==null)
                        <button type="submit" class="btn btn-danger" title="Delete">Hapus</button>
                        @endif
                    </form>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-data-table>
