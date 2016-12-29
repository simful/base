@extends('layouts.app')

@section('title')
	{{ $is_edit ? 'Edit' : 'Add' }} Invoice
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
					<form class="form" action="{{ url('invoices/' . $invoice->id) }}" method="post">
						<input type="hidden" name="_method" value="put">
				@else
					<form class="form" action="{{ url('invoices') }}" method="post">
				@endif

					{{ csrf_field() }}

					<div class="form-group">
						<label class="control-label">Customer</label>
						<input type="text" name="customer_id" class="form-control" value="{{ old('customer_id', $invoice->customer_id) }}">
					</div>

					<div class="form-group">
						<label class="control-label">Due Date</label>
						<div class="row">
							<div class="col-md-4">
								<input type="text" name="due_date" class="form-control datepicker" value="{{ old('due_date', $invoice->due_date) }}">
							</div>
						</div>
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
