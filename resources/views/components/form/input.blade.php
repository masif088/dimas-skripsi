@props(['type' => 'text', 'title'=>'no title','model','defer'=>false])
<div class="col">
    <div class="mb-3">
        <label class="form-label">{{$title}}</label>
        <input type="{{ $type }}" wire:model="{{ $model }}" {{ $attributes->merge(['class'=>'form-control']) }} >
        @error($model) <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
