@extends('layouts.app')

@section('title')
	Contacts
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		<div class="mbot20">
			<a href="{{ url('contacts/create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Contact
			</a>

			<form class="form-inline pull-right">
				@include('partials.search-form')
			</form>
		</div>

		<div class="box">
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($contacts as $contact)
							<tr>
								<td>{{ $contact->name }}</td>
								<td>{{ $contact->email }}</td>
								<td>{{ $contact->phone }}</td>
								<td class="actions">
									<a class="btn btn-default" href="/contacts/{{ $contact->id }}/edit">
										<i class="fa fa-pencil"></i>
									</a>&nbsp;
									<a class="btn btn-default">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>


		{{ $contacts->links() }}
	</div>
@endsection
