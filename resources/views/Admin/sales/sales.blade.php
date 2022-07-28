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
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit myinput">
					@csrf

					<div class="col-md-12 p-0 row">
						
						<div class="form-group col-md-3">
							<label>Customer Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<select class="form-control select2_demo_1" name="pdt_item_id" id=
								"pdt_item_id" required="" onchange="getcat()">
								<option value="">Select Customer</option>
								@php
								$customer = DB::table('customer_info')->get();		
								@endphp 
								@foreach($customer as $i)
								<option value="{{ $i->customer_id  }}">{{ $i->customer_name_en }} - {{ $i->customer_name_bn }}</option>
								@endforeach
							</select>
							<div class="input-group-addon border border-left-0"><i class="fa fa-plus-circle text-primary"></i></div>
						</div>
					</div>


					<div class="form-group col-md-2">
						<label>Mobile Number:</label>
						<div class="input-group">
							<input type="number" name="" name="mobile" class="form-control" placeholder="Mobile">
							
						</div>
					</div>



					<div class="form-group col-md-2">
						<label>Previous Due:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" name="" name="due" class="form-control" value="0.00" readonly="">
							
						</div>
					</div>


					<div class="form-group col-md-2">
						<label>Invoice Number:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
							<input type="text" name="" name="due" class="form-control" value="INV-0042052" readonly="">
							
						</div>
					</div>


					<div class="form-group col-md-3">
						<label>Date:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="date" name="" name="date" class="form-control">
							
						</div>
					</div>




					<div class="col-md-9">
						<div class="row">
							<div class="col-md-4">

								<div class="form-group">
									<label>Item Name:</label>
									<div class="input-group">

										<select class="form-control select2_demo_1" name="pdt_item_id" id=
										"pdt_item_id" required="" onchange="getcat()">
										<option value="">Select Item</option>
										@php
										$item = DB::table('pdt_item')->where('item_status',1)->get();		
										@endphp 
										@foreach($item as $i)
										<option value="{{ $i->item_id  }}">{{ $i->item_name_en }} ( {{ $i->item_name_bn }} )</option>
										@endforeach
									</select>
									<div class="input-group-addon border border-left-0"><i class="fa fa-plus-circle text-primary"></i></div>
								</div>
							</div>

						</div>

						<div class="col-md-8">


							<div class="form-group">
								<label>Product Name:</label>
								<div class="input-group">

									<select class="form-control select2_demo_1" name="pdt_item_id" id=
									"pdt_item_id" required="" onchange="getcat()">
									<option value="">Select Product</option>
									@php
									$product = DB::table('pdt_productinfo')->where('pdt_status',1)->get();		
									@endphp 
									@foreach($product as $i)
									<option value="{{ $i->pdt_id  }}">{{ $i->pdt_name_en }} - {{ $i->pdt_name_bn }}</option>
									@endforeach
								</select>
								<div class="input-group-addon border border-left-0"><i class="fa fa-plus-circle text-primary"></i></div>
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
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Discount</th>
								<th>Sub Total</th>
								<th>Action</th>

							</tr>
						</thead>

						<tbody>


							<tr>
								<td>01.</td>
								<td>Mi Note 10 Lite</td>
								<td><input type="text" name="" value="1" class="form-control"></td>
								<td>
									<div class="input-group">
										<input type="text" name="" name="due" class="form-control" readonly="" value="0.00">

									</div>
								</td>
								<td>
									<div class="input-group">
										<input type="text" name="" name="due" class="form-control"  placeholder="Discount">

									</div>
								</td>
								<td>
									<div class="input-group">
										<input type="text" name="" name="due" class="form-control" readonly="" value="0.00">

									</div>
								</td>
								<td>
									<a href="" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							</tr>



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
							<input type="text" name="" name="due" class="form-control" value="0.00" readonly="">
							
						</div>
					</div>

					<div class="form-group">
						<label>Discount:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" name="" name="due" class="form-control" placeholder="Discount">
							
						</div>
					</div>

					<div class="form-group">
						<label>Paid:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" name="" name="due" class="form-control" placeholder="Paid">
							
						</div>
					</div>


					<div class="form-group">
						<label>Due:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" name="" name="due" class="form-control" value="0.00" readonly="">
							
						</div>
					</div>

					<div class="form-group">
						<label>Payment By:</label>
						<div class="input-group">
							<select class="form-control">
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
			<center><input type="submit" name="" value="Create Invoice" class="btn btn-success" style="width: 200px; font-weight: bold;"></center>
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



	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('productinsert') }}',
			method:'POST',
			data:data,
			beforeSend:function(response) { 
				$('.loading').show();
				$('.button').hide();

			},
			success:function(response){

				Command:toastr["success"]("Data Save Successfully Done")
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

				$('#pdt_name_en').val('');
				$('#pdt_name_bn').val('');
				$('#pdt_measurement').val('');
				$('#pdt_purchase_price').val('');
				$('#pdt_sale_price').val('');
				$('#pdt_short_details').val('');
				$('#pdt_details').val('');
				$('#pdt_condition').val('');
				$('#pdt_suspension').val('');
				$('#pdt_shelf_no').val('');
				$('#pdt_over_stock').val('');
				$('#pdt_order_qunt').val('');
				$('#pdt_url').val('');
				$('.loading').hide();
				$('.button').show();


			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data


	function getcat(){
		let item_id = $("#pdt_item_id").val();
		$.ajax({
			url: "{{ url('getcatajax') }}/"+item_id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$("#pdt_cat_id").html(data);
			},
			error:function(errors){
				alert("Select Item")
			}
		});

	}


	function getsubcat(){
		let cat_id = $("#pdt_cat_id").val();
		$.ajax({
			url: "{{ url('getsubcatajax') }}/"+cat_id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$("#pdt_subcat_id").html(data);
			},
			error:function(errors){
				alert("Select Category")
			}
		});

	}

</script>





@endsection