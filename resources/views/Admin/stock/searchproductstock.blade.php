	
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