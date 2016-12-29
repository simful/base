@extends('layouts.app')

@section('title')
	{{ $customer->name }}
@endsection

@section('content')
	<div class="container">
		<h2>My Profile</h2>

		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-2">
						<img class="img img-responsive pull-right" src="//www.gravatar.com/avatar/{{ md5(strtolower(trim($customer->email))) }}?s=128">
					</div>
					<div class="col-md-5">
						<div>
							<label>Name</label>
							<p>{{ $customer->name }}</p>
						</div>

						<div>
							<label>Email</label>
							<p>{{ $customer->email }}</p>
						</div>
						<div>
							<label>Phone</label>
							<p>{{ $customer->phone }}</p>
						</div>
						<div>
							<label>Address</label>
							<p>{{ $customer->address }}</p>
						</div>


					</div>

					<div class="col-md-5">
						<div>
							<label>Member Since</label>
							<p>{{ $customer->created_at->toFormattedDateString() }}</p>
						</div>

						<div>
							<label>Last Accessed</label>
							<p>{{ $customer->updated_at->toFormattedDateString() }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
