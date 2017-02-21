@extends('layouts.app')

@section('title')
	{{ $is_edit ? 'Edit' : 'Add' }} Product
@endsection

@section('content')
	<div class="container">
		<h2>
			@yield('title')
		</h2>

		@unless($is_edit)
			<form class="form" action="{{ url('products') }}" method="post" enctype="multipart/form-data">
		@endunless

		<div class="row">
			<div class="col-md-4 col-lg-3">
				<div class="box">
					<div class="box-body">
						<img src="{{ $product->picture }}" class="img img-responsive" style="max-height: 300px"/>
						<hr>
						@if ($is_edit)
							<form action="{{ url('products/' . $product->id . '/upload') }}" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<input type="file" name="picture">
								</div>

								<button type="submit" class="btn btn-primary">
									<i class="fa fa-upload"></i>
									Upload
								</button>
							</form>
						@else
							<div class="form-group">
								<input type="file" name="picture">
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-8 col-lg-9">
				@if ($is_edit)
					<form class="form" action="{{ url('products/' . $product->id) }}" method="post">
						<input type="hidden" name="_method" value="put">
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

							<div class="form-group">
								<label for="name" class="control-label">Name</label>
								<input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="price" class="control-label">Buy Price</label>
										<input type="text" name="buy_price" value="{{ old('buy_price', $product->buy_price) }}" class="form-control text-right">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="price" class="control-label">Sell Price</label>
										<input type="text" name="sell_price" value="{{ old('sell_price', $product->sell_price) }}" class="form-control text-right">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="description" class="control-label">Description</label>
								<textarea name="description" id="description" rows="10" class="form-control">{{ old('description', $product->description) }}</textarea>
							</div>

							<div class="form-group">
								<label class="control-label">
									Type
								</label>
								<select name="type" id="type" class="form-control">
								 	<option value="Product" {{ $product->type == 'Product' ? 'selected' : '' }}>Product</option>
								 	<option value="Service" {{ $product->type == 'Service' ? 'selected' : '' }}>Service</option>
								</select>
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
				@if ($is_edit)
					</form>
				@endif
			</div>
		</div>
		@if ($is_edit)
			</form>
		@endif
	</div>
@endsection
