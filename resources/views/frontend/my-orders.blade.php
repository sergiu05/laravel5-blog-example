@extends('layouts.app')

@section('title', 'My Profile')

@section('intro')

@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="button-wrapper">
				<h1>Order history</h1>
			</div>
			<div class="table-responsive">
  				<table class="table">
    				<thead> 
    					<tr> 
    						<th>#</th> 
    						<th>Date</th> 
    						<th>Total</th>
    						<th>Nr.Items</th>     						 
    					</tr> 
    				</thead>
    				<tbody> 
    					@forelse($orders as $order)
    					<tr> 
    						<td>{{ $order->id }}</th> 
    						<td>{{ $order->created_at->format('d-m-Y') }}</td> 
    						<td>${{ $order->total }}</td> 
    						<td>{{ $order->items->count() }} item(s)</td> 
    					</tr>
    					@empty
    					<tr>
    						<td colspan="4">No orders so far.</td>
    					</tr>
    					@endforelse
    				</tbody>
  				</table>
			</div>		

		</div>
	</div>
</div>
@endsection