		@php $i=1;  @endphp
		@if(isset($data))
		@foreach($data as $d)
		<tr id="tr{{ $d->id }}">
			<td>{{ $i++ }}</td>
			<td>{{ $d->invoice_no }}</td>
			<td>{{ $d->invoice_date }}</td>
			<td>{{ $d->supplier_name_en }}, {{ $d->supplier_phone }}</td>
			<td>{{ $d->total_amount }} Tk</td>
			<td>{{ $d->due }} Tk</td>
			<td>{{ $d->transaction_type }}</td>

			
			<td>
				<a class="delete btn btn-danger  border-0 text-light" data-id="{{ $d->id }}"><i class="fa fa-trash-o"></i></a>
				<a href="{{ url('invoicepurchase/'.$d->invoice_no) }}" target="_blank"  class="btn btn-info  border-0 text-light"><i class="fa fa-eye"></i></a>
			</td>

		</tr>
		@endforeach
		@endif
