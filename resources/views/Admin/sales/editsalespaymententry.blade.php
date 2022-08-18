@extends('Admin.layouts.index')
@section('content')



<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Edit Sales Payment</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Edit Sales Payment</div>
				<div><a href="{{ url('salespaymentlist') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Sales Payment List</a></div>
			</div>
			<div class="ibox-body">
				<form method="post"  class="reloadform myinput btn-submit" data-id="{{ $data->id }}">
					@csrf

					<div class="col-md-12 p-0 row">
						
						<div class="form-group col-md-4">
							<label>Customer Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<select class="form-control select2_demo_1" name="customer_id" id=
								"customer_id" required="" onchange="getcustomerphone()">
								<option value="">Select Customer</option>
								@php
								$customer = DB::table('customer_info')->where("Customer_branch_id",Auth('admin')->user()->branch)->get();		
								@endphp 
								@foreach($customer as $i)
								<option value="{{ $i->customer_id  }}" <?php if ($i->customer_id == $data->customer_id) {
									echo "selected";
								} ?>>{{ $i->customer_id }} - {{ $i->customer_name_en }}</option>
								@endforeach
							</select>
							<div class="input-group-addon border border-left-0" data-toggle="modal" data-target="#exampleModalCenters"><i class="fa fa-plus-circle text-primary"></i></div>
						</div>
					</div>


					<div class="form-group col-md-4">
						<label>Mobile Number:</label>
						<div class="input-group suppliermobile">
							<div class="input-group-addon"><i class="fa fa-phone"></i></div>
							<input type='number'  name='customer_phone' id='customer_phone' class='form-control' placeholder='Mobile' readonly="" value="{{ $customer_phone->customer_phone }}">
						</div>
					</div>



					<div class="form-group col-md-4">
						<label>Previous Due:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="text" name="due" id="due" class="form-control"  readonly="" value="{{ $totaldue }}">
							
						</div>
					</div>
					


					@php
					$explode = explode('-',$data->entry_date);
					$payment_date = $explode[0].'/'.$explode[1].'/'.$explode[2]; 
					@endphp

					<div class="form-group col-md-4">
						<label>Date:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							<input type="text" name="payment_date" id="payment_date2" placeholder="Payment Date" class="form-control" required="" autocomplete="off" value="{{ $payment_date }}">
							
						</div>
					</div>





					<div class="form-group col-md-4">
						<label>Payment Money:</label>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i></div>
							<input type="number" name="payment" id="payment" class="form-control" required="" value="{{ $data->payment_amount }}">
							
						</div>
					</div>




					<div class="form-group col-md-4">
						<label>Payment By:</label>
						<div class="input-group">
							<select class="form-control" name="payment_type" id="payment_type">
								<option value="{{ $data->payment_type }}">{{ $data->payment_type }}</option>
								<option value="Cash">Cash</option>
								<option value="Bank">Bank</option>
								<option value="Mobile Banking">Mobile Banking</option>

							</select>
							
						</div>
					</div>


					<div class="form-group col-md-4">
						<label>Comment:</label>
						<div class="input-group">
							<input type="text" name="comment" id="comments" placeholder="Comment" class="form-control" value="{{ $data->note }}">
							
						</div>
					</div>




				</div>


				<div class="col-12 border p-4 mt-4">
					<center><input type="submit" value="Submit Now" class="btn btn-success button" style="width: 200px; font-weight: bold; border-radius: 30px;"></center>

					<center><input type="button" value="Loading..." class="btn btn-success loading" style="width: 200px; font-weight: bold; border-radius: 30px;"></center>
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



	function getcustomerphone(){
		let customer_id = $("#customer_id").val();
		$.ajax({
			url: "{{ url('getcustomerphone') }}/"+customer_id,
			type: 'get',
			success: function (response)
			{
				$("#customer_phone").val(response);
				previousdue();
			},
			error:function(errors){
				alert("Select Customer")
			}
		});

	}



	function previousdue(){
		let customer_id = $("#customer_id").val();
		$.ajax({
			url: "{{ url('getcustomerpreviousdue') }}/"+customer_id,
			type: 'get',
			success: function (data)
			{
				$("#due").val(data);
				
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
		var id = $(this).data("id");

		$.ajax({
			url:'{{ url('updatesalespayment') }}/'+id,
			method:'POST',
			data:data,
			beforeSend:function(response) { 
				$('.loading').show();
				$('.button').hide();

			},
			success:function(response){

				Command:toastr["success"]("Update Payment Successfully Done")
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


				$('.loading').hide();
				$('.button').show();
				previousdue();



			},

			error:function(error){
				console.log(error)
			}
		});
	});





</script>


@endsection