@extends('layouts.app')

@section('title')
	{{ $is_edit ? 'Edit' : 'Add' }} Contact
@endsection

@section('content')
	<div class="container">
		<h2>
			@yield('title')
		</h2>

		@if ($is_edit)
			<form class="form" action="{{ url('contacts/' . $contact->id) }}" method="post">
				<input type="hidden" name="_method" value="put">
		@else
			<form class="form" action="{{ url('contacts') }}" method="post">
		@endif

		<div class="box">
			<div class="box-body">
				@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif

					@if (Request::has('next'))
						<input type="hidden" name="next" value="{{ Request::get('next') }}">
					@endif

					{{ csrf_field() }}

					<div class="form-group">
						<label for="name" class="control-label">Name</label>
						<input id="name" type="text" name="name" value="{{ old('name', $contact->name) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="phone" class="control-label text-regular">Phone</label>
						<input id="phone" type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="email" class="control-label text-regular">Email</label>
						<input id="email" type="email" name="email" value="{{ old('email', $contact->email) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="address" class="control-label text-regular">Address</label>
						<input id="address" type="text" name="address" value="{{ old('address', $contact->address) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="city" class="control-label text-regular">City</label>
						<input id="city" type="text" name="city" value="{{ old('city', $contact->city) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="state" class="control-label text-regular">State/Province</label>
						<input id="state" type="text" name="state" value="{{ old('state', $contact->state) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="country" class="control-label text-regular">Country</label>
						<input id="country" type="text" name="country" value="{{ old('country', $contact->country) }}" class="form-control">
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Save Changes
					</button>

					<button type="button" class="btn btn-default" onclick="history.back()">
						<i class="fa fa-times"></i>
						Cancel
					</button>
				</div>
			</div>
		</form>
	</div>
@endsection
