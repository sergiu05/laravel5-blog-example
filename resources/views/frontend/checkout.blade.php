@extends('layouts.app')

@section('title', 'Checkout')

@section('styles')
    <!-- Custom CSS -->
    @parent
<style>
table .media > .thumbnail { margin-bottom: 0px; padding: 4px; margin-right: 4px; }
table th:last-child { min-width: 190px; }
</style>
@endsection

@section('intro')

@endsection

@section('content')

<div class="row">

	<div class="col-sm-12 col-md-10 col-md-offset-1">
	    <table class="table table-hover">
	        <thead>
	            <tr>
	                <th>Product</th>
	                <th>Quantity</th>
	                <th class="text-center">Price</th>
	                <th class="text-center">Total</th>
	                <th> </th>
	            </tr>
	        </thead>
	        <tbody>
	        	@if ($cartItems->count())

	        	@foreach($cartItems as $item)
	            <tr>
	                <td class="col-sm-8 col-md-6">
	                <div class="media">
	                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{ asset('images/'.$item['image']) }}" style="width: 72px; height: 72px;"> </a>
	                    <div class="media-body">
	                        <h4 class="media-heading"><a href="{{ route('store::show', ['id' => $item['album_id']]) }}">{{ $item['album_name'] }}</a></h4>
	                        <h5 class="media-heading"> by <a href="#">{{ $item['artist_name'] }}</a></h5>
	                        <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
	                    </div>
	                </div></td>
	                <td class="col-sm-1 col-md-1" style="text-align: center">
	                <input type="text" class="form-control" id="item-{{ $item['album_id'] }}" value="{{ $item['qty'] }}">
	                </td>
	                <td class="col-sm-1 col-md-1 text-center"><strong>${{ $item['price'] }}</strong></td>
	                <td class="col-sm-1 col-md-1 text-center"><strong>${{ $item['price'] * $item['qty']}}</strong></td>
	                <td class="col-sm-1 col-md-1 text-center">
	                <button type="button" class="btn btn-danger btn-sm remove-button" data-id="{{ $item['album_id'] }}">
	                    <span class="glyphicon glyphicon-remove"></span> Remove
	                </button>
	                <button type="button" class="btn btn-info btn-sm update-button" data-id="{{ $item['album_id'] }}">
	                    <span class="glyphicon glyphicon-remove"></span> Update
	                </button>
	                </td>
	            </tr>
	            @endforeach	           
	            
	            <tr>
	                <td>   </td>
	                <td>   </td>
	                <td>   </td>
	                <td><h3>Total</h3></td>
	                <td class="text-right"><h3><strong>${{ $cartTotal }}</strong></h3></td>
	            </tr>
	            <tr>
	                <td>   </td>
	                <td>   </td>
	                <td>   </td>
	                <td>
	                <a href="{{ route('store::index') }}" class="btn btn-default">
	                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
	                </a></td>
	                <td>
	                <button type="button" class="btn btn-success place-order-button">
	                    Place order <span class="glyphicon glyphicon-play"></span>
	                </button></td>
	            </tr>
	            @else
	            <tr>
	            	<td colspan="3">The shopping cart is empty.</td>
	            	<td colspan="2"><a href="{{ route('store::index') }}" class="btn btn-default">
	                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
	                </button></td>
	            </tr>
	            @endif
	        </tbody>
	    </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
	$('.table').on('click', 'button', function(event) {
		var $this = $(this),
			url = '';

		if ($this.hasClass('remove-button')) {

			url = "/removefromcart/" + $this.data('id');
			$.ajax({
				type: 'post',
				url: url,				
				dataType: "json"
			}).done(function(json) {
				$('#items').html(json.count);
        		swal({
        			title: 'Info',
        			text: 'You have removed the product from the cart',
        			type: 'success'
        		}, function() {
        			location.reload(true);
        		});
			}).fail(function() {
				swal('Error', 'Unexpected error', 'error');        
			});

		} else if ($this.hasClass('update-button')) {

			url = "/updatecart/" + $this.data('id') + '/' + $('#item-' + $this.data('id')).val();			
			$.ajax({
				type: 'post',
				url: url,				
				dataType: "json"
			}).done(function(json) {
				$('#items').html(json.count);
        		swal({
        			title: 'Info',
        			text: 'You have updated the product from the cart',
        			type: 'success'
        		}, function() {
        			location.reload(true);
        		});
			}).fail(function() {
				swal('Error', 'Unexpected error', 'error');        
			});
			
		} else if ($this.hasClass('place-order-button')) {

			$.ajax({
				type: 'post',
				url: '/process',
				dataType: 'json'
			}).done(function(json) {
				swal({
					title: "Success",
					text: "Your order has been placed",
					type: "success"
				}, function() {
					location.href="/";
				});
			}).fail(function() {
				swal('Error', 'Could not process order.', 'error');
			});
			 
		}
	});
</script>
@endsection