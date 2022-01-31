<li class="onhover-dropdown">
    <div class="notification-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="feather feather-bell">
            <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
        </svg>
        <span class="badge rounded-pill badge-primary">{{ $count->count() }}</span></div>
    <ul class="notification-dropdown onhover-show-div">
        <li>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-bell">
                <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
            </svg>
            <h6 class="f-18 mb-0">Order</h6>
        </li>
        @foreach($transactionNotification as $transaction)
            <li>
                <div>
                    <span class="pull-right">
                        {{ $transaction->created_at->diffForHumans() }}
                        <br>
                        <div class="text-end">
                            <i class="fa fa-check font-primary" style="font-size: 20px" wire:click="done({{$transaction->id}})"></i>
                        </div>
                    </span>
                    <i class="fa fa-circle-o font-danger"></i>
                    {{ $transaction->transaction_code }} - {{ $transaction->name }}
                    @foreach($transaction->transactionDetails as $td)
                        <div class="pl-4 col-6" style="padding-left: 20px">
                            {{ $td->product->title }} - {{ $td->amount }}x
                        </div>
                    @endforeach
                </div>
            </li>
        @endforeach

        <li><a class="btn btn-primary" href="{{ route('admin.transaction.active') }}">Cek semua order</a></li>
    </ul>
</li>
