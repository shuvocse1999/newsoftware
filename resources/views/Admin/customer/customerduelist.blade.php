@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Customer Due List</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Customer Due List</div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Customer Name</th>
							<th>Phone</th>
							<th>Address</th>
							<th>Total Due</th>
						</tr>
					</thead>

					<tbody class="tbody">
						
						@php 
						$i=1; 
						$due =0;
						$duetotal = 0; 
						@endphp

						@if(isset($data))
						@foreach($data as $d)

						@php
						$total      = DB::table("sales_ledger")->where("customer_id",$d->customer_id)->sum('total');
						$discount   = DB::table("sales_ledger")->where("customer_id",$d->customer_id)->sum('final_discount');
						$grandtotal = $total-$discount;
						$paid       = DB::table("sales_payment")->where("customer_id",$d->customer_id)->sum('payment_amount');
						$due        = $grandtotal-$paid;

						$duetotal = $duetotal+$due;
						@endphp


						@if($due > 0)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $d->customer_id }} - {{ $d->customer_name_en }}</td>
							<td>{{ $d->customer_phone }}</td>
							<td>{{ $d->customer_address }}</td>
							<td>{{ $due }}/-</td>



						</tr>
						@endif
						@endforeach
						@endif


						
					</tbody>

					<tr>
						<th colspan="4" class="text-right">Grand Total:</th>
						<th>{{ $duetotal }}/-</th>
					</tr>
				</table>
			</div>
		</div>

	</div>
</div>

<!-------End Table--------->



@endsection