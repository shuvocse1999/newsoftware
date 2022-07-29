		@php
		$i = 1;
		$totalpurchaseamount = 0;
		@endphp

		@if(isset($data))
		@foreach($data as $d)

		@php
		$purchasesubtotal    = $d->per_unit_cost * $d->purchase_quantity;
		$totalpurchaseamount = $totalpurchaseamount + $purchasesubtotal;
		@endphp


		<tr id="tr{{ $d->id }}">
			<td>{{ $i++ }}</td>
			<td width="400">{{ $d->pdt_name_en }} {{ $d->pdt_name_bn }}</td>
			<td>
				<div class="input-group">
					<input type="text" name="purchase_quantity" id="purchase_quantity{{ $d->id }}" class="form-control" value="{{ $d->purchase_quantity }}" onchange="qtyupdate('{{ $d->id }}')">

					<div class="input-group-addon"><button type="button" class="border text-success" style="cursor: pointer;" onclick="qtyupdate('{{ $d->id }}')" title="Update Quentity"><i class="fa fa-refresh"></i></button></div>
				</div>
				
			</td>
			<td>
				<div class="input-group">
					<input type="text" name="per_unit_cost" id="per_unit_cost{{ $d->id }}" class="form-control"  value="{{ $d->per_unit_cost }}" onchange="purchasepriceupdate('{{ $d->id }}')">
					<div class="input-group-addon"><button type="button" class="border text-success" style="cursor: pointer;" onclick="purchasepriceupdate('{{ $d->id }}')" title="Update Price"><i class="fa fa-refresh"></i></button></div>

				</div>
			</td>

			<td>
				<div class="input-group">
					<input type="text" name="" name="due" class="form-control" readonly="" value="{{ $d->per_unit_cost*$d->purchase_quantity }}">

				</div>
			</td>
			<td>
				<a  class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-times" aria-hidden="true"></i></a>
			</td>
		</tr>


		@endforeach
		@endif



		<tr>
			<input type="hidden" name="totalpurchaseamount" id="totalpurchaseamount" value="{{ $totalpurchaseamount }}">
			<th colspan="4" class="text-right">Total</th>
			<th colspan="2">{{ $totalpurchaseamount }}/-</th>
		</tr>

		

		<script type="text/javascript">
			$(".delete").click(function(){
				let id = $(this).data('id');


				swal({
					title: "Product Remove From Carts?",
					icon: "info",
					buttons: true,
					dangerMode: true,
					
				})
				.then((willDelete) => {
					if (willDelete) {

						$.ajax(
						{
							url: "{{ url('deletepurchasecartproduct') }}/"+id,
							type: 'get',
							success: function()
							{
								$('#tr'+id).hide();

								Command:toastr["error"]("Product Delete Done")
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