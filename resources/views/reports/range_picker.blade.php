<form class="form form-inline">
	<div class="form-group">
		<label class="control-label hide">From Date</label>
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="due_date" class="form-control datepicker" value="{{ $startDate }}">
			</div>
		</div>
	</div>

	to

	<div class="form-group">
		<label class="control-label hide">To Date</label>
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="due_date" class="form-control datepicker" value="{{ $endDate }}">
			</div>
		</div>
	</div>
</form>
