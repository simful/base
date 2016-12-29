@extends('layouts.app')

@section('title')
	{{ $account->name }}
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		<div class="mbot20">
			<a href="{{ url('accounts') }}" class="btn btn-primary">
				<i class="fa fa-chevron-left"></i>
				Back to Accounts
			</a>
		</div>

		<div class="box">
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Description</th>
							<th>Debit</th>
							<th>Credit</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($transactions as $detail)
							<tr>
								<td class="actions">{{ $detail->transaction->created_at->toFormattedDateString() }}</td>
								<td>{{ $detail->transaction->description }}</td>
								<td>{!! mp($detail->debit) !!}</td>
								<td>{!! mp($detail->credit) !!}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				{{ $transactions->links() }}
			</div>
		</div>
	</div>
@endsection
