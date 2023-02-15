@php use App\Models\ProductType; @endphp
<div class="row">

    <div style="text-align: center">
        <br>
        <img src="{{ asset('assets/logo.jpg') }}" alt="" style="width: 120px">
        <br><br>
    </div>
    <h1 style="text-align: center">
        <b>Pemesanan Mandiri</b>
    </h1>
    <h2 style="text-align: center"> Imaji Creative Space</h2>


    {{--        <x-form.input title="" placeholder="Pencarian" model="query"/>--}}
    <div class="col-lg-12 col-sm-12" id="menu">
        <div class="row">
            @php($productType=0)
            @foreach($products as $product)
                @if($product->self_transaction_status==0 or $product->productType->status==0)
                    @continue
                @endif
                @php($type=ProductType::find($product->product_type_id))

                @if($productType!=$product->product_type_id)
                    @php($productType=$product->product_type_id)

                    <div class="col-4 p-1">
                        <a href="#type{{$productType}}" wire:click="setQuery({{ $productType }})"
                           class=" btn "
                           style="width: 100%;font-size: 10px !important;background: #277f79; color: white!important;">
                            {!! $type->photo_path !!} <br>
                            {{ ProductType::find($product->product_type_id)->title }}
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <br>

        <div class="">
            <div class="row">
                @php($productType=0)
                @foreach($productSearch as $product)
                    @if($product->self_transaction_status==0)
                        @continue
                    @endif
                    @if($product->productType->status==0)
                        @continue
                    @endif

                    @if($productType!=$product->product_type_id)
                        @if($productType!=0)
                            {!! '</div>' !!}
                            <br>
                            {!! '<div class="row">' !!}
                        @endif
                        @php($productType=$product->product_type_id)

                        <h4 wire:ignore.self id="type{{$product->product_type_id}}">
                            @php($type=ProductType::find($product->product_type_id))
                            {!! $type->photo_path !!}
                            {{ $type->title }}
                            ({{ $type->products->where('product_status_id',1)->where('self_transaction_status',1)->count() }}
                            )</h4>
                    @endif
                    <div class="col-xl-12 col-sm-12 xl-12">
                        <div class="card p-2 mb-1 @isset($orderList[$product->id]) border-3 border-success @endisset ">
                            <div class="row">
                                @if($product->thumbnail!=null)
                                    <div class="col-4" wire:click="add({{$product->id}})"
                                         style="padding-top:5px;text-align: center;vertical-align: center">
                                        <img src="{{ asset('storage/'.$product->thumbnail) }}"
                                             style="width: 100%;"
                                             alt="">
                                    </div>
                                @endif
                                <div class="@if($product->thumbnail!=null) col-8 @else col-12 @endif">
                                    <div wire:click="add({{$product->id}})">
                                        <h5>{{ $product->title }}</h5>
                                        @if($product->description!=null)
                                            <p>{{ $product->description }}</p>
                                        @endif
                                        <div class="text-left">
                                            @if($product->discount_state)
                                                Rp. {{ number_format($product->discount_price) }}
                                                <del>Rp. {{ number_format($product->price) }}</del>
                                            @else
                                                Rp. {{ number_format($product->price) }}
                                            @endif
                                        </div>
                                    </div>
                                    @isset($orderList[$product->id])
                                        <div class="row" style="padding-left: 10px">
                                            <button style="height: 40px; width: 40px" class="btn btn-danger col-4"
                                                    wire:click="decreaseOrderList({{$product->id}})">
                                                -
                                            </button>
                                            <div class="col-4 pt-2" style="text-align: center">
                                                {{ $orderList[$product->id] }}
                                            </div>
                                            <button style="height: 40px; width: 40px" class="col-4 btn btn-primary"
                                                    wire:click="increaseOrderList({{$product->id}})">
                                                +
                                            </button>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <br><br>
    <div class="col-lg-12 col-sm-12" id="menuPesanan">
        <div class="card">
            <div class="card-header" style="padding: 10px">
                <div class="header-top">
                    <h5 class="m-0">Menu Pesanan</h5>
                </div>
            </div>
            <div class="card-body p-0 transaction-list">
                @php($total=0)
                @php($discount=0)
                @foreach($orderList as $order=>$value)
                    @php($p=$products->find($order))
                    <div class="news-update" style="padding: 10px">
                        <div class="row">
                            <div class="col-4">
                                <h6>{{ $p->title }}</h6>
                                @if($p->discount_state)
                                    <div>Rp. {{ number_format($p->discount_price) }}</div>
                                    <del>Rp. {{ number_format($p->price) }}</del>
                                @else
                                    <div>Rp. {{ number_format($p->price) }}</div>
                                @endif
                            </div>
                            <div class="col-4 text-center">
                                <div class="row">
                                    <button class="btn btn-sm btn-danger col-4 float-start" type="button"
                                            wire:click="decreaseOrderList({{$order}})">
                                        -
                                    </button>
                                    <h6 class="col-4">{{ number_format($value) }}</h6>
                                    <button class="btn btn-sm btn-primary col-4 float-end" type="button"
                                            wire:click="increaseOrderList({{$order}})">
                                        +
                                    </button>
                                </div>
                            </div>
                            <div class="col-4" style="text-align: right; padding-right: 20px; font-weight: bold">
                                <br>
                                @if($p->discount_state)
                                    <div>Rp. {{ number_format($p->discount_price*$value) }}</div>
                                    <del>Rp. {{ number_format($p->price*$value) }}</del>
                                    @php($total+=$p->discount_price*$value)
                                    @php($discount+=($p->price - $p->discount_price)*$value)
                                @else
                                    <div>Rp. {{ number_format($p->price*$value) }}</div>
                                    @php($total+=$p->price*$value)
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="row" id="payment">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="padding: 10px">
                        <x-form.input type="text" title="" placeholder="nama pembeli" model="name"/>
                        <x-form.input type="number" title="" placeholder="jumlah pengunjung" model="visitors"/>

                        <div style="text-align: center">

                            <button type="button" class="btn m-1" style="background-color: #9a7160;color: white"
                                    wire:click="feeOnChange(5000)">5.000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #827788;color: white"
                                    wire:click="feeOnChange(10000)">10.000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #6b9281;color: white"
                                    wire:click="feeOnChange(20000)">20.000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #447db0;color: white"
                                    wire:click="feeOnChange(50000)">50.000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #b1515d;color: white"
                                    wire:click="feeOnChange(100000)">100.000
                            </button>
                            @if(is_numeric($donate))
                                <button type="button" class="btn m-1" style="background-color: #b1515d;color: white"
                                        wire:click="feeOnChange({{$total + $donate}})">Uang Pas
                                </button>
                            @else
                                <button type="button" class="btn m-1" style="background-color: #b1515d;color: white"
                                        wire:click="feeOnChange({{ $total }})">Uang Pas
                                </button>
                            @endif

                            <br>
                        </div>
                        <x-form.input type="number" title="" placeholder="uang pembayaran" model="fee"
                                      style="margin-bottom: 0"/>
                        <x-form.textarea title="" placeholder="Catatan" model=""/>
                        <x-form.select :options="$optionMethod" :selected="$paymentMethod" model="paymentMethod"
                                       title="" defer="true"/>
                        <x-form.select :options="$optionReservation" :selected="$reservation" model="reservation"
                                       title="" defer="true"/>
                        Total Pembelian
                        @if($discount!=0)
                            <h6>
                                <del>Rp. {{ number_format($total+$discount) }}</del>
                            </h6>
                        @endif
                        <h6>Rp. {{ number_format($total) }} </h6>

                        {{--                        Total Keseluruhan :--}}
                        {{--                        @if(is_numeric($donate))--}}
                        {{--                            <h4>Rp. {{ number_format($total+$donate) }}</h4>--}}
                        {{--                        @else--}}
                        {{--                            <h4>Rp. {{ number_format($total)}}</h4>--}}
                        {{--                        @endif--}}


                        @if($discount!=0)
                            <h6>Hemat Rp. {{number_format($discount)}}</h6>
                        @endif
                        Kembalian
                        <h4>Rp.
                            @if (is_numeric($fee) && is_numeric($total) && is_numeric($donate))
                                {{ number_format($fee-$donate-$total) }}
                            @elseif ((is_numeric($fee) && is_numeric($total)))
                                {{ number_format($fee-$total) }}
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-lg-12 mt-1">
            <button class="btn btn-danger" style="width: 100%"
                    wire:click="cancel()">
                Batal
            </button>
        </div>
        <div class="col-lg-12 mt-1">
            <button class="btn btn-primary" style="width: 100%" wire:click="payment()">
                Proses
            </button>
        </div>
        <br><br>
    </div>
    <a href="#menuPesanan" class="btn btn-primary" wire:click="setOpen"
       style="position:fixed; text-align: center; font-size: 12px; padding-right: 0; padding-left: 0; bottom: 355px; right: 20px; z-index: 10;  width: 55px;">
        <i style="font-size: 20px" class="fa fa-shopping-basket"></i> <br>
        {{ number_format($total,0,'.','.') }} <br>
    </a>

    <a href="#menu" wire:click="cancel()"
       style="position:fixed; bottom: 285px; right: 20px; z-index: 10; width: 55px;height: 55px"
       class="btn btn-sm btn-danger">
        <i style="font-size: 30px" class="p-1 fa fa-trash-o"></i>
    </a>

    <a href="#menu" style="position:fixed; bottom: 220px; right: 20px; z-index: 10; width: 55px;height: 55px"
       class="btn btn-sm btn-primary">
        <i style="font-size: 30px" class="p-1 fa fa-arrow-up"></i>
    </a>
    <a href="#payment" style="position:fixed; bottom: 140px; right: 20px; z-index: 10; width: 55px;height: 70px"
       class="btn btn-sm btn-success">
        Bayar
        <i style="font-size: 30px" class="p-1 fa fa-cash-register"></i>
    </a>
</div>
