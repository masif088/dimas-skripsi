<x-data-table :model="$products">
    <x-slot name="head">
        <tr>
            <th scope="col" wire:click.prevent="sortBy('id')" style="width: 50px">
                # @include('components.sort-icon',['field'=>"id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('title')">
                Nama @include('components.sort-icon',['field'=>"title"])
            </th>

{{--            <th scope="col" wire:click.prevent="sortBy('description')">--}}
{{--                Deskripsi @include('components.sort-icon',['field'=>"description"])--}}
{{--            </th>--}}
            <th scope="col" wire:click.prevent="sortBy('price')">
                Harga @include('components.sort-icon',['field'=>"price"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('discount_price')">
                Harga discount @include('components.sort-icon',['field'=>"discount_price"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('discount_state')">
                Discount @include('components.sort-icon',['field'=>"discount_state"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('product_status_id')">
                Status @include('components.sort-icon',['field'=>"product_status_id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('self_transaction_status')">
                Self transaction Status @include('components.sort-icon',['field'=>"self_transaction_status"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('product_company_id')">
                Usaha @include('components.sort-icon',['field'=>"product_company_id"])
            </th>
            <th scope="col" wire:click.prevent="sortBy('product_type_id')">
                Jenis @include('components.sort-icon',['field'=>"product_type_id"])
            </th>
            <th>Gambar</th>
            <th style="width: 100px">Aksi</th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($products as $index=>$product)
            <tr>
                <td scope="row">{{ ($page-1)*$perPage+$index+1 }}</td>
                <td>
                    {{$product->title}}
                    <br>
                    <span style="font-size: 9px">{{  $product->description }}</span>
                </td>
                <td style="{{ ($product->discount_state)?'opacity: 0.5':'' }}">{{number_format($product->price)}}</td>
                <td style="{{ !($product->discount_state)?'opacity: 0.5':'' }}">{{number_format($product->discount_price)}}</td>
                <td>
                    <div class="form-check checkbox checkbox-primary mb-0">
                        <input class="form-check-input" type="checkbox" data-bs-original-title="" title=""
                               disabled {{ ($product->discount_state)?'checked':'' }}>
                        <label class="form-check-label" for="checkbox-primary-1"></label>
                    </div>
                </td>

                <td>
                    <select wire:change="statusOnChange({{$product->id}},$event.target.value)" class="form-control">
                        <option value="1" {{$product->product_status_id==1?'selected=selected':''}}>Active</option>
                        <option value="2" {{$product->product_status_id==2?'selected=selected':''}}>Non Active</option>
                        <option value="3" {{$product->product_status_id==3?'selected=selected':''}}>Sold Out</option>
                    </select>
                </td>
                <td>
                    <select wire:change="statusOnChangeSelfTransaction({{$product->id}},$event.target.value)" class="form-control">
                        <option value="1" {{$product->self_transaction_status==1?'selected=selected':''}}>Tampil</option>
                        <option value="0" {{$product->self_transaction_status==0?'selected=selected':''}}>Tidak tampil</option>
                    </select>
                </td>
                <td>{{$product->productCompany->title}}</td>
                <td>{{$product->productType->title}}</td>
                <td>
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="" style="width: 150px">
                </td>
                <td style="width: 100px">
                    <a href="{{ route('admin.product.show',$product->id) }}" class="btn btn-success"
                       style="width: 100px">Lihat</a>
                    <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-primary"
                       style="width: 100px">Ubah</a>
                    @if($product->has('transactionDetails')!=null)
                        <form method="POST" action="{{ route('admin.product.destroy',$product->id) }}"
                              style="display: inline-block">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger" title="Delete" style="width: 100px">Hapus
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-data-table>
