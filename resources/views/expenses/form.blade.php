@extends('layouts.app')

@section('title')
	Add/Edit Expense
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		@if ($is_edit)
			<form class="form" action="{{ url('expenses/' . $expense->id) }}" method="post">
				<input type="hidden" name="_method" value="put">
		@else
			<form class="form" action="{{ url('expenses') }}" method="post">
		@endif
			<div class="box">
				<div class="box-body">
					@if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="source_account_id" class="control-label">From</label>
								<select name="source_account_id" id="source_account_id" class="form-control selectize-single">
									@foreach ($source_accounts as $account)
										<option {{ old('source_account_id', $expense->source_account_id) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="expense_account_id" class="control-label">To</label>
								<select name="expense_account_id" id="expense_account_id" class="form-control selectize-single">
									@foreach ($expense_accounts as $account)
										<option {{ old('expense_account_id', $expense->expense_account_id) == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="amount" class="control-label">Amount</label>
								<input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="amount" class="control-label">Description</label>
								<textarea rows="8" class="form-control" name="description" id="description">{{ old('description', $expense->description) }}</textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="box-footer">
					<button class="btn btn-primary" type="submit">
						<i class="fa fa-check"></i>
						Save Changes
					</button>

					<a href="{{ url('/expenses') }}" class="btn btn-default">
						<i class="fa fa-times"></i>
						Cancel
					</a>
				</div>
			</div>
		</form>
	</div>

@endsection
