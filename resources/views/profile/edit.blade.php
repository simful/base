@extends('layouts.app')

@section('title')
	My Profile
@endsection

@section('content')
	<div class="container">
		<h2>My Profile</h2>

		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-2">
						<img class="img img-responsive pull-right" src="//www.gravatar.com/avatar/{{ md5(strtolower(trim($user->email))) }}?s=128">
					</div>
					<div class="col-md-6">
						<form class="form" action="{{ url('/profile') }}" method="post">
							<input type="hidden" name="_method" value="PUT">
							{{ csrf_field() }}

							<div class="form-group">
								<label class="control-label">Name</label>
								<input value="{{ $user->name }}" name="name" class="form-control">
							</div>

							<div class="form-group">
								<label class="control-label">Email</label>
								<input value="{{ $user->email }}" name="email" class="form-control">
							</div>

							<div class="form-group">
								<label class="control-label">Phone</label>
								<input value="{{ $user->phone }}" name="phone" class="form-control">
							</div>

							<div class="form-group">
								<label class="control-label">Address</label>
								<input value="{{ $user->address }}" name="address" class="form-control">
							</div>

							<hr>

							<button type="submit" class="btn btn-primary">
								<i class="fa fa-check"></i>
								Save Changes
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
