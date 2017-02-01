@extends('layouts.app')

@section('title')
	Receivables Report
@endsection

@section('content')
	<div class="container">
		<div class="box">
			<div class="box-body">
				<div>
					<h2>@yield('title')</h2>
				</div>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Customer</th>
							<th>Due Date</th>
							<th class="text-right">Not Yet Due</th>
							<th class="text-right">0 - 30 days</th>
							<th class="text-right">31 - 60 days</th>
							<th class="text-right"> > 60 days</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ $row->customer->name }}</td>
								<td>{{ d($row->due_date) }}</td>
								<?php $amount = count($row->total) ? m($row->total[0]->price - $row->amount_paid) : 0; ?>
								<td class="text-right">{{ $row->due_date->diffInDays() < 0 ? $amount : '' }}</td>
								<td class="text-right">{{ $row->due_date->diffInDays() < 30 && $row->due_date->diffInDays() >= 0 ? $amount : '' }}</td>
								<td class="text-right">{{ $row->due_date->diffInDays() < 60 && $row->due_date->diffInDays() >= 30 ? $amount : '' }}</td>
								<td class="text-right">{{ $row->due_date->diffInDays() > 60 ? $amount : '' }}</td>
							</tr>
							<?php $total += $amount; ?>
						@endforeach
						<tr>
							<th>Total</th>
							<th colspan="5" class="text-right">{{ m($total) }}</th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
