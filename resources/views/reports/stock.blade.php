@extends('layouts.app')

@section('title')
	Stock Report
@endsection

@section('content')
	<div class="container">
		<h2>Stock</h2>
		<div class="box">
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Product</th>
							<th class="text-right">Stock</th>
							<th class="text-right">Avg Buy Price</th>
							<th class="text-right">Sell Price</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$total['buyPrice'] = 0;
							$total['sellPrice'] = 0;
						?>
						@foreach ($products as $product)
							<tr>
								<td>{{ $product->name }}</td>
								<td class="text-right">{{ $product->stock }}</td>
								<td class="text-right">{{ m($product->buy_price) }}</td>
								<td class="text-right">{{ m($product->sell_price) }}</td>
							</tr>
							<?php
								$total['buyPrice'] += $product->buy_price * $product->stock;
								$total['sellPrice'] += $product->sell_price * $product->stock;
							?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="box no-padding">
					<div class="box-header">
						Summary
					</div>
					<div class="box-body">
						<table class="table">
							<tbody>
								<tr>
									<td>Inventory Worth</td>
									<td class="text-right">{{ m($total['sellPrice']) }}</td>
								</tr>
								<tr>
									<td>Total Buy Price</td>
									<td class="text-right">{{ m($total['buyPrice']) }}</td>
								</tr>
								<tr>
									<td>Est. Future Profit</td>
									<td class="text-right">{{ m($total['sellPrice'] - $total['buyPrice']) }}</td>
								</tr>
								<tr>
									<td>Avg. Margin</td>
									<td class="text-right">{{ $total['buyPrice'] != 0 ? number_format((($total['sellPrice'] / $total['buyPrice']) * 100) - 100, 2, ',', '.') . '%' : 0}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection
