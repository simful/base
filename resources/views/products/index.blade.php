@extends('layouts.app')

@section('title')
	Products
@endsection

@section('content')
	<div class="container">
		<h2>Products</h2>

		<div class="mbot20">
			<a href="{{ url('products/create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add Product
			</a>

			<form class="form-inline pull-right">
				@include('partials.search-form')
			</form>
		</div>

		@foreach ($products as $product)
			<div class="box">
				<div class="box-body">

					<div class="row">
						<div class="col-md-2">
							<img class="img img-responsive" src="{{ $product->picture }}"/>
						</div>
						<div class="col-md-10">
							<div class="pull-right">
								<div class="btn-group">
									<a class="btn btn-default" href="{{ url('products/' . $product->id . '/edit') }}">
										<i class="fa fa-pencil"></i>
										Edit
									</a>
									<button class="btn btn-default delete-product" data-id="{{ $product->id }}">
										<i class="fa fa-trash"></i>
										Delete
									</button>
								</div>
							</div>

							<h4>{{ $product->name }}</h4>

							<hr>

							<p>{{ $product->description }}</p>

							<div class="row">
								<div class="col-md-3 separate-col">
									<label>Buy Price</label>
									<p>{{ m($product->buy_price) }}</p>
								</div>
								<div class="col-md-3 separate-col">
									<label>Sell Price</label>
									<p>{{ m($product->sell_price) }}</p>
								</div>
								<div class="col-md-3">
									<label>Margin</label>
									<p>{{ m($product->sell_price - $product->buy_price) }}</p>
								</div>
								<div class="col-md-3">
									<label>Stock</label>
									<p>{{ $product->stock }}</p>
								</div>
							</div>
							<p></p>

						</div>
					</div>
				</div>
			</div>
		@endforeach

		{{ $products->links() }}

	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-product').click(function() {
				var productId = $(this).attr('data-id');
				if (confirm('Are you sure you want to delete ' + productId + '?')) {
					$.ajax('/products/' + productId, {
						method: 'DELETE',
						complete: function() {
							location.reload();
						}
					});
				}
			});
		});
	</script>
@stop
