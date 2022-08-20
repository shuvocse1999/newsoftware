
<!DOCTYPE html>
<html>
<head>
	<title>Bank Transaction Reports</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>


	@php
	$company_info = DB::table("company_info")->first();

	@endphp


	<div class="invoice border">

		<center><img src="{{ url($company_info->banner) }}" id="header_image" class="img-fluid"></center>


		<table class="table table-bordered">
			<tr>

				<td colspan="9" style="text-align:center;font-size: 16px;text-transform: uppercase;"><b>Bank Transaction Reports</b>
					<br>
					<div style="font-size: 13px;">



					</div>
				</td>
			</tr>
			<tr>

			</tr>



			<!-- <thead> -->
				<tr>
					<th>SL</th>
					<th>Bank Name</th>
					<th>Account Number</th>
					<th>Deposit</th>
					<th>Withdraw</th>
					<th>Cost</th>
					<th>Interest</th>
					<th>Balance</th>

				</tr>
				<!-- </thead> -->



				<tbody>

					@php
					 $i=1;
					 $totaldeposit = 0;
					 $totalwithdraw = 0;
					 $totalcost = 0;
					 $totalinsterest = 0;
					@endphp
					@if(isset($data))
					@foreach($data as $d)
					
			{{-- 		@if($d->transaction_type == "Deposit")
					 @php
					   $totaldeposit += $d->deposit_withdraw_amount;
					 @endphp
					@endif
					
 --}}
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $d->bank_name }}</td>
						<td>{{ $d->account_number }}</td>
						<td>
							@if($d->transaction_type == "Deposit")
							{{ $d->deposit_withdraw_amount }}
							@else
							0
							@endif
						</td>

						<td>
							@if($d->transaction_type == "Withdraw")
							{{ $d->deposit_withdraw_amount }}
							@else
							0
							@endif
						</td>

						<td>
							@if($d->transaction_type == "Bank-Cost")
							{{ $d->deposit_withdraw_amount }}
							@else
							0
							@endif
						</td>

						<td>
							@if($d->transaction_type == "Bank-Insterest")
							{{ $d->deposit_withdraw_amount }}
							@else
							0
							@endif
						</td>

						<td>
							
						</td>
						

					</tr>

					@endforeach
					@endif



				</tbody>



			</table>




			<br>
			<center><a href="#" class="btn btn-danger btn-sm print w-10" onclick="window.print();">Print</a></center>
			<br>


		</div>






		<style type="text/css">

			body{
				font-family: 'Lato';
			}


			.invoice{
				background: #fff;
				border:none!important;
				padding:30px;

			}

			.invoice span{
				font-size: 15px;
			}

			thead{
				font-size: 15px;
			}

			tbody{
				font-size: 13px;
			}

			.table-bordered td, .table-bordered th{
				border: 1px solid #585858 !important;
				box-shadow: none;
				border-bottom: 1px solid #585858;
			}

			.table-bordered tr{
				border: 1px solid #585858 !important;
			}


			tbody {
				border: none !important;
			}


			@media  print
			{

				.table-bordered tr{
					border: 1px solid #585858 !important;
				}

				@page  {
					/*size: 7in 15.00in;*/
					margin: 1mm 1mm 1mm 1mm;
					padding: 10px;
				}

				.print{
					display: none;
				}

				.invoice span{
					font-size: 22px;
				}
				/*@page  { size: 10cm 20cm landscape; }*/

			}


		</style>


	</body>
	</html>