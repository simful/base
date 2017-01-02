@extends('layouts.app')

@section('title')
	Purchases
@endsection

@section('content')
	<div class="container">
		<h2>Purchases</h2>
		<div class="mbot20">
			<a class="btn btn-primary" href="{{ url('purchases/create') }}">
				<i class="fa fa-plus"></i>
				Purchase
			</a>
		</div>

		@foreach ($purchases as $purchase)
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-md-2 text-center">
							<a href="{{ url('customers/' . $purchase->supplier->id) }}">
								<img class="img" src="{{ $purchase->supplier->avatar }}" style="height: 100px; margin-top: 20px">
								<p>{{ $purchase->supplier->name }}</p>
							</a>
						</div>
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-3" style="border-right: 1px solid #ccc">
									<label>{{ trans('invoice.invoice') }} #{{ $purchase->id }}</label>
									<p>{{ trans('invoice.status') }} <span class="label label-success">{{ $purchase->status }}</p>
								</div>
								<div class="col-md-3" style="border-right: 1px solid #ccc">
									<label>{{ trans('invoice.due_date') }}</label>
									<h4>{{ d($purchase->due_date) }}</h4>
								</div>
								<div class="col-md-3">
									<label class="text-right">{{ trans('invoice.total') }}</label>
									<h4 class="text-right">{{ m(count($purchase->total) ? $purchase->total[0]->price : 0) }}</h4>
								</div>
								<div class="col-md-3">
									<a class="btn btn-primary pull-right" href="{{ url('purchases/' . $purchase->id) }}">
										{{ trans('invoice.detail') }}
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{ $purchases->links() }}
	</div>
@endsection