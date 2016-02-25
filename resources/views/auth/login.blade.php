{{-- resources/views/auth/login.blade.php --}}

@extends('layouts.app')

@section('title', 'Login')

@section('intro')

@endsection

@section('content')

@include('partials.error')

<form method="POST" action="/auth/login" class="form-horizontal" novalidate>
	{!! csrf_field() !!}

	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-5">
			<input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
		</div>
	</div>
	
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
		<div class="col-sm-5">
			<input type="password" name="password" class="form-control" id="password" placeholder="Password">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-5">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Remember me
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Sign in</button>
		</div>
	</div>
</form>
@endsection