@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Manage Employee Salary</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Manage Salary List</div>
				<div><a href="{{ url('employeesalary') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Employee Salary</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Payment Date</th>
							<th>Employee Info.</th>
							<th>Transaction Type</th>
							<th>Amount</th>
							<th>Note</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody">
						
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						@if($d->salary_withdraw >0 )
						<tr id="tr{{ $d->id }}">
							<td>{{ $i++ }}</td>
							<td>
								@php
								$explode = explode('-',$d->date);
								$date = $explode[2].'-'.$explode[1].'-'.$explode[0]; 
								@endphp
								{{ $date }}
							</td>
							<td>{{ $d->employee_name }}, {{ $d->employee_phone }}</td>
							<td>{!! $d->transaction_type !!}</td>
							<td>{!! $d->salary_withdraw !!}</td>
							<td>{!! $d->note !!}</td>
							<td>
								<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->id }}"><i class="fa fa-pencil-square-o"></i></a>
								<a  class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
							</td>

						</tr>
						@endif
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
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update Employee Salary</h5>
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
					url: "{{ url('deleteemployeesalary') }}/"+id,
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
			url: "{{ url('editemployeesalary') }}/"+id,
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