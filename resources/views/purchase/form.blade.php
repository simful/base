@extends('layouts.app')

@section('title')
	New Purchase
@endsection

@section('content')
	<div class="container">
		<h2>New Purchase</h2>

		@if ($is_edit)
			<form class="form" action="{{ url('purchases/' . $purchase->id) }}" method="post">
				<input type="hidden" name="_method" value="put">
		@else
			<form class="form" action="{{ url('purchases') }}" method="post">
		@endif
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

				<div class="form-group">
					<label for="supplier_id">Vendor/Supplier</label>
					<select id="supplier_id" name="supplier_id" class="form-control selectize-single">
						@foreach ($suppliers as $supplier)
							<option {{ $supplier->id == Request::get('contact_id', $purchase->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
						@endforeach
					</select>
					<a class="btn btn-primary" style="margin-top: 10px" href="{{ url('contacts/create?next=/' . Request::path() ) }}">
						<i class="fa fa-plus"></i>
						New Supplier
					</a>
				</div>
			</div>

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">
					<i class="fa fa-check"></i>
					Save Changes
				</button>

				<button type="button" class="btn btn-default" onclick="history.back()">
					<i class="fa fa-times"></i>
					Cancel
				</button>
			</div>
		</div>
	</div>
@endsection
