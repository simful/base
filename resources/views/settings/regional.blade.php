@extends('layouts.settings')

@section('settings')
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Locale</label>
				<select class="form-control" value="agent_settings.data.locale">
					<option value="id_ID">Indonesia (id_ID)</option>
					<option value="en_US">English (en_US)</option>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Mata Uang</label>
				<input type="text" class="form-control" value="agent_settings.default_currency">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Format Tanggal</label>
				<input type="text" class="form-control" value="agent_settings.data.date_format">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Format Waktu</label>
				<input type="text" class="form-control" value="agent_settings.data.time_format">
			</div>
		</div>
	</div>
@endsection
