@extends('layouts.app')

@section('title')
	{{ $isEdit ? 'Edit' : 'Add' }} Transaction
@stop

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>
		<div class="box">
			<div class="box-body">
				<form action="/transactions" method="post">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="description" class="control-label">Description</label>
						<input type="text" class="form-control" value="{{ $transaction->description }}">
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
