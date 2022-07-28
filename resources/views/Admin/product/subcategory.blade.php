@extends('Admin.layouts.index')
@section('content')


<div class="content-wrapper">
	<div class="page-heading">
		<h3 class="page-title">Subcategory Information</h3>
	</div>



	<div class="page-content fade-in">
		<div class="ibox">
			<div class="ibox-head mb-3 myhead">
				<div class="ibox-title"><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;&nbsp;Subcategory Setup List</div>
				<div><a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-dark rounded addbutton"><i class="fa fa-plus"></i>&nbsp;Add New</a></div>
			</div>
			<div class="ibox-body table-responsive overflow">
				<table class="table table-striped table-bordered" id="example-table" cellspacing="0" width="100%">
					<thead class="mythead">
						<tr>
							<th>SL</th>
							<th>Item Name</th>
							<th>Category Name</th>
							<th>Subcategory Name(EN)</th>
							<th>Subcategory Name(BN)</th>
							<th>Subcategory URL</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody class="tbody" id="showtdata">
						@php $i=1;  @endphp
						@if(isset($data))
						@foreach($data as $d)
						<tr id="tr{{ $d->subcat_id }}">
							<td>{{ $i++ }}</td>
							<td>{{ $d->item_name_en }}<br>{{ $d->item_name_bn }}</td>
							<td>{{ $d->cat_name_en }}<br>{{ $d->cat_name_bn }}</td>
							<td>{{ $d->subcat_name_en }}</td>
							<td>{{ $d->subcat_name_bn }}</td>
							<td>{{ $d->subcat_url }}</td>
							<td>
								@if($d->subcat_status == 1)
								<span class="btn btn-success btn-sm border-0">Active</span>
								@else
								<span class="btn btn-warning btn-sm border-0">Inactive</span>
								@endif
							</td>
							<td>
								<a  class="btn btn-info border-0 edit text-light" data-toggle="modal" data-target="#exampleModalCenters" data-id="{{ $d->subcat_id }}"><i class="fa fa-pencil-square-o"></i></a>
								<a onclick="return confirm('Are you sure?')" class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->subcat_id }}"><i class="fa fa-trash-o"></i></a>
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





<!-- Add Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<form method="post" class="btn-submit">
			@csrf
			<div class="modal-content rounded">
				<div class="modal-header bg-dark text-light">
					<h5 class="modal-title" id="exampleModalCenterTitle"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add subcategory Information</h5>
					<button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body myinput">

					<div class="row">

						<div class="form-group col-md-12">
							<label>Item Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="subcat_item_id" id="subcat_item_id" required="" onchange="getcat()">
									<option value="">Select Item</option>
									@php
									$item = DB::table('pdt_item')->where('item_status',1)->get();		
									@endphp 
									@foreach($item as $i)
									<option value="{{ $i->item_id  }}">{{ $i->item_name_en }} ( {{ $i->item_name_bn }} )</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>Category Name:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="subcat_cat_id" id="subcat_cat_id" required="">
									<option value="">Select Category</option>
									@php
									$category = DB::table('pdt_category')->where('cat_status',1)->get();		
									@endphp 
									@foreach($category as $c)
									<option value="{{ $c->cat_id  }}">{{ $c->cat_name_en }} ( {{ $c->cat_name_bn }} )</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="form-group col-md-12">
							<label>Subcategory Name(EN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="subcat_name_en" id="subcat_name_en" placeholder="Subcategory Name(EN)" required="">
							</div>
						</div>

						<div class="form-group col-md-12">
							<label>Subcategory Name(BN):</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-text-width"></i></div>
								<input class="form-control" type="text" name="subcat_name_bn" id="subcat_name_bn" placeholder="Subcategory Name(BN)">
							</div>
						</div>

						
						<div class="form-group col-md-6">
							<label>Subcategory URL:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-link"></i></div>
								<input class="form-control" type="url" placeholder="Subcategory URL" name="subcat_url" id="subcat_url">
							</div>
						</div>

						<div class="form-group col-md-6">
							<label>Status:</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-check-square-o"></i></div>
								<select class="form-control" name="subcat_status" id="subcat_status">
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
				<h5 class="modal-title" id="exampleModalCenterTitles"><i class="fa fa-plus"></i>&nbsp;&nbsp;Update subcategory Information</h5>
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


	showdata();

	function showdata(){
		$.ajax(
		{
			url: "{{ url('getsubcategory') }}",
			type: 'get',
			data:{},
			success: function(data)
			{
				$("#showtdata").html(data);
			}
		});

	}

	// End Get Data


	$('.loading').hide();
	$(".btn-submit").submit(function(e){
		e.preventDefault();
		var data = $(this).serialize();

		$.ajax({
			url:'{{ url('subcategoryinsert') }}',
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

				$('#subcat_name_en').val('');
				$('#subcat_name_bn').val('');
				$('#subcat_url').val('');
				$('.loading').hide();
				$('.button').show();
				$('#exampleModalCenter').modal('hide');

				showdata();

			},

			error:function(error){
				console.log(error)
			}
		});
	});

	// End Add Data


</script>


<script type="text/javascript">
	function getcat(){
		let item_id = $("#subcat_item_id").val();
		$.ajax({
			url: "{{ url('getcatajax') }}/"+item_id,
			type: 'get',
			data:{},
			success: function (data)
			{
				$("#subcat_cat_id").html(data);
			},
			error:function(errors){
				alert("Select Item")
			}
		});

	}

</script>


@endsection