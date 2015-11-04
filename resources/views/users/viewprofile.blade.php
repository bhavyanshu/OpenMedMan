@extends('layouts.baselayout')

@section('title') Profile of {{$user->username}} @stop

@section('content')

<div class="row">
		@if(Auth::user()->id==$user->id) {{---Viewing own profile---}}
		<div class="col-md-4">
			<div id="divtoclear">
			{{HTML::image('./uploads/'.$profile->profpic, 'Profile Picture Loading', array('id'=>'profile-picture','class'=>'img-rounded img-responsive','height'=>'200px'))}}
			</div>
			<br/>
			<div id="validation-errors"></div>
			<br/>
			<p style="text-align:center;"><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  			Click to change profile picture
			</button></p>
			<div class="collapse" id="collapseExample">
  				<div class="well">
    			<form class="form-horizontal" id="upload" enctype="multipart/form-data" method="post" action="{{ url('upload/image') }}" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="file" name="image" id="image" />
                </form>
  				</div>
			</div>
		</div>
		<div class="col-md-6">
		<h2>Hi, {{$user->username}}</h2>
		<p>Welcome to your profile. Here you can verify all your details.</p>
		<p><strong>Full Name</strong>: {{ $profile->first_name or 'User has not added any details yet.' }} {{ $profile->last_name }}</p>
		<p><strong>Bio</strong>: {{$profile->bio or 'User has not added any details yet.'}}</p>
		<p><strong>Occupation</strong>: {{$profile->occupation or 'User has not added any details yet.'}}</p>
		<p><strong>Gender</strong>: @if($profile->gender=="M")<i>Male</i> @elseif($profile->gender=="F") <i>Female</i> @else {{'User has not added any details yet.'}} @endif</p>
		<p><strong>Mobile</strong>: {{$profile->mobilenumber or 'User has not added any details yet.'}}</p>
		<p><strong>Address</strong>: {{$profile->address or 'User has not added any details yet.'}}</p>
		<br/>
		<p>You can add/edit these details by pressing the button given below.</p>
		{{link_to_route('profileditform','Edit Profile',null,array('class'=>'btn btn-primary'))}}
		</div>
		@else
		{{---Viewing someone else's profile, so identify whose profile---}}
			@if($user->role_id!=4) {{---Detecting admin, doctor or staff---}}
			<h2>{{ $profile->first_name }} {{ $profile->last_name }}</h2>
			<p><strong>Username</strong>: {{$user->username}}</p>
			<p><strong>Bio</strong>: {{$profile->bio or 'User has not added any details yet.'}}</p>
			<p><strong>Occupation</strong>: {{$profile->occupation or 'User has not added any details yet.'}}</p>
			@else
			{{---Figure out who is the auth user---}}
				@if(Auth::user()->role_id==4) {{---Detected patient is viewing patient's profile--}}
				<p>You are not authorized to access this profile.</p>
				<p>It can be because this is some other patient's profile. To protect privacy of patients, we do not allow other patients to access such data.</p>
				@else {{---Finally, detected admin/doc/staff is viewing patient's profile--}}
				<h2>{{ $profile->first_name }} {{ $profile->last_name }}</h2>
				<p><strong>Username</strong>: {{$user->username}}</p>
				<p><strong>Bio</strong>: {{$profile->bio or 'User has not added any details yet.'}}</p>
				<p><strong>Occupation</strong>: {{$profile->occupation or 'User has not added any details yet.'}}</p>
				@endif
			@endif
		@endif
</div>

<script type="text/javascript">
$(document).ready(function() {
	var options = { 
		target: '#validation-errors',
        beforeSubmit:  showRequest,
		success:       showResponse,
		dataType: 'json' 
        }; 
 	$('body').delegate('#image','change', function(){
 		$('#upload').ajaxForm(options).submit();  		
 	}); 
});		
function showRequest(formData, jqForm, options) { 
	$("#validation-errors").hide().empty();
	$("#profile-picture").css('display','none');
    return true; 
} 
function showResponse(response, statusText, xhr, $form)  { 
	if(response.success == false)
	{
		var arr = response.errors;
		$.each(arr, function(index, value)
		{
			if (value.length != 0)
			{
				$("#validation-errors").append('<div class="alert alert-error"><strong>'+ value+' - Please try again. Upload a png, jpeg or jpg file only.' +'</strong><div>');
			}
		});
		$("#validation-errors").show();
	} else {
		 $("#divtoclear").empty();
		 $("#divtoclear").html("<img src='"+response.file+"' id='profile-picture' class='img-rounded img-responsive' height='200px' alt='' />");
		 $("#profile-picture").css('display','block');
	}
}
</script>

@stop