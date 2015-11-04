@extends('baselayout')

@section('title') Dashboard @stop

@section('content')
<div class="row">
	<h1>Dashboard</h1>

	{{---Display dashboard content according to user role---}}

	
	<div class="well">
		<p>Welcome <strong>{{ucfirst(Auth::user()->name)}}</strong>, here you can perform various administrative tasks like add new rooms, add new users, block/unblock users etc. To know more on how to perform such tasks, please refer to this help document.</p>
		@if(Session::has('message'))
		<br><br>
		<div class="alert alert-info errors">{{ Session::get('message') }}</div>
	@endif
	</div>
	<div class="col-sm-6" style="border-right:1px solid #828282">
		
		</div>
	</div>
	<div class="col-sm-6">
		
	</div>
	
</div>
@stop