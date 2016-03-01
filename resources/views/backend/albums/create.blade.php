@extends('layouts.admin')

@section('title', 'Dashboard | New Album')

@section('styles')
<style type="text/css">
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>Albums<small> &#187; Create New Album</small></h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">New Album Form</h2>
			</div> <!-- .panel-heading -->
			<div class="panel-body">
				@include('partials.error')
				<form class="form-horizontal" role="form" method="POST" action="/admin/albums" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label for="title" class="col-md-3 control-label">Title</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
						</div>
					</div>

					<div class="form-group">
						<label for="price" class="col-md-3 control-label">Price (USD)</label>
						<div class="col-md-7">
							<input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-7 col-md-offset-3">
							<span class="btn btn-default btn-file">
								Upload image<input type="file" name="image">
							</span>
							<span>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="genre" class="col-md-3 control-label">Genre</label>
						<div class="col-md-7">							
							<select class="form-control" name="genre" id="genre">
								<option value="">Choose a genre</option>
								@foreach($genres as $genre)
								<option value="{{ $genre->id }}" @if (old('genre') == $genre->id) {{ 'selected' }} @endif>{{ $genre->name }}</option>
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
								<option value="{{ $artist->id }}" @if (old('artist') == $artist->id) {{ 'selected' }} @endif>{{ $artist->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="description" class="col-md-3 control-label">Description</label> 
						<div class="col-md-7">
							<textarea class="form-control" rows="3" name="description" id="description" placeholder="Details...">{{ old('description') }}</textarea>
						</div>						
					</div>

					<div class="form-group">
						<div class="col-md-7 col-md-offset-3">
							<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Add New Album</button>	
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