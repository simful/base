@extends('layouts.app')

@section('title')
	Print Invoice
@endsection

@section('content')
	<?php $company = Agent::find(Auth::user()->agent_id); ?>
	<div class="container">
		<div class="box">
			<div class="box-body">
				{{-- cover and logo --}}
				<div class="row">
					<div class="col-xs-6">
						<p class="text-bold">Bill From:</p>
						<p>{{ $company->name }}</p>
						<p>{{ $company->address }}</p>
						<p>{{ $company->city }}, {{ $company->state }}</p>

						<p class="text-bold" style="margin-top: 30px">Bill To:</p>
						<p>{{ $invoice->customer->name }}</p>
						<p>{{ $invoice->customer->address }}</p>
						<p>{{ $invoice->customer->city }}, {{ $invoice->customer->state }}</p>
					</div>
					<div class="col-xs-6">
						<div>{{ Setting::get('header_content') }}</div>

						<p class="text-bold">Invoice #{{ $invoice->id }}</p>
						<p>Date: {{ d($invoice->created_at) }}</p>
						<p>Amount Due: <span class="text-bold">{{ m($invoice->total[0]->price) }}</span></p>
					</div>
				</div>


				{{-- invoice header --}}

				<hr>

				{{-- invoice detail --}}

				<table class="table">
					<thead>
						<tr>
							<th style="min-width: 150px">{{ trans('cart.item') }}</th>
							<th class="text-right">{{ trans('cart.qty') }}</th>
							<th class="text-right">Unit Price</th>
							<th class="text-right">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($invoice->details as $item)
							<tr>
								<td>{{ $item->product_id ? $item->product->name : $item->description }}</td>
								<td class="text-right">{{ $item->qty }}</td>
								<td class="text-right">{{ m($item->price) }}</td>
								<td class="text-right">{{ m($item->price * $item->qty) }}</td>
							</tr>
						@endforeach
							<tr>
								<th colspan="3" class="text-right">Total</th>
								<th class="text-right">{{ m($invoice->total[0]->price) }}</th>
							</tr>
					</tbody>
				</table>

				<hr>

				<div class="row">
					<div class="col-xs-6">
						{{-- remarks --}}
						<div>
							{{ Setting::get('footer_content') }}
						</div>
					</div>
					<div class="col-xs-6">
						{{-- summary --}}
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
