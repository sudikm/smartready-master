@extends('admin.layout')

@section('style')
@endsection

@section('content')
    <div class="tableListing">
        @include('partials.adminMenu')
        @include('partials.success')
        <div class="portlet-body form">
            {!! Form::open(array('class' => 'form-horizontal', 'id' =>'addProduct', 'files' => true,'enctype' => 'multipart/form-data', 'method' => 'POST', 'url'=> '/admin/saveProduct')) !!}
            {!! csrf_field() !!}
            <div class="tab-content">
                <div class="control-group">
                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('name', old('name') , ['class' => 'span6 m-wrap','id' => 'name','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('name') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('title', old('title') , ['class' => 'span6 m-wrap','id' => 'title','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('title') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('video', 'Video', ['class' => 'control-label']) !!}
                    <div class="controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-file">
                                <span class="fileupload-new">Select file</span>
                                <span class="fileupload-exists">Change</span>
                                {!! Form::file('video', ['class' => 'default']) !!}
                            </span>
                            <span class="fileupload-preview"></span>
                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                               style="float: none"></a>
                        </div>
                    </div>
                    <div class='form_error'>{{ $errors->first('video') }}</div>
                </div>

                <div class="control-group" id="addImage">
                    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::file('image[]', old('image'), ['class' => 'span6 m-wrap','id' => 'image','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('title') }}</div>
                    </div>
                </div>

                <div class="control-group" style="margin-left: 20%;">
                    <div>
                        <button class="addMore">Add</button>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::textarea('description', old('description'), ['class' => 'span6 m-wrap','id' => 'description', 'autofocus','placeholder' => 'This field is required', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('description') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('qrCodeText', 'QR Code Text', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('qrCodeText', old('qrCodeText'),['class' => 'span6 m-wrap','id' => 'qrCodeText','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('qrCodeText') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('pin', 'Pin', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('pin', old('pin'), ['class' => 'span6 m-wrap','id' => 'pin','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
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

            $(".addMore").click(function(){ 
          
          var html = $("#addImage").html();
          $("#addImage").after(html);
      });

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
                    image: {
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