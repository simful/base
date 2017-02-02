<form class="form form-inline" method="get">
	<div class="form-group">
		<label class="control-label hide">From Date</label>
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="startDate" class="form-control datepicker" value="{{ $startDate }}">
			</div>
		</div>
	</div>

	to

	<div class="form-group">
		<label class="control-label hide">To Date</label>
		<div class="row">
			<div class="col-md-4">
				<input type="text" name="endDate" class="form-control datepicker" value="{{ $endDate }}">
			</div>
		</div>
	</div>

	<button type="submit" class="btn btn-primary">
		<i class="fa fa-check"></i>
	</button>
</form>
