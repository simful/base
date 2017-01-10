@extends('layouts.app')

@section('title')
	{{ $contact->name }}
@endsection

@section('content')
	<div class="container">
		<a href="{{ url('/contacts') }}">
			<i class="fa fa-arrow-circle-left"></i>
			Back to Contacts
		</a>

		<h2>@yield('title')</h2>

		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-2">
						<img class="img img-responsive pull-right" src="//www.gravatar.com/avatar/{{ md5(strtolower(trim($contact->email))) }}?s=128">
					</div>
					<div class="col-md-5">
						<div>
							<label>Email</label>
							<p>{{ $contact->email }}</p>
						</div>
						<div>
							<label>Phone</label>
							<p>{{ $contact->phone }}</p>
						</div>
						<div>
							<label>Address</label>
							<p>{{ $contact->address }}</p>
						</div>


					</div>

					<div class="col-md-5">
						<div>
							<label>Member Since</label>
							<p>{{ $contact->created_at->toFormattedDateString() }}</p>
						</div>

						<div>
							<label>Last Accessed</label>
							<p>{{ $contact->updated_at->toFormattedDateString() }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
