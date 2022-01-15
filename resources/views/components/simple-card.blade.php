@props(['color' => 'bg-primary', 'title'=>'no title','icon'=>'','value'=>0])
<div class="card o-hidden">
    <div class="{{$color}} b-r-4 card-body">
        <div class="media static-top-widget">
            <div class="align-self-center text-center"><i data-feather="{{ $icon }}"></i></div>
            <div class="media-body"><span class="m-0">{{ $title }}</span>
                <h4 class="mb-0 counter">{{ $value }}</h4><i class="icon-bg" data-feather="{{ $icon }}"></i>
            </div>
        </div>
    </div>
</div>
