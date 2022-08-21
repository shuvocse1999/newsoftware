
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
				<td colspan="4" style="text-align:center;font-size: 16px;text-transform: uppercase;font-weight: bold;"><b>Bank Statement Reports</b><br>



					@if($type == "1")
					<span>Date :&nbsp;&nbsp;{{$date1}} </span>
					@endif

					@if($type == "3")

					<span>Month :&nbsp;&nbsp;
						@if($month ==='01')(January)@endif
						@if($month ==='02')(February)@endif
						@if($month ==='03')(March)@endif
						@if($month ==='04')(April)@endif
						@if($month ==='05')(May)@endif
						@if($month ==='06')(June)@endif
						@if($month ==='07')(July)@endif
						@if($month ==='08')(August)@endif
						@if($month ==='09')(September)@endif
						@if($month ==='10')(October)@endif
						@if($month ==='11')(November)@endif
						@if($month ==='12')(December)@endif 
					</span>

					@endif

					@if($type == "4")

					<span>Year :&nbsp;&nbsp;{{$year}}
					</span>

					@endif

					@if($type == "2" )

					<span>From :&nbsp;&nbsp;{{$date1}} - To :&nbsp;&nbsp;{{$date2}} </span>

					@endif

				</tr>

				@if(isset($data[0]))

				<tr>
					<th>Bank Name</th>
					<td>{{ $data[0]->bank_name }}</td>
					<th>Account Number</th>
					<td>{{ $data[0]->account_number }}</td>


				</tr>

				<tr>
					<th>Account Type</th>
					<td>{{ $data[0]->account_type }}</td>

					<th>Print Date</th>
					<td>{{ date('d M Y') }}</td>
				</tr>

				@endif

			</table>

			<table class="table table-bordered">

				<!-- <thead> -->
					<tr>
						<th>SL</th>
						<th>Date</th>
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

						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $d->deposit_withdraw_date }}</td>
							<td>
								@if($d->transaction_type == "Deposit")
								@php
								$totaldeposit += $d->deposit_withdraw_amount;
								@endphp
								{{ $d->deposit_withdraw_amount }}
								@else
								-
								@endif
							</td>

							<td>
								@if($d->transaction_type == "Withdraw")
								@php
								$totalwithdraw += $d->deposit_withdraw_amount;
								@endphp
								{{ $d->deposit_withdraw_amount }}
								@else
								-
								@endif
							</td>

							<td>
								@if($d->transaction_type == "Bank-Cost")
								@php
								$totalcost += $d->deposit_withdraw_amount;
								@endphp
								{{ $d->deposit_withdraw_amount }}
								@else
								-
								@endif
							</td>

							<td>
								@if($d->transaction_type == "Bank-Insterest")
								@php
								$totalinsterest += $d->deposit_withdraw_amount;
								@endphp
								{{ $d->deposit_withdraw_amount }}
								@else
								-
								@endif
							</td>

							<td>
								{{ ($totaldeposit+$totalinsterest)-($totalwithdraw+$totalcost) }}
							</td>


						</tr>

						@endforeach
						@endif



					</tbody>

					<tr>
						<th colspan="2" class="text-right">Total</th>
						<th>{{ $totaldeposit }}/-</th>
						<th>{{ $totalwithdraw }}/-</th>
						<th>{{ $totalcost }}/-</th>
						<th>{{ $totalinsterest }}/-</th>
						<th>{{ ($totaldeposit+$totalinsterest)-($totalwithdraw+$totalcost) }}/-</th>
					</tr>



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