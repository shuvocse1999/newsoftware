{{-- @php $i=1;  @endphp
@if(isset($data))
@foreach($data as $d)
<tr id="tr{{ $d->id }}">
	<td><input name='employee_id[]' type="checkbox" id="employee_id" value="<?php echo $d->employee_id; ?>"> {{ $i++ }}</td>
	<td>{{ $d->employee_name }}</td>
	<th>{{ $d->employee_salary }}/-</th>
	<td>
		@if($d->salary_status == 1)
		<span class="btn btn-success btn-sm border-0">Active</span>
		@else
		<span class="btn btn-warning btn-sm border-0">Inactive</span>
		@endif
	</td>
	<td>
		<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->id }}"><i class="fa fa-pencil-square-o"></i></a>
		<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
	</td>

</tr>
@endforeach
@endif


 --}}

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
					url: "{{ url('deleteemployeesalarysetup') }}/"+id,
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

						showdata();
					},
					errors:function(){
						Command:toastr["danger"]("Data Delete Unsuccessfully")
						showdata();

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
			url: "{{ url('editemployeesalarysetup') }}/"+id,
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
