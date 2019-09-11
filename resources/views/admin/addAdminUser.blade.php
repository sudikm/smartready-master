@extends('admin.layout')

@section('style')
@endsection

@section('content')
    <div class="tableListing">
        @include('partials.adminMenu')
        @include('partials.success')
        <div class="portlet-body form">
            {!! Form::open(array('class' => 'form-horizontal', 'id' =>'saveAdminUser', 'method' => 'POST', 'url'=> '/admin/saveAdminUser')) !!}
            {!! csrf_field() !!}
            <div class="tab-content">
                <div class="control-group">
                    {!! Form::label('firstname', 'Firstname', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('firstname', old('firstname') , ['class' => 'span6 m-wrap','id' => 'firstname','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('firstname') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('lastname', 'Lastname', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('lastname', old('lastname') , ['class' => 'span6 m-wrap','id' => 'lastname','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('lastname') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::text('email', old('email') , ['class' => 'span6 m-wrap','id' => 'email','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('email') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::password('password', ['class' => 'span6 m-wrap','id' => 'password', 'autofocus','placeholder' => 'This field is required', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('password') }}</div>
                    </div>
                </div>
                <div class="control-group">
                    {!! Form::label('confirmPassword', 'Confirm Password', ['class' => 'control-label']) !!}
                    <div class="controls">
                        {!! Form::password('confirmPassword', ['class' => 'span6 m-wrap','id' => 'confirmPassword','placeholder' => 'This field is required', 'autofocus', 'data-prompt-position'=> 'centerRight']) !!}
                        <div class='form_error'>{{ $errors->first('confirmPassword') }}</div>
                    </div>
                </div>

                <div class="control-group">
                    {!! Form::label('status', 'Status ', ['class' => 'control-label']) !!}
                    <div class="controls">
                        <label class="radio">
                            {!! Form::radio('status', 'Active',  'false' ,['data-prompt-position' => 'centerRight','data-title'=>'Active']) !!}
                            Active
                        </label>
                        <div class="clearfix"></div>
                        <label class="radio">
                            {!! Form::radio('status', 'Inactive',  'false' ,['data-prompt-position' => 'centerRight','data-title'=>'Inactive']) !!}
                            Inactive
                        </label>
                        <div class='form_error'>{{ $errors->first('status') }}</div>
                    </div>
                </div>
                <div class="control-group" style="margin-left: 35%;">
                    <div><input type='submit' name='submit' value='submit'
                                class="btn green button-submit"></div>
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
            var validator = $('#saveAdminUser').validate({
                rules: {
                    firstname: {
                        required: true,
                        alphabetsOnly: true
                    },
                    lastname: {
                        required: true,
                        alphabetsOnly: true
                    },
                    status: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: '#password'
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