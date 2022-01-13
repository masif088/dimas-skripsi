@props(['type' => 'text', 'title'=>'no title','model','defer'=>false])
<div class="col">
    <div class="mb-3" wire:ignore>
        <label class="form-label">{{$title}}</label>
        <textarea id="{{str_replace(".", "", $model)}}" class="summernote"></textarea>
        <script>
            document.addEventListener('livewire:load', function () {
                $("textarea#{{str_replace('.', '', $model)}}").val(@this.get('{{$model}}'));
                $('#{{str_replace(".", "", $model)}}').summernote({
                    dialogsInBody: true,
                    tabsize: 2,
                    height: 200,
                    callbacks: {
                        onImageUpload: function (files) {
                            for (let i = 0; i < files.length; i++) {
                                $.upload{{str_replace(".", "", $model)}}(files[i],);
                            }
                        },
                        onChange: function (content, $editable) {
                            @this.set('{{$model}}', content)
                        },

                    }
                });
                $.upload{{str_replace(".", "", $model)}} = function (file) {
                    let out = new FormData();
                    out.append('file', file, file.name);
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    $.ajax({
                        method: 'POST',
                        url: '{{route('summernote_upload')}}',
                        cache: false,
                        processData: false,
                        data: out,
                        success: function (img) {
                            image = '<img src="' + window.location.protocol + '//' + window.location.host + img + '" alt="' + window.location.protocol + '//' + window.location.host + '/storage/' + img + '">'
                            $("textarea#{{str_replace('.', '', $model)}}").summernote('code', @this.get('{{$model}}') + image);
                        },
                        error: function (jqXHR,textStatus, errorThrown) {
                            console.log(jqXHR)
                            console.error(textStatus + " " + errorThrown);
                            console.log($('meta[name="csrf-token"]').attr('content'))
                        }
                    });
                };
            });
        </script>
    </div>
</div>


{{--<div class="col">--}}
{{--    <div class="mb-3">--}}
{{--        <label class="form-label">{{$title}}</label>--}}
{{--        <input type="{{ $type }}" wire:model="{{ $model }}" {{ $attributes->merge(['class'=>'form-control']) }} >--}}
{{--        @error($model) <span class="error">{{ $message }}</span> @enderror--}}
{{--    </div>--}}
{{--</div>--}}
