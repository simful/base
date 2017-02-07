@extends('layouts.app')

@section('title')
	Sales Invoices
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		<div class="mbot20">
			<a href="{{ url('invoices/create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Sales Invoice
			</a>

			<span class="btn-group pull-right">
				<a class="btn {{ $status == 'open' ? 'btn-primary' : 'btn-default' }}" href="{{ url('/invoices?status=open') }}">{{ trans('invoice.open') }}</a>
				<a class="btn {{ $status == 'completed' ? 'btn-primary' : 'btn-default' }}" href="{{ url('/invoices?status=completed') }}">{{ trans('invoice.completed') }}</a>
				<a class="btn {{ $status == 'canceled' ? 'btn-primary' : 'btn-default' }}" href="{{ url('/invoices?status=canceled') }}">{{ trans('invoice.canceled') }}</a>
				<a class="btn {{ $status == 'all' ? 'btn-primary' : 'btn-default' }}" href="{{ url('/invoices?status=all') }}">{{ trans('invoice.all') }}</a>
			</span>
		</div>

		@foreach ($invoices as $invoice)
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-md-2 text-center">
							<a href="{{ url('contacts/' . $invoice->customer->id) }}">
								<img class="img" src="{{ $invoice->customer->avatar }}" style="height: 100px; margin-top: 20px">
								<p>{{ $invoice->customer->name }}</p>
							</a>
						</div>
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-3" style="border-right: 1px solid #ccc">
									<label>{{ trans('invoice.invoice') }} #{{ $invoice->id }}</label>
									<p><span class="label invoice-status {{ str_slug(strtolower($invoice->status)) }}">{{ $invoice->status }}</span></p>
								</div>
								<div class="col-md-3" style="border-right: 1px solid #ccc">
									<label>{{ trans('invoice.due_date') }}</label>
									<h4>{{ $invoice->due_date->toFormattedDateString() }}</h4>
								</div>
								<div class="col-md-3">
									<label class="text-right">{{ trans('invoice.total') }}</label>
									<h4 class="text-right">{{ m(count($invoice->total) ? $invoice->total[0]->price : 0) }}</h4>
								</div>
								<div class="col-md-3">
									<a class="btn btn-primary pull-right" href="{{ url('invoices/' . $invoice->id) }}">
										{{ trans('invoice.detail') }}
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{ $invoices->links() }}
	</div>
@endsection
