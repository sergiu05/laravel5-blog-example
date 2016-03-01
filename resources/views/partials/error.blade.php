@if (count($errors))

<div class="alert alert-danger" role="alert">
	<p>An error has occured!</p>
	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>

@endif