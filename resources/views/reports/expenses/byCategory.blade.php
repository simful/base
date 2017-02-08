@extends('layouts.app')

@section('title')
	Expenses Report - By Category
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

				@include('reports.expenses.nav')

				<hr>

				<div class="row">
					<div class="col-md-8">
						{!! $chart->render() !!}
					</div>
					<div class="col-md-4">
						<table class="table">
							<thead>
								<tr>
									<th>Category</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
		                        @foreach ($groups as $group)
		                            <tr>
		                                <td>{{ $group->name }}</td>
		                                <td class="text-right">{{ m($group->aggregate) }}</td>
		                            </tr>
		                        @endforeach
							</tbody>
	                    </table>
					</div>
				</div>
		</div>
	</div>
@stop
