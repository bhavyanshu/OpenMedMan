@extends('baselayout')

@section('title')
	Login
@stop

@section('content')

<div class="row">

	@if(Session::has('message'))
		<br><br>
		<div class="alert alert-info errors">{{ Session::get('message') }}</div>
	@endif
	@if (count($errors) > 0)
		<div class="alert alert-danger errors">{!! Html::ul($errors->all(), array('class'=>'errors')) !!}</div>
	@endif
	<div class="col-md-6">
		<h2>Log in</h2>
		<p>Hi, here you can login to your account. Just fill in the form and press Login button.</p>
		<ul>
			<li><b>Username</b> - This is what you used to register the account.</li>
			<li><b>Password</b> - This is where you enter your password.</li>
		</ul>
		<br>

		{!! Form::open(array('url' => 'users/login','class'=>'form')) !!}

		<br>{!! Form::label('email', 'E-Mail Address') !!}
		{!! Form::text('email', null, array('class' => 'form-control','placeholder' => 'example@gmail.com')) !!}
		<br>{!! Form::label('password', 'Password') !!}
		{!! Form::password('password', array('class' => 'form-control')) !!}
		<br>
 		{!! Form::submit('Sign In' , array('class' => 'btn btn-primary')) !!} 
 		<br>
 		<div class="checkbox">
 		{!! Form::checkbox('remember', null, null) !!} Remember Me -
 		{!! Html::link('users/password/email', 'Forgot password?',array('class'=>''))!!}
 		</div> 
		{!! Form::close() !!}
	</div>
	<div class="col-md-6">
	<h2>Register to create new account</h2>
	<button class="btn" data-toggle="collapse" data-target="#help">Click here for help!</button>
	<div id="help" class="collapsing">
	Hi, here you can create a new account. Just fill in the form and press register button.
        <ul>
            <li><b>Username</b> - This is what you will use to login.</li>
            <li><b>Email</b> - We need to confirm that it is a genuine account. Please provide an email address that you have access to.</li>
            <li><b>Password</b> - This is what you will use to login. Keep it a secret. Make it strong.</li>
        </ul>
	</div>

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