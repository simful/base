@extends('layouts.app')

@section('title')
	Sales Report - By Date
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
					@include('reports.sales.nav')
				</div>
				<hr>
				{!! $chart ? $chart->render() : '' !!}
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ d($row->created_at) }}</td>
								<td class="text-right">{{ m($row->aggregate) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
