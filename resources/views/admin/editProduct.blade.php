@extends('admin.layout')

@section('style')
@endsection

@section('content')
    <div class="tableListing">
        @include('partials.adminMenu')
        @include('partials.success')
        <div class="portlet-body form">
            {!! Form::open(array('class' => 'form-horizontal', 'id' =>'updateProduct', 'files' => true,'enctype' => 'multipart/form-data', 'method' => 'POST', 'url'=> '/admin/updateProduct/'.$product['id'])) !!}
            {!! csrf_field() !!}
            <div class="tab-content">
                <div class="control-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('name', $product['name'] , ['class' => 'span6 m-wrap','id' => 'name','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('name') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('title', $product['title'] , ['class' => 'span6 m-wrap','id' => 'title','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('title') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('video', 'Video', ['class' => 'control-label']) !!}
                    <div class="controls">
                        <div class="fileupload fileupload-exists" data-provides="fileupload">
                            <input type="hidden" value="{{ $product['videoLink'] }}" name="video">
                            <video width="320" height="240" controls>
                                <source src="{{ URL::asset('assets/productVideo/'. $product['videoLink']) }}" type="video/mp4">
                            </video>
                        <span class="btn btn-file">
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>
                            {!! Form::file('video', old('video'), ['class' => 'default' ]) !!}
                        </span>
                            {{--<span class="fileupload-preview">{{ $product['videoLink'] }}</span>--}}
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none"></a>
                        </div>
                        <div class='form_error'>{{ $errors->first('video') }}</div>
                    </div>
                </div>

                <div class="control-group" >
                    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
                    <div class="controls">
                    @foreach($product['images'] as $key => $image)  
                
                        <input type="hidden" value="{{$image."#".$key}}" name="oldImages[]">            
                        <img src="{{ URL::asset('/assets/productImage/'. $image) }}" style="width: 320px; height: 240px; padding: 5px;">
                        {!! Form::file('image[]', old('image'), ['class' => 'default']) !!}
                    @endforeach
                    </div>
                </div>
                </div>

                <div class="control-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::textarea('description', $product['description'], ['class' => 'span6 m-wrap','id' => 'description', 'autofocus','placeholder' => 'This field is required', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('description') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('qrCodeText', 'QR Code Text', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('qrCodeText', $product['qrCodeText'],['class' => 'span6 m-wrap','id' => 'qrCodeText','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('qrCodeText') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('pin', 'Pin', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('pin', $product['pin'], ['class' => 'span6 m-wrap','id' => 'pin','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('pin') }}</div>
                    </div>
                </div>
                <div class="control-group" style="margin-left: 35%;">
                    <div>
                        <input type='submit' name='submit' value='submit' class="btn green button-submit">
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $.validator.addMethod(
                    "alphabetsOnly",
                    function (value, element) {
                        return this.optional(element) || /^[A-Za-z]+$/.test(value);
                    },
                    "Please enter alphabets"
            );
            var validator = $('#addProduct').validate({
                rules: {
                    name: {
                        required: true
                    },
                    title: {
                        required: true,
                        alphabetsOnly: true
                    },
                    video: {
                        required: true
                    },
                    image:{
                        required: true
                    },
                    description: {
                        required: true
                    },
                    qrCodeText: {
                        required: true,
                    },
                    pin: {
                        required: true,
                        number : true
                    }
                },
                messages: {},
                errorElement: 'span',
                highlight: function (element, errorClass) {
                    $('span.error').hide();
                    $('span.error').fadeIn(1000);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(this).children('span.error').hide();
                },
            });

            $('.form_error, .error').focus(function () {
                var $parent = $(this).parent();
                $('.error').fadeOut(1000);
                $('span.error', $parent).fadeOut(1000);
            });
        });
    </script>
@endsection

