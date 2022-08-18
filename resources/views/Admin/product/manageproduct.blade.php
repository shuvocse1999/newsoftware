@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Manage Product Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Manage Product List</div>
				<div><a href="{{ url('product') }}" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Add New</a></div>
			</div>

			<div class="col-md-12">
				<form method="post" class="btn-submit">
					<div class="form-group">
						<div class="input-group">
							<input type="text"  name="searchproduct" id="searchproduct" class="form-control" placeholder="Search Products..." style="height: 40px;">
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
							<th>Item</th>
							<th>Name</th>
							<th>Purchase</th>
							<th>Sale</th>
							<th>Measurement</th>
							<th>Over Stock</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showdata">
						
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						<tr id="tr{{ $d->pdt_id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $d->item_name_en }}<br>{{ $d->item_name_bn }}</td>
							<td>{{ $d->pdt_name_en }}<br>{{ $d->pdt_name_bn }}</td>
							<td>{{ $d->pdt_purchase_price }} Tk.</td>
							<td>{{ $d->pdt_sale_price }} Tk.</td>
							<td>{{ $d->measurement_unit }}</td>
							<td>{{ $d->pdt_over_stock }}</td>
							<td>
								@if($d->pdt_status == 1)
								<span class="btn btn-success btn-sm border-0">Active</span>
								@else
								<span class="btn btn-warning btn-sm border-0">Inactive</span>
								@endif
							</td>
							
							
							<td>
								<a href="{{ url('editproduct/'.$d->pdt_id) }}"  class="btn btn-info border-0 edit text-light" ><i class="fa fa-pencil-square-o"></i></a>
								<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->pdt_id }}"><i class="fa fa-trash-o"></i></a>
							</td>

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

	$(".delete").click(function(){
		let id = $(this).data('id');
		
		$.ajax(
		{
			url: "{{ url('deleteproduct') }}/"+id,
			type: 'get',
			success: function()
			{
				$('#tr'+id).hide();

				Command:toastr["warning"]("Data Delete Successfully Done")
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


	});

	// End Delete Data



$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();

		let searchproduct = $("#searchproduct").val();

		$.ajax({
			url:'{{ url('searchproduct') }}',
			method:'get',
			data:{searchproduct:searchproduct},
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