@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Manage Stock Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Product Stock List</div>
			</div>

			<div class="col-md-12">
				<form method="post" class="btn-submit">
					<div class="form-group">
						<div class="input-group">
							<input type="text"  name="searchproductstock" id="searchproductstock" class="form-control" placeholder="Search Products..." style="height: 40px;">
							<button type="submit" class="border-0 text-light bg-success button" style="cursor: pointer; width: 50px;"><i class="fa fa-search"></i></button>
							<button type="button" class="border-0 text-light bg-success loading" style="cursor: pointer; width: 50px;"><i class="fa fa-spinner"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-tabless" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Product Name</th>
							<th>Purchase Price</th>
							<th>Sale Price</th>
							<th>Purchase Qty</th>
							<th>Sales Qty</th>
							<th>Available Qty</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showdata">
						
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						<tr id="tr{{ $d->id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $d->pdt_name_en }}<br>{{ $d->pdt_name_bn }}</td>
							<td>{{ $d->purchase_price_withcost }} Tk.</td>
							<td>{{ $d->sale_price }} Tk.</td>
							<td>{{ $d->quantity }}</td>
							<td>{{ $d->sales_qty }}</td>
							<td>{{ $d->quantity-$d->sales_qty }}</td>
		

						</tr>
						@endforeach
						@endif


					</tbody>
				</table>

				{{ $data->links() }}

			</div>
		</div>

	</div>
</div>

<!-------End Table--------->







<script type="text/javascript">



$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();

		let searchproductstock = $("#searchproductstock").val();

		$.ajax({
			url:'{{ url('searchproductstock') }}',
			method:'get',
			data:{searchproductstock:searchproductstock},
			beforeSend:function(response) { 
				$('.loading').show();
				$('.button').hide();

			},
			success:function(data){

				$('.loading').hide();
				$('.button').show();
				
				$("#showdata").html(data);

			},

			error:function(error){
				console.log(error)
			}
		});
	});

	


</script>


@endsection