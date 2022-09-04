@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">All Sales Ledger</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Sales Ledger</div>
				<div><a href="{{ url('sales') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Sales</a></div>
			</div>

			<div class="">

				
				
				<form method="get" style="max-width: 800px; margin:0 auto;">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="fromdate" id="fromdate" placeholder="From Date" class="form-control" required="" autocomplete="off">

								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<input type="text" name="todate" id="todate" placeholder="To Date" class="form-control" required="" autocomplete="off">
									<button type="button" class="border text-success button" style="cursor: pointer; width: 50px;" onclick="searchsalesinvoice()"><i class="fa fa-search"></i></button>
									<button type="button" class="border text-success loading" style="cursor: pointer; width: 50px;"><i class="fa fa-spinner"></i></button>

								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<div class="input-group">
									<input type="text"  name="invoice_no" id="invoice_no" class="form-control" placeholder="Invoice No" style="height: 40px;">
										<button type="button" class="border text-success button" style="cursor: pointer; width: 50px;" onclick="searchsalesinvoice2()"><i class="fa fa-search"></i></button>

										<button type="button" class="border text-success loading" style="cursor: pointer; width: 50px;"><i class="fa fa-spinner"></i></button>
								</div>
							</div>
						</div>
					</div>
				</form>
				
			</div>

			<div class="ibox-body table-responsive overflow">

				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Invoice Date</th>
							<th>Entry Date</th>
							<th>Invoice No.</th>
							<th>Customer Info.</th>
							<th>Transaction</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showdata">
						
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						<tr id="tr{{ $d->id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $d->invoice_date }}</td>
							<td>{{ $d->entry_date }}</td>
							<td>{{ $d->invoice_no }}</td>
							<td>{{ $d->customer_name_en }}, {{ $d->customer_phone }}</td>
							<td>{{ $d->transaction_type }}</td>

							
							<td>
								<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
								<a href="{{ url('invoicesalesa4/'.$d->invoice_no) }}" target="_blank"  class="btn btn-info  border-0 text-light"><i class="fa fa-eye"></i></a>
								<a href="{{ url('invoicesales/'.$d->invoice_no) }}" target="_blank"  class="btn btn-success  border-0 text-light"><i class="fa fa-print"></i></a>
							</td>

						</tr>
						@endforeach
						@endif


						
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<!-------End Table--------->





<script type="text/javascript">

	$(".delete").click(function(){
		let id = $(this).data('id');


		swal({
			title: "Are you sure?",
			icon: "info",
			buttons: true,
			dangerMode: true,

		})
		.then((willDelete) => {
			if (willDelete) {

				$.ajax(
				{
					url: "{{ url('deletesalesledger') }}/"+id,
					type: 'get',
					success: function()
					{
						$('#tr'+id).hide();

						Command:toastr["warning"]("Delete Successfully Done")
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


					},
					errors:function(){
						Command:toastr["danger"]("Data Delete Unsuccessfully")


					}
				});

			}
		});

	});

	// End Delete Data


	$('.loading').hide();
	function searchsalesinvoice(){

		let fromdate = $("#fromdate").val();
		let todate = $("#todate").val();
		let invoice_no = $("#invoice_no").val();


		$.ajax({
			url:'{{ url('searchsalesinvoice') }}',
			method:'GET',
			data:{fromdate:fromdate,todate:todate,invoice_no:invoice_no},
			beforeSend:function(response) { 
				$('.loading').show();
				$('.button').hide();

			},
			success:function(data){

				$("#showdata").html(data);
				$('.loading').hide();
				$('.button').show();

			},

			error:function(error){
				alert("Enter From date and To Date");
				$('.loading').hide();
				$('.button').show();

			}
		});


	// End Add Data

}





	$('.loading').hide();
	function searchsalesinvoice2(){

		let fromdate = $("#fromdate").val();
		let todate = $("#todate").val();
		let invoice_no = $("#invoice_no").val();


		$.ajax({
			url:'{{ url('searchsalesinvoice2') }}',
			method:'GET',
			data:{fromdate:fromdate,todate:todate,invoice_no:invoice_no},
			beforeSend:function(response) { 
				$('.loading').show();
				$('.button').hide();

			},
			success:function(data){

				$("#showdata").html(data);
				$('.loading').hide();
				$('.button').show();

			},

			error:function(error){
				alert("Enter Invoice No");
				$('.loading').hide();
				$('.button').show();

			}
		});


	// End Add Data

}


</script>


@endsection