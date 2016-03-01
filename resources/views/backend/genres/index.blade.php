@extends('layouts.admin')

@section('title', 'Dashboard | Genres')

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
			<h1>Genres<small> &#187; Display All | Create a New Genre</small></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">				
				<div class="panel-body">
					@include('partials.error')
					<form class="form-horizontal" role="form" method="POST" action="/admin/genres" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Name</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-9 col-md-offset-3">
								<span class="btn btn-default btn-file">
									Upload image<input type="file" name="image">
								</span>
								<span>
								</span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-9 col-md-offset-3">
								<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Add New Genre</button>	
							</div>
						</div>
					</form>

					@if (count($genres))

					<div class="panel panel-default">
						<div class="panel-heading">
							Current musical genres
						</div>

						<div class="panel-body">
							<table class="table table-striped">
								<thead>
									<th>Genre</th>	
									<th>Nr albums</th>
									<th>&nbsp;</th>
								</thead>
								<tbody>
									@foreach($genres as $genre)
									<tr>
										<td class="table-text">
											<div><a href="{{ action('StoreManagerGenreController@show', ['genrename' => $genre->name]) }}">{{ $genre->name }}</a></div>
										</td>
										<td class="table-text">
											<div>{{ count($genre->albums) }} album(s)</div>
										</td>
										<td>
											<form action="/admin/genres/{{ $genre->id }}" method="post">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<button type="submit" {{ count($genre->albums) ? ' disabled ' : '' }} class="btn btn-warning">Delete</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

					@endif
				</div> <!-- .panel-body -->
			</div> <!-- .panel -->
		</div>
	</div> <!-- .row -->
</div> <!-- .container-fluid -->

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