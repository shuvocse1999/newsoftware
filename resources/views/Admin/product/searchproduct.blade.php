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
		<a onclick="return confirm('Are you sure?')" class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->pdt_id }}"><i class="fa fa-trash-o"></i></a>
	</td>

</tr>
@endforeach
@endif