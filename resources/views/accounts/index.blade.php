@extends('layouts.app')

@section('title')
	Accounts
@stop

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>
		<div class="mbot20">
			<a href="/accounts/create" class="btn btn-primary">
				<i class="fa fa-plus"></i> Account
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
							<th class="text-center">No</th>
							<th>Account Name</th>
							<th>Group</th>
							<th>Debit/Credit</th>
							<th>Permanent/Temporary</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($accounts as $account)
						<tr>
							<td class="text-center">{{ $account->id }}</td>
							<td><a href="{{ url('accounts/' . $account->id) }}">{{ $account->name }}</a></td>
							<td>{{ $account->group->name }}</td>
							<td>{{ $account->group->position }}</td>
							<td>{{ $account->group->type }}</td>
							<td class="actions">
								<a class="btn btn-default" href="/accounts/{{ $account->id }}/edit">
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
	</div>
@stop
