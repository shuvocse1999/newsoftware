@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Customer Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Customer
				Setup List</div>
				<div><a href="{{ url('managecustomer') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View Customer</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit" >
					@csrf

					<div class="row myinput">
						@php
						$branch = DB::table('branch_info')->get();
						@endphp

						{{-- <div class="form-group col-md-4">
							<label>Branch Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="customer_branch_id" id="customer_branch_id">
									<option value="">Select Branch</option>
									@if(isset($branch))
									@foreach($branch as $c)
									<option value="{{ $c->branch_id }}">{{ $c->branch_name_en }}</option>
									@endforeach
									@endif

								</select>
							</div>
						</div>
						--}}

						<input type="hidden" name="customer_branch_id" id="customer_branch_id" value="{{ Auth("admin")->user()->id }}">


						<div class="form-group col-md-4">
							<label>Customer Name(EN): <span class="text-danger" style="font-size: 15px;">*</span></label>
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


						<div class="form-group col-md-4">
							<label>Customer Mobile:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="number" name="customer_phone" id="customer_phone"  placeholder="Customer Mobile">
							</div>
						</div>

						<div class="form-group col-md-4">
							<label>Email:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input class="form-control" type="text"  name="customer_email" id="customer_email" placeholder="Customer Email">
							</div>
						</div>


						<div class="form-group col-md-6">
							<label>Address:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<textarea class="form-control" rows="3" name="customer_address" id="customer_address"  placeholder="Customer Address"></textarea>
							</div>
						</div>



						<div class="modal-footer border-0 col-12">
							<button type="button" class="btn btn-secondary border-0" onClick="window.location.reload();">Close</button>
							<button type="submit" class="btn btn-success button border-0">Save</button>
							<button type="button" class="btn btn-success loading border-0">Loading...</button>
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
			url:'{{ url('customerinsert') }}',
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

				$('#customer_name_en').val('');
				$('#customer_name_bn').val('');
				$('#customer_email').val('');
				$('#customer_phone').val('');
				$('#customer_address').val('');
				$('.loading').hide();
				$('.button').show();


			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data


</script>





@endsection