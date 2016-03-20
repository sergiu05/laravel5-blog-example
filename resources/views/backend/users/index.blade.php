@extends('layouts.admin')

@section('title', 'Dashboard | Users')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<h1>Display Users <small>update status</small></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			@include('partials.error')

			<table class="table table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Nr of orders</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ count($user->orders) }}</td>
				<td>
					<form action="{{ route('update-user-status') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="user_id" value="{{ $user->id }}">
						Admin <input type="radio" name="is_admin" value="1" @if ($user->isAdmin()) {{ 'checked'}} @endif>
						User <input type="radio" name="is_admin" value="0" @if ($user->isNotAdmin()) {{ 'checked' }} @endif>
					</form>

				</td>
			</tr>
			@endforeach
			</tbody>
			</table>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>

$('input[type=radio][name=is_admin]').on('change', function() {
	var $this = $(this),
		user_id = $this.parent().find('input[name=user_id]').val();
		console.log(user_id);
	$.ajax({
		type: 'post',
		url: '{{ route('update-user-status') }}',
		data: {'user_id': user_id, 'is_admin': $this.val()},
		dataType: 'json'
	}).done(function(data) {

	}).fail(function(jqXHR) {
		console.log(jqXHR);
	});

})
</script>
@endsection

