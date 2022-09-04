@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Product Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Product
				Setup List</div>
				<div><a href="{{ url('manageproduct') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View Product</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit">
					@csrf

					<div class="row myinput">

						<div class="col-md-6 row">
							

							<div class="form-group col-md-6">
								<label>Item Name:<span class="text-danger" style="font-size: 15px;">*</span></label>
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


							</div>

						</div>


						<div class="form-group col-md-6">
							<label>Category Name:</label>
							<div class="input-group">

								<select class="form-control" name="pdt_cat_id" id="pdt_cat_id" onchange="getsubcat()">
									<option value="">Select Category</option>
									{{-- @php
									$category = DB::table('pdt_category')->where('cat_status',1)->get();		
									@endphp 
									@foreach($category as $c)
									<option value="{{ $c->cat_id  }}">{{ $c->cat_name_en }} ( {{ $c->cat_name_bn }} )</option>
									@endforeach --}}
								</select>
								<div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters"><i class="fa fa-plus-circle text-primary"></i></div>
							</div>

						</div>


						<div class="form-group col-md-6">
							<label>Subcategory Name:</label>
							<div class="input-group">

								<select class="form-control" name="pdt_subcat_id" id="pdt_subcat_id">
									<option value="">Select Subcategory</option>
									{{-- @php
									$subcategory = DB::table('pdt_subcategory')->where('subcat_status',1)->get();		
									@endphp 
									@foreach($subcategory as $c)
									<option value="{{ $c->subcat_id  }}">{{ $c->subcat_name_en }} ( {{ $c->subcat_name_bn }} )</option>
									@endforeach --}}
								</select>
								
							</div>
						</div>



						<div class="form-group col-md-6">
							<label>Brand Name: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								
								<select class="form-control" name="pdt_brand_id" required="">
									<option value="">Select Brand</option>
									@php
									$brand = DB::table('pdt_brand')->where('brand_status',1)->get();		
									@endphp 
									@foreach($brand as $c)
									<option value="{{ $c->brand_id  }}">{{ $c->brand_name_en }} ( {{ $c->brand_name_bn }} )</option>
									@endforeach
								</select>
								<div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters2"><i class="fa fa-plus-circle text-primary"></i></div>
							</div>
						</div>



						<div class="form-group col-md-12">
							<label>Product Name(EN): <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_name_en" id="pdt_name_en"required="">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Product Name(BN):</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_name_bn" id="pdt_name_bn">
							</div>
						</div>
						

						<div class="form-group col-md-12">
							<label>Measurement:</label>
							<select class="form-control" name="pdt_measurement">
								<option value="">Select Measurement</option>
								@php
								$measurement = DB::table('measurement_unit')->get();		
								@endphp 
								@foreach($measurement as $c)
								<option value="{{ $c->measurement_id  }}">{{ $c->measurement_unit }}</option>
								@endforeach
							</select>
						</div>






						<div class="form-group col-md-6 d-none">
							<label>Over Stock:</label>
							<div class="input-group">
								<input class="form-control" type="number" name="pdt_over_stock" id="pdt_over_stock">
							</div>
						</div>


						<div class="form-group col-md-6 d-none">
							<label>Shelf No:</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_shelf_no" id="pdt_shelf_no">
							</div>
						</div>


						<div class="form-group col-md-6 d-none">
							<label>Order Qty:</label>
							<div class="input-group">
								<input class="form-control" type="number" name="pdt_order_qunt" id="pdt_order_qunt">
							</div>
						</div>

						<div class="form-group col-md-6 d-none">
							<label>Suspension:</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_suspension" id="pdt_suspension">
							</div>
						</div>

						<div class="form-group col-md-12 d-none">
							<label>Product URL:</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_url" id="pdt_url">
							</div>
						</div>


					</div>

					<div class="col-md-6">

						<div class="form-group col-md-12">
							<label>Purchase Price:</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_purchase_price" id="pdt_purchase_price" value="0">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Sale Price:</label>
							<div class="input-group">
								<input class="form-control" type="text" name="pdt_sale_price" id="pdt_sale_price" value="0">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Status:</label>
							<div class="input-group">
								<select class="form-control" name="pdt_status" id="pdt_status">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>



						<div class="form-group col-md-12 d-none">
							<label>Short Details:</label>
							<div class="input-group">
								<textarea class="form-control" rows="10" name="pdt_short_details" id="pdt_short_details"></textarea>
							</div>
						</div>


						<div class="form-group col-md-12 d-none">
							<label>Full Details:</label>
							<div class="input-group">
								<textarea class="form-control" rows="10" name="pdt_details" id="pdt_details"></textarea>
							</div>
						</div>

						<div class="form-group col-md-12 d-none">
							<label>Condition:</label>
							<div class="input-group">
								<textarea class="form-control" rows="10" name="pdt_condition" id="pdt_condition"></textarea>
							</div>
						</div>	

						






						<br><br>

						<div class="modal-footer border-0">
							<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
							<button type="submit" class="btn btn-success button border-0">Save</button>
							<button type="button" class="btn btn-success loading border-0">Loading...</button>
						</div>

					</div>











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








<!-- Supplier Modal -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Category</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">

				<form method="post" action="{{ url("categoryinsert2") }}">
					@csrf
					<div class="row">

						<div class="form-group col-md-12">
							<label>Item Name: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="cat_item_id" required="" style="width: 100%!important;">
									<option value="">Select Item</option>
									@php
									$item = DB::table('pdt_item')->where('item_status',1)->get();		
									@endphp 
									@foreach($item as $i)
									<option value="{{ $i->item_id  }}">{{ $i->item_name_en }} ( {{ $i->item_name_bn }} )</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>Category Name(EN): <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="cat_name_en" id="cat_name_en" placeholder="Category Name(EN)" required="">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Category Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="cat_name_bn" id="cat_name_bn" placeholder="Category Name(BN)">
							</div>
						</div>

						
						<div class="form-group col-md-6">
							<label>Category URL:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-link"></i></div>
								<input class="form-control" type="url" placeholder="Category URL" name="cat_url" id="cat_url">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Status: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="cat_status" id="cat_status" style="width: 100%!important;">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>


					<br>

					<div class="modal-footer border-0">
						<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
						<button type="submit" class="btn btn-success button border-0">Save</button>
					</div>
					
				</form>



			</div>


		</div>
	</div>
</div>
<!--End Supplier Modal -->








<!-- Supplier Modal -->
<div class="modal fade" id="exampleModalCenters2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Brand</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">

				<form method="post" action="{{ url("brandinsert2") }}">
					@csrf
					

					<div class="row">
						<div class="form-group col-md-12">
							<label>Brand Name(EN): <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="brand_name_en" id="brand_name_en" placeholder="Brand Name(EN)" required="">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Brand Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="brand_name_bn" id="brand_name_bn" placeholder="Brand Name(BN)">
							</div>
						</div>

						
						<div class="form-group col-md-12">
							<label>Status: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="brand_status" id="brand_status" style="width: 100%!important;">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>

					<br>

					<div class="modal-footer border-0">
						<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
						<button type="submit" class="btn btn-success button border-0">Save</button>
					</div>
					
				</form>



			</div>


		</div>
	</div>
</div>
<!--End Supplier Modal -->



@endsection