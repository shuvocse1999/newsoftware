@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Employee Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Employee
				Setup List</div>
				<div><a href="{{ url('manageemployee') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View Employee</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit" >
					@csrf

					<div class="row myinput">
						
						<div class="form-group col-md-4">
							<label>Employee Name:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="employee_name" id="employee_name"  required="" placeholder="Employee Name">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Employee Mobile:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-phone"></i></div>
								<input class="form-control" type="number" name="employee_phone" id="employee_phone" required="" placeholder="Employee Mobile">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>Email:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
								<input class="form-control" type="text"  name="employee_email" id="employee_email" placeholder="Employee Email">
							</div>
						</div>



						<div class="form-group col-md-4">
							<label>NID No:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="employee_nid" id="employee_nid"  placeholder="NID NO.">
							</div>
						</div>


						<div class="form-group col-md-4">
							<label>Joining Date:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="date" name="joining_date" id="joining_date"  placeholder="NID NO." required="">
							</div>
						</div>





						<div class="form-group col-md-8">
							<label>Address: <span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
								<textarea class="form-control" rows="3" name="employee_address" id="employee_address" required="" placeholder="Address"></textarea>
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
			url:'{{ url('employeeinsert') }}',
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

				$('#employee_name').val('');
				$('#employee_email').val('');
				$('#employee_phone').val('');
				$('#employee_address').val('');
				$('#joining_date').val('');
				$('#employee_nid').val('');
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