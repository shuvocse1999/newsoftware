@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Manage Employee Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Manage Employee List</div>
				<div><a href="{{ url('employee') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Add New</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Joining Date</th>
							<th>Name</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Address</th>
							<th>NID</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody">
						
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						<tr id="tr{{ $d->id }}">
							<td>{{ $i++ }}</td>
							<td>
								@php
								$explode = explode('-',$d->joining_date);
								$joining_date = $explode[2].'-'.$explode[1].'-'.$explode[0]; 
								@endphp
								{{ $joining_date }}
							</td>
							<td>{{ $d->employee_name }}</td>
							<td>{{ $d->employee_phone }}</td>
							<td>{!! $d->employee_email !!}</td>
							<td>{!! $d->employee_address !!}</td>
							<td>{!! $d->employee_nid !!}</td>
							<td>
								<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->id }}"><i class="fa fa-pencil-square-o"></i></a>
								<a  class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
						@endforeach
						@endif


						
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-------End Table--------->






<!-- Edit Modal -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update Employee Information</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">

				
			</div>


		</div>
	</div>
</div>
<!--End Edit Modal -->





<script type="text/javascript">

	$(".delete").click(function(){
		let id = $(this).data('id');

		swal({
			title: "Are you sure?",
			icon: "info",
			buttons: true,
			dangerMode: true,

		})
		.then((willDelete) => {
			if (willDelete) {


				$.ajax(
				{
					url: "{{ url('deleteemployee') }}/"+id,
					type: 'get',
					success: function()
					{
						$('#tr'+id).hide();

						Command:toastr["warning"]("Data Delete Successfully Done")
						toastr.options = {
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "3000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}


					},
					errors:function(){
						Command:toastr["danger"]("Data Delete Unsuccessfully")


					}
				});

			}
		});
	});

	// End Delete Data


	$(".edit").click(function(){
		var id = $(this).data("id");
		$.ajax(
		{
			url: "{{ url('editemployee') }}/"+id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$(".editdata").html(data);
			}
		});

		
	});

  // End Edit Data

</script>


@endsection