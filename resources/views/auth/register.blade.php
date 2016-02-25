{{-- resources/views/auth/register.blade.php --}}

@extends('layouts.app')

@section('title', 'Register')

@section('intro')

@endsection

@section('content')

@include('partials.error')

<form method="POST" action="/auth/register" class="form-horizontal" novalidate>
	{!! csrf_field() !!}

	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-5">
			<input type="text" name="name" class="form-control" id="email" placeholder="Name" value="{{ old('name') }}">
		</div>
	</div>

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
		<label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
		<div class="col-sm-5">
			<input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirmation">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Sign up</button>
		</div>
	</div>
</form>
@endsection