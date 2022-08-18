@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Branch
		Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Branch
				Setup List</div>
				<div><a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Add New</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-tables" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>BRC. SL</th>
							<th>Com.Name</th>
							<th>Name(EN)</th>
							<th>Name(BN)</th>
							<th>Mobile</th>
							<th>Address(EN)</th>
							<th>Address(BN)</th>
							<th>Email</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showtdata">
						
						
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-------End Table--------->





<!-- Add Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<form method="post" class="btn-submit">
			@csrf
			<div class="modal-content rounded">
				<div class="modal-header bg-dark text-light">
					<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Branch Information</h5>
					<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body myinput">

					<div class="row">
						

						@php
						$company = DB::table('company_info')->get();
						@endphp

						<div class="form-group col-md-12">
							<label>Com. Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="company_id" id="company_id" style="width: 100%!important;">
									<option value="">Select Company</option>
									@if(isset($company))
									@foreach($company as $c)
									<option value="{{ $c->company_id }}">{{ $c->company_name_en }}</option>
									@endforeach
									@endif
									
								</select>
							</div>
						</div>



						<div class="form-group col-md-6">
							<label>Branch Name(EN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="branch_name_en" id="branch_name_en" placeholder="Branch Name(BN)" required="">
							</div>
						</div>



						<div class="form-group col-md-6">
							<label>Branch Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="branch_name_bn" id="branch_name_bn" placeholder="Branch Name(BN)">
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>Branch Mobile:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="number" name="branch_mobile" id="branch_mobile" placeholder="Branch Mobile" required="">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Address(EN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<textarea class="form-control" rows="3" name="branch_address_en" id="branch_address_en" required=""></textarea>
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Address(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<textarea class="form-control" rows="3" name="branch_address_bn" id="branch_address_bn"></textarea>
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Email:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input class="form-control" type="text" placeholder="Email" name="branch_email" id="branch_email">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Status:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="status" id="status" style="width: 100%!important;">
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary border-0" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success button border-0">Save</button>
					<button type="button" class="btn btn-success loading border-0">Loading...</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- End Add Modal -->





<!-- Edit Modal -->
<div class="modal fade" id="exampleModalCenters" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitles" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">

		<div class="modal-content rounded">
			<div class="modal-header bg-dark text-light">
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update Branch Information</h5>
				<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body editdata myinput">

				
			</div>


		</div>
	</div>
</div>
<!--End Edit Modal -->



<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	showdata();

	function showdata(){
		$.ajax(
		{
			url: "{{ url('getbranch') }}",
			type: 'get',
			data:{},
			success: function(data)
			{
				$("#showtdata").html(data);
			}
		});

	}

	// End Get Data


	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('branchinsert') }}',
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

				$('#branch_sl').val('');
				$('#branch_name_en').val('');
				$('#branch_name_bn').val('');
				$('#branch_mobile').val('');
				$('#branch_address_en').val('');
				$('#branch_address_bn').val('');
				$('#branch_email').val('');
				$('.loading').hide();
				$('.button').show();
				$('#exampleModalCenter').modal('hide');

				showdata();

			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data


</script>





@endsection