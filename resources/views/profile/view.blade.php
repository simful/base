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
					<div class="col-md-5">
						<div>
							<label>Name</label>
							<p>{{ $user->name }}</p>
						</div>

						<div>
							<label>Email</label>
							<p>{{ $user->email }}</p>
						</div>
						<div>
							<label>Phone</label>
							<p>{{ $user->phone }}</p>
						</div>
						<div>
							<label>Address</label>
							<p>{{ $user->address }}</p>
						</div>


					</div>

					<div class="col-md-5">
						<div>
							<label>Member Since</label>
							<p>{{ $user->created_at->toFormattedDateString() }}</p>
						</div>

						<div>
							<label>Last Accessed</label>
							<p>{{ $user->updated_at->toFormattedDateString() }}</p>
						</div>
					</div>
				</div>

				<hr>

				<a href="{{ url('/profile/edit') }}" class="btn btn-primary">
					<i class="fa fa-pencil"></i>
					Edit Profile
				</a>
			</div>
		</div>
	</div>
@endsection
