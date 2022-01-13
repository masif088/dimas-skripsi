@props(['title'=>'no title','model','defer'=>false])
<div class="col">
    <div class="mb-3">
        <label class="col-form-label">{{$title}}</label>
        <div class="media-body text-end icon-state switch-outline">
            <label class="switch">
                <input type="checkbox" wire:model="{{ $model }}">
                <span class="switch-state"></span>
                @error($model) <span class="error">{{ $message }}</span> @enderror
            </label>
        </div>
    </div>
</div>
