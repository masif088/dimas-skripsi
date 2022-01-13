@props(['title'=>'no title','options'=>[['value'=>1,'title'=>'nama'],['value'=>2,'title'=>'nam32']],'selected'=>0,'defer'=>false,'model'])
<div class="col">
    <div class="mb-3">
        <label class="form-label">{{ $title }}</label>
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
