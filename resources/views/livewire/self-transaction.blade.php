<div class="row">
    <h1 style="text-align: center">
        <b>Pemesanan Mandiri</b>
    </h1>
    <h2 style="text-align: center"> Imaji Creative Space</h2>
    <a href="#menu" style="position:fixed; bottom: 100px; right: 20px; z-index: 10; width: 55px;height: 55px"
       class="btn btn-sm btn-primary">
        <i style="font-size: 30px" class="p-1 fa fa-arrow-up"></i>
    </a>
    <a href="#payment" style="position:fixed; bottom: 20px; right: 20px; z-index: 10; width: 55px;height: 70px"
       class="btn btn-sm btn-danger">
        Bayar
        <i style="font-size: 30px" class="p-1 fa fa-cash-register"></i>
    </a>

    <div class="col-lg-12 col-sm-12" id="menu">
        <x-form.input title="" placeholder="Pencarian" model="query"/>
        <div class="">
            <div class="row">
                @php($productType=0)
                @foreach($productSearch as $product)
                    @if($productType!=$product->product_type_id)
                        @if($productType!=0)
                            {!! '</div>' !!}
                            <br>
                            {!! '<div class="row">' !!}
                        @endif
                        @php($productType=$product->product_type_id)
                        <h4>{{ $product->productType->title }} ({{ $product->productType->products->count() }})</h4>
                    @endif
                    <div class="col-xl-12 col-sm-12 xl-12 ">
                        <div class="card mb-1 @isset($orderList[$product->id]) border-3 border-success @endisset ">
                            <div class="row">
                                <img src="{{ asset('assets/images/blog/img.png') }}" alt="" class="col-3"
                                     wire:click="add({{$product->id}})">
                                <div class="col-6 p-1" wire:click="add({{$product->id}})">
                                    <div class="product-details text-left" style="margin: 0;padding: 0">
                                        <h5 style="margin: 0">{{ $product->title }}</h5>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    <div class="product-price text-left">
                                        @if($product->discount_state)
                                            Rp. {{ number_format($product->discount_price) }}
                                            <del>Rp. {{ number_format($product->price) }}</del>
                                        @else
                                            Rp. {{ number_format($product->price) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3 row p-1">
                                    @isset($orderList[$product->id])
                                        <button style="height: 50px" class="btn btn-danger col-4"
                                                wire:click="decreaseOrderList({{$product->id}})">
                                            -
                                        </button>
                                        <div class="col-4 pt-2" style="text-align: center">
                                            {{ $orderList[$product->id] }}
                                        </div>
                                        <button style="height: 50px" class="col-4 btn btn-primary"
                                                wire:click="increaseOrderList({{$product->id}})">
                                            +
                                        </button>
                                    @endisset

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <h4>Habis</h4>
                @foreach($productSold as $product)
                    <div class="col-xl-3 col-sm-3 xl-3 mobile-cashier" style="opacity: 0.5">
                        <div class="card">
                            <div class="product-box">
                                <div class="product-img">
                                    <div class="text-center">
                                        <img class="img-fluid" src="{{ asset('storage/'.$product->thumbnail) }}" alt=""
                                             style="width:100px">
                                    </div>
                                </div>
                                <div class="product-price text-center">
                                    @if($product->discount_state)
                                        Rp. {{ number_format($product->discount_price) }}
                                        <del>Rp. {{ number_format($product->price) }}</del>
                                    @else
                                        Rp. {{ number_format($product->price) }}
                                    @endif
                                </div>
                                <div class="product-details text-center" style="margin: 0;padding: 0">
                                    <h6 style="margin: 0">{{ $product->title }}</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12">
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
                    <div class="news-update" style="padding: 10px">
                        <div class="row">
                            <div class="col-4">
                                <h6>{{ $products->find($order)->title }}</h6>
                                @if($products->find($order)->discount_state)
                                    <div>Rp. {{ number_format($products->find($order)->discount_price) }}</div>
                                    <del>Rp. {{ number_format($products->find($order)->price) }}</del>
                                @else
                                    <div>Rp. {{ number_format($products->find($order)->price) }}</div>
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
                                @if($products->find($order)->discount_state)
                                    <div>Rp. {{ number_format($products->find($order)->discount_price*$value) }}</div>
                                    <del>Rp. {{ number_format($products->find($order)->price*$value) }}</del>
                                    @php($total+=$products->find($order)->discount_price*$value)
                                    @php($discount+=($products->find($order)->price - $products->find($order)->discount_price)*$value)
                                @else
                                    <div>Rp. {{ number_format($products->find($order)->price*$value) }}</div>
                                    @php($total+=$products->find($order)->price*$value)
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
                        <x-form.input type="number" title="" placeholder="uang pembayaran" model="fee"/>
                        <x-form.textarea  title="" placeholder="Catatan" model=""/>
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

                        Total Keseluruhan :
                        @if(is_numeric($donate))
                            <h4>Rp. {{ number_format($total+$donate) }}</h4>
                        @else
                            <h4>Rp. {{ number_format($total)}}</h4>
                        @endif


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
            <button class="btn btn-primary" style="width: 100%" wire:click="cancel()">
                Proses
            </button>
        </div>
        <br><br>
    </div>
    <div class="btn btn-primary" wire:click="setOpen"
         style="position:fixed; bottom: 20px; left: 20px; z-index: 10; width: 200px;">
        Total Pembelanjaan <br>
        {{ number_format($total,0,'.','.') }} <br>
        @if($open)
            @foreach($orderList as $order=>$value)
                {{ $products->find($order)->title }} ({{$value}}) <br>
            @endforeach
        @endif
    </div>
</div>
