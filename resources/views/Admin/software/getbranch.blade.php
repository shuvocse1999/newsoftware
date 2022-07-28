@php $i=1;  @endphp
@if(isset($data))
@foreach($data as $d)
<tr id="tr{{ $d->branch_id }}">
	<td>{{ $i++ }}</td>
	<td>{{ $d->branch_sl }}</td>
	<td>{{ $d->company_name_en }}<br>{{ $d->company_name_bn }}</td>
	<td>{{ $d->branch_name_en }}</td>
	<td>{{ $d->branch_name_bn }}</td>
	<td>{{ $d->branch_mobile }}</td>
	<td>{!! $d->branch_address_en !!}</td>
	<td>{!! $d->branch_address_bn !!}</td>
	<td>{{ $d->branch_email }}</td>
	<td>
		@if($d->status == 1)
		<span class="btn btn-success btn-sm border-0">Active</span>
		@else
		<span class="btn btn-warning btn-sm border-0">Inactive</span>
		@endif
	</td>
	<td>
		<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->branch_id }}"><i class="fa fa-pencil-square-o"></i></a>
		<a onclick="return confirm('Are you sure?')" class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->branch_id }}"><i class="fa fa-trash-o"></i></a>
	</td>

</tr>
@endforeach
@endif







<script type="text/javascript">

	$(".delete").click(function(){
		let id = $(this).data('id');
		
		$.ajax(
		{
			url: "{{ url('deletebranch') }}/"+id,
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


	});

	// End Delete Data


	$(".edit").click(function(){
		var id = $(this).data("id");
		$.ajax(
		{
			url: "{{ url('editbranch') }}/"+id,
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
