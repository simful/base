@extends('layouts.app')

@section('title')
	Income Statement
@endsection

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
					<tbody>
						<tr>
							<td colspan="7" class="text-bold">Pendapatan</td>
						</tr>

						@foreach ($data->revenue as $item)
							<tr>
								<td></td>
								<td colspan="5">{{ $item->name }}</td>
								<td class="text-right">{{ m($item->amount) }}</td>
							</tr>
							<?php $totals['revenue'] += $item->amount; ?>
						@endforeach

						<tr>
							<td></td>
							<td colspan="5" class="text-bold">Total Pendapatan</td>
							<td class="text-right text-bold">{{ m($totals['revenue']) }}</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td colspan="7" class="text-bold">Harga Pokok Penjualan</td>
						</tr>

						@foreach ($data->cgs as $item)
							<tr>
								<td></td>
								<td colspan="4">{{ $item->name }}</td>
								<td class="text-right">{{ m($item->amount) }}</td>
								<td></td>
							</tr>
							<?php $totals['cgs'] += $item->amount; ?>
						@endforeach

						<tr>
							<td></td>
							<td colspan="5" class="text-bold">Total HPP</td>
							<td class="text-right text-bold">{{ m($totals['cgs']) }}</td>
						</tr>
					</tbody>
					<tbody>
						<?php $totals['gross'] = $totals['revenue'] - $totals['cgs']; ?>
						<tr>
							<td colspan="6" class="text-bold">Laba Kotor</td>
							<td class="text-right text-bold">{{ m($totals['gross']) }}</td>
						</tr>
					</tbody>
					<tbody>
						<tr>
							<td colspan="7" class="text-bold">Biaya Operasional</td>
						</tr>
						@foreach ($data->expenses as $item)
							<tr>
								<td></td>
								<td colspan="4">{{ $item->name }}</td>
								<td class="text-right">{{ m($item->amount) }}</td>
								<td></td>
							</tr>
							<?php $totals['expenses'] += $item->amount; ?>
						@endforeach
						<tr>
							<td></td>
							<td colspan="5" class="text-bold">Total Biaya</td>
							<td class="text-right text-bold">{{ m($totals['expenses']) }}</td>
						</tr>
					</tbody>
					<tbody>
						<?php $totals['net_income'] = $totals['gross'] - $totals['expenses']; ?>
						<tr>
							<td colspan="6" class="text-bold">Laba Bersih</td>
							<td class="text-right text-bold">{{ m($totals['net_income']) }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection
