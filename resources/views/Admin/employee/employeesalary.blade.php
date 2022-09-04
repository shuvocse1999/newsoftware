@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Employee Salary Payment</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Employee
				Salary Payment</div>
				<div><a href="{{ url('manageemployeesalary') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-eye"></i>&nbsp;View Employee Salary</a></div>
			</div>
			<div class="ibox-body">
				<form method="post" class="btn-submit" >
					@csrf

					<div class="row myinput">
						
						<div class="form-group col-md-4">
							<label>Employee Name:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<select class="form-control select2_demo_1" name="employee_id" id=
								"employee_id" required="" onchange="getemployeebalance()">
								<option value="">Select Employee</option>
								@php
								$employee = DB::table('employee_info')->where("branch",Auth('admin')->user()->branch)->get();		
								@endphp 
								@foreach($employee as $i)
								<option value="{{ $i->id  }}">{{ $i->id }} - {{ $i->employee_name }}</option>
								@endforeach
							</select>
							<div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters"><i class="fa fa-plus-circle text-primary"></i></div>
						</div>
					</div>




					<div class="form-group col-md-4">
						<label>Balance:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input class="form-control" type="text" name="balance" id="balance" required="" placeholder="0.00" readonly="">
						</div>
					</div>



					<div class="form-group col-md-4">
						<label>Withdraw:<span class="text-danger" style="font-size: 15px;">*</span></label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input class="form-control" type="number"  name="salary_withdraw" id="salary_withdraw" placeholder="Withdraw" required="">
						</div>
					</div>



					<div class="form-group col-md-4">
						<label>Transaction Type:<span class="text-danger" style="font-size: 15px;">*</span></label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
							<input class="form-control" type="text" name="transaction_type" id="transaction_type"  placeholder="Transaction Type" required="">
						</div>
					</div>


					<div class="form-group col-md-4">
						<label>Date:<span class="text-danger" style="font-size: 15px;">*</span></label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
							<input class="form-control" type="date" name="payment_dates" id="payment_dates"  placeholder="" required="">
						</div>
					</div>





					<div class="form-group col-md-8">
						<label>Comment:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
							<textarea class="form-control" rows="3" name="note" id="note" placeholder="Comment"></textarea>
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


	function getemployeebalance(){
		let employee_id = $("#employee_id").val();
		$.ajax({
			url: "{{ url('getemployeebalance') }}/"+employee_id,
			type: 'get',
			success: function (response)
			{
				$("#balance").val(response);
			},
			error:function(errors){
				alert("Select Customer")
			}
		});

	}



	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('employeesalaryinsert') }}',
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

				$('#employee_id').val('');
				$('#balance').val('');
				$('#salary_withdraw').val('');
				$('#transaction_type').val('');
				$('#payment_dates').val('');
				$('#note').val('');
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