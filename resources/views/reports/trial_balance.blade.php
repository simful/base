@extends('layouts.app')

@section('title')
	Trial Balance
@endsection

@section('content')
	<div class="container">
		<div class="box">
			<div class="box-body">
				<div>
					<h2>@yield('title')</h2>
				</div>
				<hr>
				<table class="table table-responsive table-clickable">
					<thead>
						<tr>
							<th>#</th>
							<th>Account</th>
							<th>Debet</th>
							<th>Kredit</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data as $row)
							<tr>
								<td>{{ $row->id }}</td>
								<td>{{ $row->account }}</td>
								<td class="text-right">{{ m($row->debit) }}</td>
								<td class="text-right">{{ m($row->credit) }}</td>
								<?php
									$totals->debit += $row->debit;
									$totals->credit += $row->credit;
								?>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr class="text-bold">
							<td colspan="2">Total</td>
							<td class="text-right">{{ m($totals->debit) }}</td>
							<td class="text-right">{{ m($totals->credit) }}</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
@endsection
