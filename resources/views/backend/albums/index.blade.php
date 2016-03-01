@extends('layouts.admin')

@section('title', 'Dashboard | Albums')

@section('styles')
<style type="text/css">

.button-wrapper { text-align: right; }
.price-td { text-align: right; max-width: 60px; width:60px; }

</style>
@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="button-wrapper">
				<a href="{{ route('admin.albums.create') }}" class="btn btn-info">New Album</a>
			</div>
			<div class="table-responsive">
  				<table class="table">
    				<thead> 
    					<tr> 
    						<th>#</th> 
    						<th>Title</th> 
    						<th>Price</th> 
    						<th>Cover</th> 
    						<th>Genre</th> 
    						<th>Artist</th> 
    						<th>Action</th> 
    					</tr> 
    				</thead>
    				<tbody> 
    					@foreach($albums as $album)
    					<tr> 
    						<th scope="row">{{ $album->id }}</th> 
    						<td><a href="{{ route('admin.albums.edit', ['id' => $album->id]) }}">{{ $album->title }}</a></td> 
    						<td class="price-td">${{ $album->price }}</td> 
    						<td><img src="{{ asset('images/'.$album->image) }}" width="30" height="auto" alt="image of {{ $album->name }}"></td> 
    						<td><a href="{{ route('admin.genres.show', ['id' => $album->genre->name]) }}">{{ $album->genre->name }}</a></td> 
    						<td><a href="{{ route('admin.artists.show', ['id' => $album->artist->id]) }}">{{ $album->artist->name }}</a></td>			
    						<td>
    							<form action="{{ action('StoreManagerController@destroy', ['id' => $album->id]) }}" method="POST">
    								{{ csrf_field() }}
    								{{ method_field('DELETE') }}
    								<button type="submit" class="btn btn-warning delete-button" data-id="{{ $album->id }}">Delete</button>
    							</form>
    						</td> 
    					</tr>
    					@endforeach 
    				</tbody>
  				</table>
			</div>		

		</div>
	</div>
	

</div>

@endsection

@section('scripts')
<script type="text/javascript">

	$('table').on('click', '.delete-button', function(e) {
		var $this = $(this),
			id = $(this).data('id');

		e.preventDefault();

		swal({
			title: "Warning",
			text: "You're about to delete the album with id of " + id,
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Are you sure?",
			closeOnConfirm: true,
			closeOnCancel: true
		}, function() {
			$.ajax({
				url: "/admin/albums/" + id,
				type: "DELETE"
			})
			.done(function(json) {
				console.log(json);
				if (json == 1) {
					swal({
						title: "Info",
						text: "The album with id " + id + " has been deleted.",
						type: "warning",
						showConfirmationButton: true
					}, function() {
						location.reload();	
					});
					
				}
			});
			
		});
	});

</script>
@endsection