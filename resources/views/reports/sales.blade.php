@extends('layouts.app')

@section('title')
	Sales Report
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
				</div>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							@unless ($group)
								<th>Description</th>
							@endunless
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ d($row->created_at) }}</td>
								@unless ($group)
									<td>{{ $row->description }}</td>
								@endunless
								<td class="text-right">{{ m($row->amount) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
