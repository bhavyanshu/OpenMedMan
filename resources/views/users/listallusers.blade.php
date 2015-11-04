@extends('layouts.baselayout')

@section('title') View All Users @stop

@section('content')
<div id="blasphemy" value="{{ csrf_token() }}"></div>
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed responsive" width="100%" id="users">
	<thead>
		<tr>
			<th>Username</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Action</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table> 

<script>
var tok = $('#blasphemy').attr('value');
$('#users').dataTable( {
	"bProcessing": true,
	"bServerSide": true,
	"sAjaxSource": "./getlist/"+tok,
	"aaSorting": [[ 2, "desc" ]],
	"responsive": true,
	"sPaginationType": "bootstrap"
}); 
</script>
<style>
th {
	width:100px;
}
</style>
@stop