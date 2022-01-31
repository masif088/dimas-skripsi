@props(['title'=>'no title','options'=>[['value'=>0,'title'=>'no data']],'selected'=>0,'defer'=>false,'model'])
<div class="col">
    <div class="mb-3">
        @if($title!=null)
            <label class="form-label">{{$title}}</label>
        @endif
        <select wire:model{{$defer?'.defer':''}}="{{ $model }}" {{ $attributes->merge(['class'=>'form-select digits']) }}>
            @for($i=0;$i<count($options) ;$i++)
                <option value="{{$options[$i]['value']}}" {{ ($options[$i]['value']==$selected) ? 'selected="selected"' : '' }}>
                    {{$options[$i]['title']}}
                </option>
            @endfor
            @error($model) <span class="error">{{ $message }}</span> @enderror
        </select>
    </div>
</div>
