@extends('layouts.settings')

@section('settings')
	<h3>Add/Edit User</h3>

	@if ($is_edit)
		<form class="form" action="{{ url('users/' . $user->id) }}" method="post">
			<input type="hidden" name="_method" value="put">
	@else
		<form class="form" action="{{ url('users') }}" method="post">
	@endif

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
			<div class="form-group">
				<label class="control-label" for="name">Name</label>
				<input class="form-control" type="text" id="name" name="name" value="{{ old('email', $user->name) }}">
			</div>

			<div class="form-group">
				<label class="control-label" for="email">Email</label>
				<input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
			</div>

			<div class="form-group">
				<label class="control-label" for="phone">Phone</label>
				<input class="form-control" type="text" id="phone" name="phone" value="{{ old('email', $user->phone) }}">
			</div>

			<div class="form-group">
				<label class="control-label" for="address">Address</label>
				<textarea class="form-control" id="address" name="address">{{ old('email', $user->address) }}</textarea>
			</div>

			<hr>

			<div class="alert alert-info">Leave these fields blank if you don't want to change password.</div>

			<div class="form-group">
				<label class="control-label" for="password">Password</label>
				<input class="form-control" type="password" id="password" name="password">
			</div>

			<div class="form-group">
				<label class="control-label" for="verify_password">Verify Password</label>
				<input class="form-control" type="password" id="verify_password" name="verify_password">
			</div>

			<button class="btn btn-primary" type="submit">
				<i class="fa fa-check"></i>
				Save Changes
			</button>

			<a href="{{ url('/users') }}" class="btn btn-default">
				<i class="fa fa-times"></i>
				Cancel
			</a>
		</div>
	</form>
@stop
