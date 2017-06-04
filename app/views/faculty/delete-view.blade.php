@extends('layouts.master-blue')
@section('title')
Faculty
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@stop
@section('content')
<div class="container-fluid" id="page-body" hidden>
  @include('faculty.sidebar.default')
	<div class="col-md-12" id="faculty-info">
		<div class="col-sm-12 panel panel-body  table-responsive">
			<table id='userTable' class="table table-hover table-striped table-condensed table-bordered">
				<thead>
					<th>Username</th>
					<th>Lastname</th>
					<th>Firstname</th>
					<th>Middlename</th>
					<th>Email</th>
					<th>Mobile</th>
					<th class="no-sort"> </th>
				</thead>
				<tbody>
					@foreach($user as $person)
					<tr>
						<td>{{ $person->username }}</td>
						<td>{{ $person->lastname }}</td>
						<td>{{ $person->firstname }}</td>
						<td>{{ $person->middlename }}</td>
						<td>{{ $person->email }}</td>
						<td>{{ $person->contactnumber }}</td>
						<td>

							{{ Form::open(['method'=>'delete','route' => array('faculty.destroy',$person->id),'id'=>'deletionForm']) }}
							<button type="button" class="btn btn-block btn-sm btn-danger delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove</button>
							{{ Form::close() }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@section('script')
<script>
	$(document).ready(function() {

		$('.delete').click(function(){
			swal({
			  title: "Are you sure?",
			  text: "This account will be removed from your database!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, remove it!",
			  cancelButtonText: "No, cancel it!",
			  closeOnConfirm: true,
			  closeOnCancel: false
			},
			function(isConfirm){
			  if (isConfirm) {
			  	$('#deletionForm').submit();
			  } else {
			    swal("Cancelled", "Activation Cancelled", "error");
			  }
			});
		});

		@if( Session::has("success-message") )
		  swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
		  swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif
	    $('#userTable').DataTable({
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],
	    });

  		$('#page-body').show();
	} );
</script>
@stop
