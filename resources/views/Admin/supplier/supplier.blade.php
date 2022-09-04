@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Supplier Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Supplier
				Setup List</div>
				<div><a href="{{ url('managesupplier') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View supplier</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit">
					@csrf

					<div class="row myinput">
						@php
						$branch = DB::table('branch_info')->get();
						@endphp

						{{-- <div class="form-group col-md-4">
							<label>Branch Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="supplier_branch_id" id="supplier_branch_id">
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

						<input type="hidden" name="supplier_branch_id" id="supplier_branch_id" value="{{ Auth("admin")->user()->branch }}">


						<div class="form-group col-md-4">
							<label>Supplier Name(EN): <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="supplier_name_en" id="supplier_name_en"  required="">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Supplier Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="supplier_name_bn" id="supplier_name_bn" >
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>Supplier Mobile:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="number" name="supplier_phone" id="supplier_phone" >
							</div>
						</div>

						<div class="form-group col-md-4">
							<label>Email:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input class="form-control" type="text"  name="supplier_email" id="supplier_email">
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>Supplier Address:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<input type="text" class="form-control" name="supplier_address" id="supplier_address">
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-md-12 mb-3 text-danger border p-3 text-center">Company Details:</div>
						</div>

						<div class="form-group col-md-4">
							<label>Company name: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text"  name="supplier_company_name" id="supplier_company_name" required="">
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>Company Phone:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="text" name="supplier_company_phone" id="supplier_company_phone">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Company Address:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<input type="text" class="form-control" name="supplier_company_address" id="supplier_company_address">
							</div>
						</div>




						<div class="modal-footer border-0">
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
			url:'{{ url('supplierinsert') }}',
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

				$('#supplier_name_en').val('');
				$('#supplier_name_bn').val('');
				$('#supplier_email').val('');
				$('#supplier_phone').val('');
				$('#supplier_address').val('');
				$('#supplier_company_name').val('');
				$('#supplier_company_phone').val('');
				$('#supplier_company_address').val('');
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