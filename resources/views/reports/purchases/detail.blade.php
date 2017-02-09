@extends('layouts.app')

@section('title')
	Purchases Report - Detailed
@stop

@section('content')
	<div class="container">
		<div class="box">
			<div class="box-body">
				<div>
					<span class="pull-right">
						@include('reports.range_picker')
					</span>
					<h2>@yield('title')</h2>
					@include('reports.purchases.nav')
				</div>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Description</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ d($row->created_at) }}</td>
								<td>{{ $row->description }}</td>
								<td class="text-right">{{ m($row->amount) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
