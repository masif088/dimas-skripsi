@props(['type' => 'text', 'title','model','defer'=>false])
<div class="col">
    <div class="mb-3">
        @if($title!=null)
            <label class="form-label">{{$title}}</label>
        @endif
        <input type="{{ $type }}" wire:model="{{ $model }}" {{ $attributes->merge(['class'=>'form-control']) }} >
        @error($model) <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
