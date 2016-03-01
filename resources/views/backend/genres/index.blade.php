@extends('layouts.admin')

@section('title', 'Dashboard Admin | Genres')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
  				<table class="table">
    				<thead> 
    					<tr> 
    						<th>#</th> 
    						<th>Genre</th> 
    						<th>Created</th> 
    						<th>Action</th> 
    					</tr> 
    				</thead>
    				<tbody> 
    					@foreach($genres as $genre)
    					<tr> 
    						<th scope="row">{{ $genre->id }}</th> 
    						<td>{{ $genre->name }}</td> 
    						<td>{{ $genre->created_at }}</td> 
    						<td>-</td> 
    					</tr>
    					@endforeach 
    				</tbody>
  				</table>
			</div>
		</div>
	</div>
</div>

@endsection