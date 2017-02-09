@extends('layouts.app')

@section('title')
	Post to Journal
@endsection

@section('content')
	<div class="container">
		<form action="{{ url("invoices/$invoice->id/pay") }}" method="post">
			<div class="box">
				<div class="box-header">
					Post to Journal
				</div>
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Account</th>
								<th class="text-right">Debit</th>
								<th class="text-right">Credit</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name="cash_account_id" id="cash_account_id" class="form-control selectize-single">
										@foreach ($cash_accounts as $account)
											<option {{ old('cash_account_id', Setting::get('default_cash_account')) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->id }} - {{ $account->name }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-right">{{ m($invoice->total[0]->price) }}</td>
								<td class="text-right"></td>
							</tr>
							<tr>
								<td style="padding-left: 50px">
									<select name="sales_account_id" id="sales_account_id" class="form-control selectize-single">
										@foreach ($accounts as $account)
											<option {{ old('sales_account_id', Setting::get('default_sales_account')) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->id }} - {{ $account->name }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-right"></td>
								<td class="text-right">{{ m($invoice->total[0]->price) }}</td>
							</tr>
							<tr>
								<td>
									<select name="cogs_account_id" id="cogs_account_id" class="form-control selectize-single">
										@foreach ($accounts as $account)
											<option {{ old('cogs_account_id', Setting::get('default_cogs_account')) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->id }} - {{ $account->name }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-right">{{ m($invoice->total[0]->net) }}</td>
								<td class="text-right"></td>
							</tr>
							<tr>
								<td style="padding-left: 50px">
									<select name="deposit_account_id" id="deposit_account_id" class="form-control selectize-single">
										@foreach ($accounts as $account)
											<option {{ old('deposit_account_id', Setting::get('default_deposit_account')) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->id }} - {{ $account->name }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-right"></td>
								<td class="text-right">{{ m($invoice->total[0]->net) }}</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-check"></i>
						Confirm
					</button>

					<button type="button" class="btn btn-default" onclick="history.back()">
						<i class="fa fa-times"></i>
						Cancel
					</button>
				</div>
			</div>
		</form>
	</div>
@endsection
