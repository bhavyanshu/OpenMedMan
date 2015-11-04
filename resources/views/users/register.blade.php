@extends('baselayout')

@section('title')
    Register
@stop

@section('content')

<div class="row">
    <div class="col-md-6">
        <h2>Register to create an account</h2>
        <p>Hi, here you can create a new account. Just fill in the form and press register button.</p>
        <ul>
            <li><b>Username</b> - This is what you will use to login.</li>
            <li><b>Email</b> - We need to confirm that it is a genuine account. Please provide an email address that you have access to.</li>
            <li><b>Password</b> - This is what you will use to login. Keep it a secret. Make it strong.</li>
        </ul>
        <br>
        {!! Html::ul($errors->all(), array('class'=>'errors')) !!}

        {!! Form::open(array('url' => 'users/register','class'=>'form')) !!}
        
        <br>{!! Form::label('name', 'Username') !!}
        {!! Form::text('name', null, array('class' => 'form-control','placeholder' => 'kenny')) !!}
        <br>{!! Form::label('email', 'E-Mail Address') !!}
        {!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'example@gmail.com')) !!}
        <br>{!! Form::label('password', 'Password') !!}
        {!! Form::password('password', array('class' => 'form-control')) !!}
        <br>
        {!! Form::label('password_confirmation','Confirm Password',['class'=>'control-label']) !!}
        {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
        <br>
        {!! Form::submit('Sign Up' , array('class' => 'btn btn-primary')) !!}
        
        {!! Form::close() !!}
        <br>
    </div>
</div>

@stop