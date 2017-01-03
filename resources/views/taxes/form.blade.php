@extends('layouts.app')

@section('title')
	{{ $is_edit ? 'Edit' : 'Add' }} Tax
@endsection

@section('content')
	<div class="container">
		<h2>
			@yield('title')
		</h2>

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

				@if ($is_edit)
					<form class="form" action="{{ url('taxes/' . $tax->id) }}" method="post">
						<input type="hidden" name="_method" value="put">
				@else
					<form class="form" action="{{ url('taxes') }}" method="post">
				@endif

					{{ csrf_field() }}

					<div class="form-group">
						<label for="code" class="control-label">Code</label>
						<input type="text" name="code" value="{{ old('code', $tax->code) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="name" class="control-label">Name</label>
						<input type="text" name="name" value="{{ old('name', $tax->name) }}" class="form-control">
					</div>

					<div class="form-group">
						<label for="rate" class="control-label">Rate</label>
						<input type="number" name="rate" value="{{ old('rate', $tax->rate) }}" class="form-control" step="0.01">
					</div>

					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Save Changes
					</button>

					<button type="button" class="btn btn-default" onclick="history.back()">
						<i class="fa fa-times"></i>
						Cancel
					</button>
				</form>
			</div>
		</div>
	</div>
@endsection
