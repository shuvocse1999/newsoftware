@extends('Admin.layouts.index')
@section('content')



<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Purchase Ledger Reports</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Puchase Ledger List</div>
				<div><a href="{{ url('allpurchaseledger') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;All Purchase</a></div>
			</div>
			<div class="ibox-body">
				<form method="get" action="{{ url("purchaseledgerreports") }}" class="reloadform myinput" target="_blank">
					@csrf

					<div class="col-md-12 p-0 row">
						

						<div class="form-group col-md-3">
							<label>Supplier Name</label>
							<select class="form-control select2_demo_1" name="suplier_id" id=
							"suplier_id" required="">
							<option value="All">Select Supplier</option>
							@php
							$supplier = DB::table('supplier_info')->get();		
							@endphp 
							@foreach($supplier as $i)
							<option value="{{ $i->supplier_id  }}">{{ $i->supplier_name_en }}  {{ $i->supplier_name_bn }}</option>
							@endforeach
						</select>
					</div>



					<div class="form-group col-md-3">
						<label>Report Type</label>
						<select  name ="Type"  id="Type" class="form-control textfill select2_demo_1" onchange="showReport()" required="">
							<option value="">Select Report Type</option>
							<option value="1">Daily</option>
							<option value="2">Date To Date</option>
							<option value="3">Monthly</option>
							<option value="4">Yearly</option>

						</select>

					</div>

					

					<div class="form-group col-md-2" id="firstdate" style="display:none">
						<label class="control-label">Start Date</label> <input type="date" class="form-control" placeholder="Start Date"  name="start_date" id="start_date" value="{{  date('d-m-Y') }}">
					</div>


					<div class="form-group col-md-2"  id="seconddate" style="display:none">
						<label class="control-label">End Date</label> <div class="controls"> <input type="date" class="form-control" placeholder="End Date"  name="end_date" id="end_date" value="{{  date('d-m-Y') }}"></div>
					</div>


					<div class="form-group col-md-2" id="first">
						
					</div>


					<div class="form-group col-md-2"  id="second">
						
					</div>



				</div>


			</div>


			<div class="col-12 border p-4 mt-4">
				<center><input type="submit" name="" value="Search Reports" class="btn btn-success" style="width: 200px; font-weight: bold; border-radius: 30px;"></center>
			</div>


		</form>

	</div>
</div>

</div>
</div>


<script type="text/javascript">
	function showReport(){

		$('#second').html('');
		$('#first').html('');
		var type = $('#Type').val();
		if(type==''){
			$('#second').html('');
			$('#first').html('');
		}
		else{


			if(type==='1'){

				$('#second').html('');
				$('#first').html('');
				$('#firstdate').css('display','block');
				$('#seconddate').css('display','none');

			}
			else if(type==='3'){
				$('#firstdate').css('display','none');
				$('#seconddate').css('display','none');
				$('#second').html('');
				$('#first').html('');        

				$('#first').append('<label class="control-label ">Select Month</label> <div class="controls"> <select  name="month"  id="month" class="form-control select2_demo_1"><option value="01">January</option><option value="02">February</option><option value="03">March</option> <option value="04">April</option> <option value="05">May</option> <option value="06">June</option> <option value="07">July</option><option value="08">August </option> <option value="09">September </option> <option value="10">October </option> <option value="11">November </option>  <option value="12">December </option></select></div>');

				$('#second').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year" id="year"   class=" form-control" value="{{date('Y')}}"> </div>');
			}else if(type==='4')
			{
				$('#firstdate').css('display','none');
				$('#seconddate').css('display','none');

				$('#second').html('');
				$('#first').html('');
				$('#first').append('<label class="control-label">Year</label><div class="controls"><input type="text" name="year"  id="year"  placeholder="2021" class=" form-control" value="{{date('Y')}}"> </div>');

			}else if(type==='2')
			{
				$('#first').html('');
				$('#second').html('');

				$('#firstdate').css('display','block');
				$('#seconddate').css('display','block');

			}



			else{

				$('#second').html('');
				$('#first').html('');
			}



		}



	}




	function resetledger()
	{
		location.reload();
		
	}

</script>


@endsection