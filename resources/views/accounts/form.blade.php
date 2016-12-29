@extends('layouts.app')

@section('title')
	{{ $isEdit ? 'Edit' : 'Add' }} Account
@stop

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>
		<div class="box">
			<div class="box-body">
				@if ($isEdit)
					<form action="/accounts/{{ $account->id }}" method="post">
						<input name="_method" type="hidden" value="put">
				@else
					<form action="/accounts" method="post">
				@endif
					{{ csrf_field() }}

					<div class="form-group">
						<label for="id" class="control-label">Account Number</label>
						<input type="text" class="form-control" name="id" value="{{ $account->id }}">
					</div>
					<div class="form-group">
						<label for="name" class="control-label">Account Name</label>
						<input type="text" class="form-control" name="name" value="{{ $account->name }}">
					</div>
					<div class="form-group">
						<label for="account_group_id" class="control-label">Account Type</label>
						<select class="form-control selectize-single" name="account_group_id">
							@foreach ($accountGroups as $group)
								<option {{ $account->account_group_id == $group->id ? 'selected' : '' }} value="{{ $group->id }}">{{ $group->name }}</option>
							@endforeach
						</select>
					</div>

					<hr>

					<button class="btn btn-primary btn-lg" type="submit">
						<i class="fa fa-check"></i> Save
					</button>

					<button type="button" class="btn btn-default btn-lg" onclick="history.back()">
						<i class="fa fa-times"></i> Cancel
					</button>
				</form>
			</div>
		</div>
	</div>
@stop
