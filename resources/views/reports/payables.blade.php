@extends('layouts.app')

@section('title')
	Payables Report
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
							<th>Date</th>
							<th class="text-right">Amount</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ d($row->created_at) }}</td>
								<td class="text-right">{{ m($row->amount) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
