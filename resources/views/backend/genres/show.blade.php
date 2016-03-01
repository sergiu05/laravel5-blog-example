@extends('layouts.admin')

@section('title', 'Dashboard | Genre '.$genre->name)

@section('styles')
<style>

</style>
@endsection

@section('content')

<div class="container-fluid">

	<div class="row">
		<div class="col-md-8 col-md-2-offset">
			<h1>{{ $genre->name }}<small> &#187; Details</small></h1>

			<div class="table-responsive">

				<table class="table">
					<thead> 
						<tr> 
							<th>#</th> 
							<th>Name</th> 
							<th>Created</th> 
							<th>Albums</th> 				
						</tr> 
					</thead>
					<tbody> 			
						<tr> 
							<th scope="row">{{ $genre->id }}</th> 
							<td>{{ $genre->name }}</td> 				
							<td>{{ $genre->created_at->toFormattedDateString() }}</td> 
							<td>
								@forelse($genre->albums as $album)
								<a href="{{ route('admin.albums.edit', ['id' => $album->id]) }}" class="image-link" height="100px" width="auto">
									<img src="{{ asset('images/'.$album->image) }}" height="100" width="auto">
								</a>
								@empty
								No albums for this genre.
			 					@endforelse
							</td> 			
						</tr>			
					</tbody>
				</table>

			</div>		

		</div>	
		
	</div>
	
</div>
@endsection