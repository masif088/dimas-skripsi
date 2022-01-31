<x-data-table :model="$suppliers">
    <x-slot name="head">
        <tr>
            <th scope="col" wire:click.prevent="sortBy('id')" style="width: 50px">
                # @include('components.sort-icon',['field'=>"id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('title')">
                Nama jenis Produk @include('components.sort-icon',['field'=>"title"])
            </th>
            <th>Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($suppliers as $index=>$pt)
            <tr>
                <td scope="row">{{ ($page-1)*$perPage+$index+1 }}</td>
                <td>{{$pt->title}}</td>
                <td>
                    <form method="POST" action="{{ route('admin.product-type.destroy',$pt->id) }}"
                          style="display: inline-block">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <a href="{{ route('admin.product-type.edit',$pt->id) }}" class="btn btn-primary">Ubah</a>
                        <button type="submit" class="btn btn-danger" title="Delete">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-data-table>
