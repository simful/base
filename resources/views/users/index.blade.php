@extends('layouts.settings')

@section('settings')
	<div class="mbot20">
		<a href="{{ url('users/create') }}" class="btn btn-primary">
			<i class="fa fa-plus"></i>
			User
		</a>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Member Since</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ d($user->created_at) }}</td>
					<td class="actions">
						<a class="btn btn-default" href="/users/{{ $user->id }}/edit">
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

	{{ $users->links() }}
@endsection
