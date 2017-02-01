@extends('layouts.app')

@section('title')
	Update Stock
@stop

@section('content')
	<form action='{{ url("stock/$product->id") }}' method="post">
		<input type="hidden" name="_method" value="put">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="box">
						<div class="box-header">
							Update Stock: {{ $product->name }}
						</div>
						<div class="box-body">
							<div class="form-group">
								<label class="control-label">Current Stock</label>
								<p class="form-control-static">{{ $product->stock }}</p>
							</div>

							<div class="form-group">
								<label class="control-label">New Stock</label>
								<input class="form-control" name="stock" type="number" value="{{ $product->stock }}">
							</div>

							<div class="form-group">
								<label class="control-label">Reason</label>
								<textarea rows="6" name="reason" class="form-control"></textarea>
							</div>
						</div>
						<div class="box-footer">
							<button class="btn btn-primary">
								<i class="fa fa-check"></i>
								Save Changes
							</button>

							<a href="{{ url('stock') }}" class="btn btn-default">
								<i class="fa fa-times"></i>
								Cancel
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-6"></div>
			</div>
		</div>
	</form>
@stop
