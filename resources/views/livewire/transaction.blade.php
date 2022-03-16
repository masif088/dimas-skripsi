<div class="row second-chart-list third-news-update">
    <div class="col-lg-8 col-sm-8 product-list">
        <x-form.input title="" placeholder="Pencarian" model="query"/>
        <div class="product-wrapper-grid">
            {{--            <div class="row">--}}
            @php($productType=0)
            @foreach($productSearch as $product)
                @if($productType!=$product->product_type_id)
                    @if($productType!=0)</div>
        @endif
        @php($productType=$product->product_type_id)
        <div class="row">
            <h4>{{ $product->productType->title }}</h4>
            @endif
            <div class="col-xl-3 col-sm-3 xl-3 mobile-cashier" wire:click="add({{$product->id}})">
                <div class="card">
                    <div class="product-box">
{{--                        <div class="product-img">--}}
{{--                            <div class="text-center">--}}
{{--                                <img class="img-fluid" src="" alt=""--}}
{{--                                     style="height:100px;background-color: #2d2d2d">--}}
{{--                            </div>--}}
{{--                            <div class="product-hover">--}}
{{--                                <ul>--}}
{{--                                    <li>--}}
{{--                                        <button class="btn" type="button"><i class="icon-plus"></i></button>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
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
                <div class="news-update" style="padding: 10px">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>{{ $products->find($order)->title }}</h6>
                            @if($products->find($order)->discount_state)
                                <div>Rp. {{ number_format($products->find($order)->discount_price) }}</div>
                                <del>Rp. {{ number_format($products->find($order)->price) }}</del>
                            @else
                                <div>Rp. {{ number_format($products->find($order)->price) }}</div>
                            @endif
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="row">
                                <button class="btn btn-sm btn-danger col-4 float-start" type="button"
                                        style="padding: 5px" wire:click="decreaseOrderList({{$order}})">
                                    <i class="icon-minus"></i>
                                </button>
                                <h6 class="col-4">{{ number_format($value) }}</h6>
                                <button class="btn btn-sm btn-primary col-4 float-end" type="button"
                                        style="padding: 5px" wire:click="increaseOrderList({{$order}})">
                                    <i class="icon-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" style="padding: 10px">
                    <x-form.input type="text" title="" placeholder="nama pembeli" model="name"/>
                    <x-form.input type="number" title="" placeholder="jumlah pengunjung" model="visitors"/>
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
                        <button type="button" class="btn m-1" style="background-color: #b1515d;color: white"
                                wire:click="feeOnChange({{$total}})">Uang Pas
                        </button>
                        <br>
                    </div>
                    <x-form.input type="number" title="" placeholder="uang pembayaran" model="fee"/>
                    <x-form.select :options="$optionMethod" :selected="$paymentMethod" model="paymentMethod"
                                   title="" defer="true"/>
                    <x-form.select :options="$optionReservation" :selected="$reservation" model="reservation"
                                   title="" defer="true"/>
                    Total
                    @if($discount!=0)
                        <h4>
                            <del>Rp. {{ number_format($total+$discount) }}</del>
                        </h4>
                    @endif
                    <h4>Rp. {{ number_format($total) }} </h4>
                    @if($discount!=0)
                        <h6>Hemat Rp. {{number_format($discount)}}</h6>
                    @endif
                    Kembalian
                    <h4>Rp.
                        @if (is_numeric($fee) && is_numeric($total))
                            {{ number_format($fee-$total) }}
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-12 p-1">
            <button class="btn btn-danger" style="width: 100%" @if($orderList==null and $total<=$fee) disabled
                    @endif wire:click="cancel()">
                Batal
            </button>
        </div>
        {{--            <div class="col-lg-6 p-1">--}}
        {{--                <button class="btn btn-warning" style="width: 100%" @if($orderList==null) disabled @endif wire:click="proses()">--}}
        {{--                    Hutang--}}
        {{--                </button>--}}
        {{--            </div>--}}
        <div class="col-lg-12 p-1">
            <button class="btn btn-primary" style="width: 100%" @if($orderList==null and $total<=$fee) disabled
                    @endif wire:click="proses()">
                Proses
            </button>
        </div>
        <div class="col-lg-12 p-1">
            <button class="btn btn-primary" style="width: 100%" @if($orderList==null and $total<=$fee) disabled
                    @endif wire:click="prosesIm()">
                Proses Karyawan
            </button>
        </div>

    </div>
    <br>
</div>
</div>
