@extends('layouts.admin')

@section('title', 'Dashboard | Edit ' . $album->name)

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>{{ $album->title }}<small> &#187; Edit Album</small></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">Edit Album Form</h2>
			</div> <!-- .panel-heading -->
			<div class="panel-body">
				@include('partials.error')
				<form class="form-horizontal" role="form" method="POST" action="/admin/albums/{{$album->id}}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<input type="hidden" name="id" value="{{ $album->id }}">

					<div class="form-group">
						<label for="title" class="col-md-3 control-label">Title</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="title" id="title" value="{{ old('title', $album->title) }}">
						</div>
					</div>

					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price (USD)</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="price" id="price" value="{{ old('price', $album->price) }}">
						</div>
					</div>

					<div class="form-group">
						<label for="image" class="col-md-3 control-label">Image</label>
						<div class="col-md-7">
							<img src="{{ asset('images/'.$album->image) }}" height="100px" width="auto" alt="picture of {{ $album->name }} album">
						</div>
					</div>					

					<div class="form-group">
						<label for="genre" class="col-md-3 control-label">Genre</label>
						<div class="col-md-7">							
							<select class="form-control" name="genre" id="genre">
								<option value="">Choose a genre</option>
								@foreach($genres as $genre)
								<option value="{{ $genre->id }}" @if (old('genre', $album->genre->id) == $genre->id) {{ 'selected' }} @endif>{{ $genre->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="artist" class="col-md-3 control-label">Artist</label>
						<div class="col-md-7">							
							<select class="form-control" name="artist" id="artist">
								<option value="">Choose an artist</option>
								@foreach($artists as $artist)
								<option value="{{ $artist->id }}" @if (old('artist', $album->artist->id) == $artist->id) {{ 'selected' }} @endif>{{ $artist->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-md-3 control-label">Description</label> 
						<div class="col-md-7">
							<textarea class="form-control" rows="3" name="description" id="description" placeholder="Details...">{{ old('description', $album->description) }}</textarea>
						</div>						
					</div>

					<div class="form-group">
						<div class="col-md-7 col-md-offset-3">
							<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Edit Album</button>	
						</div>
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>	
	
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');            

        input.trigger('fileselect', [numFiles, label]);
    });

    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        $(this).parent().next().html(label);
    });
    
    </script>
@endsection