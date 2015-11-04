@extends('baselayout')
@section('content')

<div class="row">
    <div class="col-md-6">
        <p>Please enter the email address which you used to register on this service. In case you don't remember your email address, you will have to contact the administration staff.</p>
        <br>
        @if(Session::has('message'))
        <br><br>
        <div class="alert alert-info errors">{{ Session::get('message') }}</div>
        @endif
        @if (count($errors) > 0)
        <div class="alert alert-danger">{!! Html::ul($errors->all(), array('class'=>'errors')) !!}</div>
        @endif
        <form class="form" method="POST" action="{{ URL::to('users/passwordreset') }}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <div class="form-group">
                <label for="email">Email Address</label>
                {!! csrf_field() !!}
                <input type="email" name="email" class="form-control" placeholder="example@gmail.com" value="{{ old('email') }}">
                <br>
                <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
            </div>
        </form>
    </div>
</div>
@stop