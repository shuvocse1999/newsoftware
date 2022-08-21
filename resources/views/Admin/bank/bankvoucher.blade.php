
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
				<td colspan="5" style="text-align:center;font-size: 16px;text-transform: uppercase;font-weight: bold;"><b>Bank Transaction Voucher</b></td>
			</tr>
			<tr>
				<td colspan="2">
					Date : {{ $data->deposit_withdraw_date }}<br>
					Voucher/Cheque/TrnID No : {{ $data->vouchar_cheque_no }} <br>
					Bank Info : {{ $data->bank_name }}, {{ $data->account_number }}

				</td>
				<td colspan="3">
					Transaction : {{ $data->transaction_type }}<br>
					Prepared By : {{ $data->name }}<br>
					Print  : {{ date("d M Y") }}<br>
				</tr>



				<!-- <thead> -->
					<tr>
						<th>Date</th>
						<th>Bank Name</th>
						<th>Account Number</th>
						<th>Transaction Type</th>
						<th>Amount</th>

					</tr>
					<!-- </thead> -->



					<tbody>


						@if(isset($data))

						<tr>
							<td>{{ $data->deposit_withdraw_date }}</td>
							<td>{{ $data->bank_name }}</td>
							<td>{{ $data->account_number }}</td>
							<td>{{ $data->transaction_type }}</td>
							<th>{{ $data->deposit_withdraw_amount }}/-</th>
						</tr>
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