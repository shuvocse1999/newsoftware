@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Purchase Payment List</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Purchase Payment List</div>
				<div><a href="{{ url('purchasepayment') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Purchase Payment</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Payment Date</th>
							<th>Entry Date</th>
							<th>Supplier Info.</th>
							<th>Payment</th>
							<th>Type</th>
							<th>Comment</th>
							<th>Action</th>
						</tr>
					</thead>
					
					<tbody class="tbody" id="showtdata">
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						@if($d->payment > 0)
						<tr id="tr{{ $d->id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $d->payment_date  }}</td>
							<td>{{ $d->entry_date  }}</td>
							<td>{{ $d->supplier_company_name }}, {{ $d->supplier_company_phone }}</td>
							<td>{{ $d->payment }}</td>
							<td>{{ $d->payment_type }}</td>
							<td>{{ $d->comment }}</td>
							<td>
								@if($d->comment != "firstpayment")
								<a href="{{ url("editpurchasepaymententry/".$d->id) }}" class="btn btn-info border-0 edit text-light"><i class="fa fa-pencil-square-o"></i></a>
								@endif
								<a href="{{ url("purchasepaymentinvoice/".$d->id) }}" class="btn btn-dark border-0 edit text-light" target="blank"><i class="fa fa-eye"></i></a>

								@if($d->comment != "firstpayment")
								<a  class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
								@endif
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


<script type="text/javascript">


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});




	$(".delete").click(function(){
		let id = $(this).data('id');


		swal({
			title: "Delete Payment Entry?",
			icon: "info",
			buttons: true,
			dangerMode: true,

		})
		.then((willDelete) => {
			if (willDelete) {

				$.ajax(
				{
					url: "{{ url('deletepurchaseentry') }}/"+id,
					type: 'get',
					success: function()
					{
						$('#tr'+id).hide();

						Command:toastr["error"]("Delete Payment Entry Successfully")
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

						showpurchaseproductcart();
					},
					errors:function(){
						Command:toastr["danger"]("Data Delete Unsuccessfully")


					}
				});


			} else {

			}
		});
	});




	// End Delete Data
</script>

@endsection