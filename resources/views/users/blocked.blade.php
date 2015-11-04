<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Account is Blocked</title>
	{{ HTML::style('packages/twitter-bootstrap/css/bootstrap.min.css') }} 
</head>
<body>
	<div class="container">
		<div class="row" style="padding:5px;">
			<h1>Account is blocked</h1>
			<p>It seems your account is blocked. Please contact your concerned IT department to unblock your account. There are number of reasons why your account might be blocked. The following are few.</p>
			<ul>
				<li><strong>Account Types</strong> : You have opted for doctor/staff account on registration. In this case, contact concerned IT department because they need to verify you first. These account types require verification. Only patient account types don't require such verification.</li>
				<li><strong>Service Abuse</strong> : Administrators have the authority to block any accounts if they notice any abuse of service.</li>
			</ul>
			<p>For any further details, please contact the concerned IT department of your respective workplace.</p>
			<p>If you feel something is wrong and you don't wanna be here, then click {{ HTML::link('user/logout', 'logout') }}</p>
		</div>
	</div>
</body>
</html>