	@php $i=1;  @endphp
	@if(isset($data))
	@foreach($data as $d)
	<tr id="tr{{ $d->id }}">
		<td>{{ $i++ }}</td>
		<td>{{ $d->invoice_date }}</td>
		<td>{{ $d->invoice_no }}</td>
		<td>{{ $d->voucher_no }}</td>
		<td>{{ $d->supplier_company_name }}, {{ $d->supplier_company_phone }}</td>
		<td>{{ $d->transaction_type }}</td>

		
		<td>
			<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
			<a href="{{ url('invoicepurchase/'.$d->invoice_no) }}" target="_blank"  class="btn btn-info  border-0 text-light"><i class="fa fa-eye"></i></a>
		</td>

	</tr>
	@endforeach
	@endif

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
						url: "{{ url('deletepurchaseledger') }}/"+id,
						type: 'get',
						success: function()
						{
							$('#tr'+id).hide();

							Command:toastr["warning"]("Delete Successfully Done")
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
	</script>