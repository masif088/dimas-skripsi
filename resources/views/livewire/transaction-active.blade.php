<div class="row second-chart-list third-news-update">
    <div class="col-lg-8 col-sm-12 product-list">
        <div class="product-wrapper-grid">
            <div class="row">
                @foreach($transactionList as $transaction)
                    <div class="col-xl-3 col-sm-3 xl-3 mobile-cashier" wire:click="detail({{$transaction->id}})">
                        <div class="card">
                            <div class="card-header" style="padding: 10px">
                                {{ $transaction->transaction_code }} - {{$transaction->name}}
                            </div>
                            <div class="card-body" style="padding: 10px">
                                @foreach($transaction->transactionDetails as $td)
                                    {{$td->product->title}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header" style="padding: 10px">
                <div class="header-top">
                    <h5 class="m-0">Menu Pesanan</h5>
                </div>
            </div>
            <div class="card-body p-0 transaction-list">
                @php($total=0)
                @php($discount=0)
                @if($transactionDetail!=null)
                    @foreach($transactionDetail->transactionDetails as $order)
                        <div class="news-update" style="padding: 10px">
                            <div class="row">
                                <div class="col-4">
                                    <div>{{ $order->product->title }}</div>
                                    @if($order->product->discount_state)
                                        <div>Rp. {{ number_format($order->product->discount_price) }}</div>
                                        <del>Rp. {{ number_format($order->product->price) }}</del>
                                    @else
                                        <div>Rp. {{ number_format($order->product->price) }}</div>
                                    @endif
                                    {{--                                    <span>Rp. {{number_format($order->product->price)}}</span>--}}

                                </div>
                                <div class="col-4 text-center">
                                    <br>
                                    {{ $order->amount }}x
                                </div>
                                <div class="col-4">
                                    {{--                                    Rp. {{number_format($order->price*$order->amount)}}--}}
                                    @if($order->product->discount_state)
                                        <br>
                                        <div>
                                            Rp. {{ number_format($order->product->discount_price*$order->amount) }}</div>
                                        <del>Rp. {{ number_format($order->product->price*$order->amount) }}</del>
                                        @php($total+=$order->product->discount_price*$order->amount)
                                        @php($discount+=($order->product->price - $order->product->discount_price)*$order->amount)
                                    @else
                                        <br>
                                        <div>Rp. {{ number_format($order->product->price*$order->amount) }}</div>
                                        @php($total+=$order->product->price*$order->amount)
                                    @endif

                                </div>

                            </div>
                        </div>

                    @endforeach
                    <div class="news-update" style="padding: 10px">
                    </div>
                @endif


            </div>
        </div>

        <div class="col-lg-12 p-1">
            <button class="btn btn-danger" style="width: 100%" @if($transactionDetail==null) disabled
                    @endif wire:click="cancel()">
                Batal
            </button>
        </div>
        <div class="col-lg-12 p-1">
            <button class="btn btn-primary" style="width: 100%" @if($transactionDetail==null) disabled
                    @endif wire:click="done()">
                Proses
            </button>
        </div>
        <div class="col-lg-12 p-1">
            <button class="btn btn-primary" style="width: 100%" @if($transactionDetail==null) disabled
                    @endif wire:click="print()">
                Print Struk
            </button>
        </div>
    </div>
    <br>
</div>

