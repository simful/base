@extends('layouts.app')

@section('title')
	{{ $is_edit ? 'Edit' : 'Add' }} Invoice
@endsection

@section('content')
	<div class="container">
		<h2>
			@yield('title')
		</h2>

		@if ($is_edit)
			<form class="form" action="{{ url('invoices/' . $invoice->id) }}" method="post">
				<input type="hidden" name="_method" value="put">
		@else
			<form class="form" action="{{ url('invoices') }}" method="post">
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

					{{ csrf_field() }}

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">Customer</label>
								<select id="customer_id" name="customer_id" class="form-control selectize-single">
									@foreach ($customers as $customer)
										<option {{ $customer->id == Request::get('contact_id', $invoice->customer_id) ? 'selected' : '' }} value="{{ $customer->id }}">{{ $customer->name }}</option>
									@endforeach
								</select>
								<a class="btn btn-primary" style="margin-top: 10px" href="{{ url('contacts/create?next=/' . Request::path()) }}">
									<i class="fa fa-plus"></i>
									New Customer
								</a>
							</div>

							<div class="form-group">
								<label class="control-label">Due Date</label>
								<input type="text" name="due_date" class="form-control datepicker" value="{{ old('due_date', $invoice->due_date) }}">
							</div>
						</div>
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

		</form>

	</div>
@endsection
