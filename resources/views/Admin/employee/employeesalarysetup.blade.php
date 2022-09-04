@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Employee Salary Setup</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Employee Salary List</div>
				<div><a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Add New</a></div>
			</div>


			<div class="col-md-12 p-4">
				<form method="post" action="{{ url("depositeemployeesalary") }}">
					@csrf
					<div class="row align-items-center">



						<div class="col-md-1 font-weight-bold">
							<input type="checkbox" id="checkAll"> Select All
						</div>
						<div class="col-md-2">
							<select class="form-control" name="month" required="">
								<option value="">Select Month</option>
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August </option>
								<option value="09">September </option>
								<option value="10">October </option>
								<option value="11">November </option>
								<option value="12">December </option>
							</select>
						</div>
						<div class="col-md-2">
							<select class="form-control" name="year" required="">
								<option value="">Select Year</option>
								<option value="<?php echo date('Y'); ?>"><?php echo date("Y"); ?></option>
								<option value="2021">2021</option>
								<option value="2020">2020</option>
								<option value="2019">2019</option>
								<option value="2018">2018</option>
								<option value="2017">2017</option>
								<option value="2016">2016</option>
								<option value="2015">2015 </option>
							</select>
						</div>


						<div class="col-md-2">
							<input type="submit" name="" value="Submit Now" class="btn btn-success">
						</div>

					</div>





				</div>


				<div class="ibox-body table-responsive overflow">
					<table class="table table-striped table-bordered" id="example-tables" cellspacing="0" width="100%">
						<thead class="mythead">
							<tr>
								<th>SL</th>
								<th>Employee Name</th>
								<th>Salary</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody class="tbody" id="showtdata">

							@php $i=1;  @endphp
							@if(isset($data))
							@foreach($data as $d)
							<tr id="tr{{ $d->id }}">
								<td><input name='depositeemployee_id[]' type="checkbox" id="depositeemployee_id" value="{{ $d->employee_id }}"> {{ $i++ }}</td>

								<td>{{ $d->employee_name }}</td>
								<th>{{ $d->employee_salary }}/-</th>
								<td>
									@if($d->salary_status == 1)
									<span class="btn btn-success btn-sm border-0">Active</span>
									@else
									<span class="btn btn-warning btn-sm border-0">Inactive</span>
									@endif
								</td>
								<td>
									<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->id }}"><i class="fa fa-pencil-square-o"></i></a>
									<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
								</td>

							</tr>
							@endforeach
							@endif




						</form>
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
					<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Employee Salary Setup</h5>
					<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body myinput">

					<div class="row">


						@php
						$employee = DB::table('employee_info')->where('status',1)->where("branch",Auth('admin')->user()->id)->get();
						@endphp

						<div class="form-group col-md-12">
							<label>Employee Name:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="employee_id" id="employee_id" required="" style="width: 100%!important;">
									<option value="">Select Employee</option>
									@if(isset($employee))
									@foreach($employee as $c)
									<option value="{{ $c->id }}">{{ $c->employee_name }}</option>
									@endforeach
									@endif

								</select>
							</div>
						</div>



						<div class="form-group col-md-12">
							<label>Salary:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input type="number" name="employee_salary" id="employee_salary" placeholder="Salary" class="form-control" required="">
							</div>
						</div>


						
						<div class="form-group col-md-12">
							<label>Status:<span class="text-danger" style="font-size: 15px;">*</span></label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="salary_status" id="salary_status" style="width: 100%!important;" required="">
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
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update Employee Salary Setup</h5>
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


	// showdata();

	// function showdata(){
	// 	$.ajax(
	// 	{
	// 		url: "{{ url('getemployeesalarysetup') }}",
	// 		type: 'get',
	// 		data:{},
	// 		success: function(data)
	// 		{
	// 			$("#showtdata").html(data);
	// 		}
	// 	});

	// }

	// End Get Data


	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('employeesalarysetupinsert') }}',
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
				$('#employee_salary').val('');
				$('.loading').hide();
				$('.button').show();
				$('#exampleModalCenter').modal('hide');

				showdata();

			},

			error:function(error){
				alert("Employee Salary Already Added");
				window.location.href="";
			}
		});
	});

	// End Add Data


</script>



<script language="javascript">
	$("#checkAll").click(function () {
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
</script>

@endsection