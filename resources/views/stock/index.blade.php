@extends('layouts.app')

@section('title')
	Stock
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
							<th class="text-right">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($products as $product)
							<tr>
								<td>
									<a href='{{ url("stock/$product->id") }}'>{{ $product->name }}</a>
								</td>
								<td class="text-right">{{ $product->stock }}</td>
								<td class="actions">
									<a href='{{ url("/stock/$product->id/edit") }}' class="btn btn-default">
										<i class="fa fa-pencil fa-btn"></i>
										Edit
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
