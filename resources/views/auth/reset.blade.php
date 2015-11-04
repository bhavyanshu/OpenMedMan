@extends('baselayout')

@section('title')
    Change your password
@stop

@section('content')

<div class="col-md-6">
    <h1>Change Password</h1>
    <p>Here you can change your password. Simply enter the new password and press "Reset Password" button.</p>
    <br>
        {!! Html::ul($errors->all(), array('class'=>'errors')) !!}

        {!! Form::open(array('url' => 'users/password/reset','class'=>'form')) !!}
        {!! Form::hidden('token', $token) !!}
        <br>{!! Form::label('email', 'E-Mail Address') !!}
        {!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'example@gmail.com')) !!}
        <br>{!! Form::label('password', 'Password') !!}
        {!! Form::password('password', array('class' => 'form-control')) !!}
        <br>
        {!! Form::label('password_confirmation','Confirm Password',['class'=>'control-label']) !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        <br>
        {!! Form::submit('Reset Password' , array('class' => 'btn btn-primary')) !!}
        
        {!! Form::close() !!}
        <br>
</div>
@stop