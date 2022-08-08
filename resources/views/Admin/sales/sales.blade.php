@extends('Admin.layouts.index')
@section('content')



<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Sales Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Add Sales</div>
				<div><a href="{{ url('allsalesledger') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;All Sales</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" action="{{ url("salesledger") }}" class="reloadform myinput" target="_blank">
					@csrf

					<div class="col-md-12 p-0 row">
						
						<div class="form-group col-md-3">
							<label>Customer Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<select class="form-control select2_demo_1" name="customer_id" id=
								"customer_id" required="" onchange="getcustomerphone();">
								<option value="">Select Customer</option>
								@php
								$customer = DB::table('customer_info')->get();		
								@endphp 
								@foreach($customer as $i)
								<option value="{{ $i->customer_id  }}">{{ $i->customer_id }} - {{ $i->customer_name_en }}</option>
								@endforeach
							</select>
							<div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters"><i class="fa fa-plus-circle text-primary"></i></div>
						</div>
					</div>


					<div class="form-group col-md-3">
						<label>Mobile Number:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-phone"></i></div>
							<input type='number'  name='customer_phone' id='customer_phone' class='form-control' placeholder='Mobile' readonly="">
						</div>
					</div>


					<div class="form-group col-md-3">
						<label>Cash No:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
							<input type="text"  name="cash_no" id="cash_no" class="form-control" value="" placeholder="Cash No">
							
						</div>
					</div>


					<div class="form-group col-md-3">
						<label>Invoice Date:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" name="invoice_date" id="datepicker" placeholder="Invoice Date" class="form-control" required="" autocomplete="off">
							
						</div>
					</div>



					<div class="col-md-9">
						<div class="row">
							<div class="col-md-4">

								<div class="form-group">
									<label>Item Name:</label>
									<div class="input-group">

										<select class="form-control" name="item_id" id=
										"item_id" onchange="getproduct()">
										<option value="">Select Item</option>
										@php
										$item = DB::table('pdt_item')->where('item_status',1)->get();		
										@endphp 
										@foreach($item as $i)
										<option value="{{ $i->item_id  }}">{{ $i->item_name_en }} {{ $i->item_name_bn }} </option>
										@endforeach
									</select>
									
								</div>
							</div>

						</div>

						<div class="col-md-8">


							<div class="form-group">
								<label>Product Name:</label>
								<div class="input-group">

									<select class="form-control select2_demo_1" name="pdt_id" id=
									"pdt_id"  onchange="return salesproductcart()">
									<option value="">Select Product</option>
									@php
									$product = DB::table('stock_products')
									->leftjoin("pdt_productinfo",'pdt_productinfo.pdt_id','stock_products.product_id')
									->select("stock_products.*",'pdt_productinfo.pdt_id','pdt_productinfo.pdt_name_en','pdt_productinfo.pdt_name_bn')
									->get();		
									@endphp 
									@foreach($product as $i)
									<option value="{{ $i->pdt_id  }}">{{ $i->pdt_name_en }} {{ $i->pdt_name_bn }}</option>
									@endforeach
								</select>
								
							</div>
						</div>


					</div>
				</div>


				<div class="col-md-12 p-0 mt-2">
					<table class="table table-bordered table-responsive purchase">
						<thead class="bg-dark text-light">
							<tr>
								<th>SL</th>
								<th>Name</th>
								<th>Qty</th>
								<th>S. Price (Unit)</th>
								<th>Discount (Unit)</th>
								<th>Sub Total</th>
								<th>Action</th>

							</tr>
						</thead>

						<tbody id="showdata">
							
						</tbody>
					</table>
				</div>




			</div>




			<div class="col-md-3">
				<div class="ibox-head myhead2 p-0">
					<div class="ibox-title2"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Account</div>
				</div>

				<div class="col-md-12 bg-light p-3">
					<div class="form-group">
						<label>Total Amount:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" id="totalamount" name="totalamount" class="form-control"  readonly="">
							
						</div>
					</div>

					<div class="form-group">
						<label>Discount:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" id="discount" name="discount" class="form-control" placeholder="Discount" onkeyup="calculatediscount();" value="0" autocomplete="off">
							
						</div>
					</div>


					<div class="form-group">
						<label>Grand Total:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" id="grandtotal" name="grandtotal" class="form-control"  readonly="">
							
						</div>
					</div>


					<div class="form-group">
						<label>Paid:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" id="paid" name="paid" class="form-control" placeholder="Paid" onkeyup="calculatedue()" required="" value="0" autocomplete="off" >
							
						</div>
					</div>


					<div class="form-group">
						<label>Due:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" id="due" name="due" class="form-control"  readonly="">
							
						</div>
					</div>

					<div class="form-group">
						<label>Payment By:</label>
						<div class="input-group">
							<select class="form-control" name="transaction_type" id="transaction_type">
								<option value="Cash">Cash</option>
								<option value="Bank">Bank</option>
								<option value="Mobile Banking">Mobile Banking</option>

							</select>
							
						</div>
					</div>

				</div>

			</div>






		</div>


		<div class="col-12 border p-4 mt-4">
			<center><input type="submit" name="" onclick="createinvoice()" value="Submit Now" class="btn btn-success" style="width: 200px; font-weight: bold; border-radius: 30px;"></center>
		</div>


	</form>

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





	function getproduct(){
		let item_id = $("#item_id").val();
		$.ajax({
			url: "{{ url('getproductajax') }}/"+item_id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$("#pdt_id").html(data);
			},
			error:function(errors){
				alert("Select Item")
			}
		});

	}

	function getcustomerphone(){
		let customer_id = $("#customer_id").val();
		$.ajax({
			url: "{{ url('getcustomerphone') }}/"+customer_id,
			type: 'get',
			success: function (response)
			{
				$("#customer_phone").val(response);
			},
			error:function(errors){
				alert("Select Customer")
			}
		});

	}




	showsalesproductcart();


	function salesproductcart(){
		let pdt_id = $("#pdt_id").val();

		$.ajax({
			url: "{{ url('salesproductcart') }}/"+pdt_id,
			type: 'GET',
			success: function (data)
			{
				Command:toastr["success"]("Product Added Successfully Done")
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

				$("#pdt_id").val('');
				


			},
			error:function(errors){
				alert("Select Products");
			}
		});

	}





	function showsalesproductcart(){
		$.ajax({
			url: "{{ url('showsalesproductcart') }}",
			type: 'get',
			data:{},
			success: function (data)
			{
				$("#showdata").html(data);

				let totalsalesamount = $("#totalsalesamount").val();
				$("#totalamount").val(totalsalesamount);
				$("#grandtotal").val(totalsalesamount);
				
				
			},
			error:function(errors){
				alert("errors")
			}
		});

	}




	function qtyupdatesales(id){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		let product_quantity = $("#product_quantity"+id).val();


		$.ajax({
			url: "{{ url('qtyupdatesales') }}/"+id,
			type: 'POST',
			data:{product_quantity:product_quantity},
			success: function (data)
			{
				Command:toastr["success"]("Product Quentity Update")
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
			error:function(errors){
				alert("errors")
			}
		});

	}




	function salesproductdiscount(id){

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		let product_discount_amount = $("#product_discount_amount"+id).val();

		$.ajax({
			url: "{{ url('product_discount_amount') }}/"+id,
			type: 'POST',
			data:{product_discount_amount:product_discount_amount},
			success: function (data)
			{
				Command:toastr["success"]("Product Discount Update")
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
			error:function(errors){
				alert("errors")
			}
		});

	}


	



	
	


	function calculatediscount(){
		let total     = $("#totalamount").val();
		let discount  = $("#discount").val();



		if (discount != "" && discount>0) {
			let totaldiscount         = (parseFloat(total)-parseFloat(discount));
			$("#grandtotal").val(totaldiscount);

		}

		calculatedue();
		$("#due").val(0);
	}

	function calculatedue(){
		let grandtotal = $("#grandtotal").val();
		let paid       = $("#paid").val()

		let due = (parseFloat(grandtotal)-parseFloat(paid));
		$("#due").val(due);

		calculatediscount();

	}







</script>









<!-- Supplier Modal -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Customer</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">

				<form method="post" action="{{ url("customerinsert2") }}">
					@csrf

					<div class="row myinput">
						@php
						$branch = DB::table('branch_info')->get();
						@endphp

						<div class="form-group col-md-4">
							<label>Branch Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="customer_branch_id" id="customer_branch_id" style="width: 100%;">
									<option value="">Select Branch</option>
									@if(isset($branch))
									@foreach($branch as $c)
									<option value="{{ $c->branch_id }}">{{ $c->branch_name_en }}</option>
									@endforeach
									@endif

								</select>
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Customer Name(EN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="customer_name_en" id="customer_name_en"  required="" placeholder="Customer Name EN">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Customer Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="customer_name_bn" id="customer_name_bn"  placeholder="Customer Name BN">
							</div>
						</div>


						<div class="form-group col-md-6">
							<label>Customer Mobile:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="number" name="customer_phone" id="customer_phone" required="" placeholder="Customer Mobile">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Email:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input class="form-control" type="text"  name="customer_email" id="customer_email" placeholder="Customer Email">
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>Address:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<textarea class="form-control" rows="3" name="customer_address" id="customer_address" required="" placeholder="Customer Address"></textarea>
							</div>
						</div>



						<div class="modal-footer border-0 col-12">
							<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
							<button type="submit" class="btn btn-success button border-0">Save</button>

						</div>





					</div>
				</form>



			</div>


		</div>
	</div>
</div>
<!--End Supplier Modal -->








	@endsection