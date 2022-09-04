	@php $i=1;  @endphp
	@if(isset($data))
	@foreach($data as $d)
	<tr id="tr{{ $d->id }}">
		<td>{{ $i++ }}</td>
		<td>{{ $d->invoice_date }}</td>
		<td>{{ $d->entry_date }}</td>
		<td>{{ $d->invoice_no }}</td>
		<td>{{ $d->customer_name_en }}, {{ $d->customer_phone }}</td>
		<td>{{ $d->transaction_type }}</td>

		
		<td>
			<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
			<a href="{{ url('invoicesalesa4/'.$d->invoice_no) }}" target="_blank"  class="btn btn-info  border-0 text-light"><i class="fa fa-eye"></i></a>
			<a href="{{ url('invoicesales/'.$d->invoice_no) }}" target="_blank"  class="btn btn-success  border-0 text-light"><i class="fa fa-print"></i></a>
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
						url: "{{ url('deletesalesledger') }}/"+id,
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