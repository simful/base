@extends('layouts.settings')

@section('settings')
	<?php $accounts = Account::all(); ?>
	<h3>Default Accounts</h3>
	<div class="col-md-6">
		<div class="form-group">
			<label for="cash" class="control-label">Cash Account</label>
			<select class="form-control selectize-single" name="default_cash_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_cash_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="cash" class="control-label">Sales Account</label>
			<select class="form-control selectize-single" name="default_sales_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_sales_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="cash" class="control-label">Cost of Goods Sold Account</label>
			<select class="form-control selectize-single" name="default_cogs_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_cogs_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="cash" class="control-label">Warehouse/Deposit Account</label>
			<select class="form-control selectize-single" name="default_deposit_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_deposit_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="cash" class="control-label">Receivables Account</label>
			<select class="form-control selectize-single" name="default_receivables_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_receivables_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="cash" class="control-label">Payables Account</label>
			<select class="form-control selectize-single" name="default_payables_account">
				@foreach ($accounts as $account)
					<option value="{{ $account->id }}" {{ $settings->default_payables_account == $account->id ? 'selected' : '' }}>{{ $account->id }} - {{ $account->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
@stop
