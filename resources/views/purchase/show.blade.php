@extends('layouts.app')

@section('title')
	Purchase Order #{{ $purchase->id }}
@endsection

@section('content')
	<div class="container">
		<a href="{{ url('/purchases') }}">
			Back to Purchases
		</a>

		<h2>@yield('title')</h2>

		<div class="row">
			<div class="col-md-8 col-lg-9">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<label>Supplier</label>
								<p>{{ $purchase->supplier->name }}</p>
							</div>
							<div class="col-md-3">
								<label>{{ trans('invoice.order_date') }}</label>
								<p>{{ $purchase->created_at->toFormattedDateString() }}</p>
							</div>
							<div class="col-md-3">
								<label>{{ trans('invoice.invoice') }} #</label>
								<p>{{ $purchase->id }}</p>
							</div>

							<div class="col-md-3">
								<label>{{ trans('invoice.payment_method') }}</label>
								<p>{{ $purchase->payment_method }}</p>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-3">
								<label>{{ trans('invoice.payment_status') }}</label>
								<p>
									@if ($purchase->paid)
										<span class="label label-success">{{ trans('invoice.paid') }}</span>
									@else
										<span class="label label-default">{{ trans('invoice.unpaid') }}</span>
									@endif
									<span class="label invoice-status {{ str_slug(strtolower($purchase->status)) }}">{{ $purchase->status }}</span>
								</p>
							</div>

							<div class="col-md-3">
								<label>{{ trans('invoice.total') }}</label>
								<p class="text-right">{{ m(count($purchase->total) ? $purchase->total[0]->price : 0) }}</p>
							</div>

							<div class="col-md-6">

							</div>
						</div>
					</div>
				</div>

				<div class="box">
					<div class="box-body">
						<h4>{{ trans('invoice.details') }}</h4>

						<div class="row">
							<div class="col-md-2">

							</div>
							<div class="col-md-2"></div>
						</div>

						<form action="{{ url("purchases/add-item/$purchase->id") }}" method="post">
							<table class="table">
								<thead>
									<tr>
										<th>{{ trans('cart.item') }}</th>
										<th class="text-right">{{ trans('cart.qty') }}</th>
										<th class="text-right">Unit Price</th>
										<th class="text-right">Subtotal</th>
										@if ($purchase->status == 'Draft')
											<th class="actions"></th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach ($purchase->details as $item)
										<tr>
											<td>{{ $item->product_id ? $item->product->name : $item->description }}</td>
											<td class="text-right">{{ $item->qty }}</td>
											<td class="text-right">{{ m($item->price) }}</td>
											<td class="text-right">{{ m($item->price * $item->qty) }}</td>
											@if ($purchase->status == 'Draft')
												<td>
													<button class="btn btn-default delete-item" type="button" data-id="{{ $item->id }}">
														<i class="fa fa-times"></i>
													</button>
												</td>
											@endif
										</tr>
									@endforeach

									@if ($purchase->status == 'Draft')
										<tr>
											<td>
												<select name="product_id" id="product_id" class="form-control selectize-single">
													@foreach ($products as $product)
														<option value="{{ $product->id }}">{{ $product->name }}</option>
													@endforeach
												</select>
												<input type="text" placeholder="Description" name="description" class="form-control hide">
											</td>
											<td style="max-width: 100px">
												<input type="number" placeholder="Qty" name="qty" class="form-control text-right" value="1">
											</td>
											<td>
												<input type="number" placeholder="Unit Price" name="price" class="form-control">
											</td>
											<td class="text-right">
												<button class="btn btn-primary" type="submit">
													<i class="fa fa-plus"></i>
													Add Item
												</button>
											</td>
											<td></td>
										</tr>
									@endif
								</tbody>
								<tfoot>
									<tr>
										<th colspan="3">{{ trans('cart.total') }}</th>
										<th class="text-right">{{ m(count($purchase->total) ? $purchase->total[0]->price : 0) }}</th>
										<th></th>
									</tr>
								</tfoot>
							</table>

							@if (count($errors) > 0)
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif

						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-lg-3">
				@include('purchase.actions')
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-item').click(function() {
				var itemId = $(this).attr('data-id');
				if (confirm('Are you sure you want to delete ' + itemId + '?')) {
					$.ajax('/purchases/remove-item/' + itemId, {
						method: 'POST',
						complete: function() {
							location.reload();
						}
					});
				}
			});

			$('.invoice-action').click(function() {
				var itemId = $(this).attr('data-id');
				var action = $(this).attr('data-action');
				$.ajax('/purchases/' + itemId + '/process?action=' + action, {
					method: 'POST',
					complete: function() {
						location.reload();
					}
				});
			});
		});
	</script>
@stop
