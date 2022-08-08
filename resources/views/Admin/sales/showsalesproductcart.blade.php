		@php
		$i = 1;
		$totalsalesamount = 0;
		@endphp

		@if(isset($data))
		@foreach($data as $d)

		@php
		$purchasesubtotal    = ($d->product_sales_price * $d->product_quantity)-($d->product_discount_amount*$d->product_quantity);
		$totalsalesamount = $totalsalesamount + $purchasesubtotal;
		@endphp


		<tr id="tr{{ $d->id }}">
			<td>{{ $i++ }}</td>
			<td width="150">{{ $d->pdt_name_en }} {{ $d->pdt_name_bn }} 
				&nbsp;&nbsp;
				<a href="" data-toggle="tooltip" data-placement="right" title="P.Price - {{ $d->product_purchase_price }}"><i class="fa fa-eye text-dark"></i></a>
			</td>


			<td>
				<div class="input-group">
					<input type="text" name="product_quantity" id="product_quantity{{ $d->id }}" class="form-control" value="{{ $d->product_quantity }}" onchange="qtyupdatesales('{{ $d->id }}')" autocomplete="off">

					<button type="button" class="border text-success" style="cursor: pointer;" onclick="qtyupdatesales('{{ $d->id }}')" title="Update Quentity"><i class="fa fa-refresh"></i></button>
				</div>
				
			</td>




			<td>
				<div class="input-group">
					<input type="text" name="sale_price_per_unit" id="sale_price_per_unit" class="form-control" value="{{ $d->pdt_sale_price }}" readonly="">
				</div>
			</td>




			<td>
				<div class="input-group">
					<input type="text" name="product_discount_amount" id="product_discount_amount{{ $d->id }}" class="form-control"  value="{{ $d->product_discount_amount }}" onchange="salesproductdiscount('{{ $d->id }}')" autocomplete="off">
					<button type="button" class="border text-success" style="cursor: pointer;" onclick="salesproductdiscount('{{ $d->id }}')" title="Update Price"><i class="fa fa-refresh"></i></button>

				</div>
			</td>






			<td>
				<div class="input-group">
					<input type="text" class="form-control" readonly="" value="{{ ($d->product_sales_price*$d->product_quantity)-($d->product_discount_amount*$d->product_quantity) }}" autocomplete="off">

				</div>
			</td>




			<td>
				<a  class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-times" aria-hidden="true"></i></a>
			</td>
		</tr>


		@endforeach
		@endif



		<tr>
			<input type="hidden" name="totalsalesamount" id="totalsalesamount" value="{{ $totalsalesamount }}">
			<th colspan="5" class="text-right">Total</th>
			<th colspan="2">{{ $totalsalesamount }}/-</th>
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
							url: "{{ url('deletesalescartproduct') }}/"+id,
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

								showsalesproductcart();
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


<script type="text/javascript">
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
