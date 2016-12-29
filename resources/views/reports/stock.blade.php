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
							<th class="text-right">Recommended Sell Price</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							<tr>
								<td>{{ $product->name }}</td>
								<td class="text-right">{{ $product->stock }}</td>
								<td class="text-right">{{ m($product->avg_buy_price) }}</td>
								<td class="text-right">{{ m($product->sell_price) }}</td>
								<td class="text-right">{{ m(0) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
