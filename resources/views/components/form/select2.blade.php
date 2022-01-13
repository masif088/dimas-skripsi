@props(['title'=>'no title','options'=>[],'selected'=>[],'defer'=>false,'model'])
<div class="col" wire:ignore>
    <div class="mb-3">
        <label for="{{ $model }}" class="form-label">{{ $title }}</label>
        <select id="{{ $model }}" {{ $attributes->merge(['class'=>'form-select form-control digits select2']) }} multiple="" style="padding: 10px">
            @for($i=0;$i<count($options) ;$i++)
                <option value="{{$options[$i]['value']}}" {{ (in_array($options[$i]['value'],$selected)) ? 'selected="selected"' : '' }}
                    style="margin: 10px"
                >
                    {{$options[$i]['title']}}
                </option>
            @endfor
        </select>
    </div>
    @error($model) <span class="error text-danger">{{ $message }}</span> @enderror
    <script>
        document.addEventListener('livewire:load', function () {
            let data;
            $('#{{ $model }}').select2();
            $('#{{ $model }}').on('change', function (e) {
                data = $('#{{ $model }}').select2("val");
            @this.set('{{$model}}', data);
            })
        });
    </script>
</div>
