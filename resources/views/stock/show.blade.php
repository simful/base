@extends('layouts.app')

@section('title')
	Stock History
@stop

@section('content')
	<div class="container">
		<h2>Stock History</h2>

		<a href="{{ url('stock') }}" class="btn btn-default" style="margin-bottom: 20px;">
			<i class="fa fa-arrow-left"></i>
			Back to Stock
		</a>
	
		<div class="box mtop20">
			<div class="box-header">
				{{ $product->name }}
			</div>
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Description</th>
							<th class="text-right">In</th>
							<th class="text-right">Out</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($product->stockHistory as $row)
							<tr>
								<td>{{ d($row->created_at) }}</td>
								<td>{{ $row->description }}</td>
								<td class="text-right">{{ $row->in }}</td>
								<td class="text-right">{{ $row->out }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
