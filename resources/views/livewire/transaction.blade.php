<div class="row second-chart-list third-news-update">
    <div class="col-lg-8 col-sm-8 product-list">
        <x-form.input title="" placeholder="Pencarian" model="query"/>
        <div class="product-wrapper-grid">
            <div class="row">
                @php($productType=0)
                @foreach($productSearch as $product)
                    @if($productType!=$product->product_type_id)
                        @if($productType!=0)
                            {!! '</div>' !!}
                            {!! '<div class="row">' !!}
                        @endif
                        @php($productType=$product->product_type_id)
                        <h4>{{ $product->productType->title }}</h4>
                    @endif
                    <div class="col-xl-3 col-sm-3 xl-3 mobile-cashier" wire:click="add({{$product->id}})">
                        <div class="card">
                            <div class="product-box">
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

    <div class="col-lg-4 col-sm-4">
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body" style="padding: 10px">
                        <x-form.input type="text" title="" placeholder="nama pembeli" model="name"/>
                        <x-form.input type="number" title="" placeholder="jumlah pengunjung" model="visitors"/>
                        <x-form.input type="number" title="" placeholder="donasi" model="donate"/>
                        <div style="text-align: center">

                            <button type="button" class="btn m-1" style="background-color: #9a7160;color: white"
                                    wire:click="feeOnChange(5000)">5000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #827788;color: white"
                                    wire:click="feeOnChange(10000)">10000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #6b9281;color: white"
                                    wire:click="feeOnChange(20000)">20000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #447db0;color: white"
                                    wire:click="feeOnChange(50000)">50000
                            </button>
                            <button type="button" class="btn m-1" style="background-color: #b1515d;color: white"
                                    wire:click="feeOnChange(100000)">100000
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
                        <x-form.select :options="$optionMethod" :selected="$paymentMethod" model="paymentMethod"
                                       title="" defer="true"/>
                        <x-form.select :options="$optionReservation" :selected="$reservation" model="reservation"
                                       title="" defer="true"/>

                        Donasi
                        @if(is_numeric($donate))
                            <h6>Rp. {{ number_format($donate) }}</h6>
                        @else
                            <h6>Rp. 0</h6>
                        @endif
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
            <div class="col-lg-12 p-1">
                <button class="btn btn-danger" style="width: 100%"
                        wire:click="cancel()">
                    Batal
                </button>
            </div>
            {{--            <div class="col-lg-6 p-1">--}}
            {{--                <button class="btn btn-warning" style="width: 100%" @if($orderList==null) disabled @endif wire:click="proses()">--}}
            {{--                    Hutang--}}
            {{--                </button>--}}
            {{--            </div>--}}
            <div class="col-lg-12 p-1">
                <button class="btn btn-primary" style="width: 100%" wire:click="proses()">
                    Proses
                </button>
            </div>
            <div class="col-lg-12 p-1">
                <button class="btn btn-primary" style="width: 100%" wire:click="prosesIm()">
                    Proses Karyawan
                </button>
            </div>
            <div class="col-lg-12 p-1">
                <button class="btn btn-danger" style="width: 100%" wire:click="prosesRed()">
                    Proses diskon 10% RED
                </button>
            </div>

        </div>
        <br>
    </div>
</div>
