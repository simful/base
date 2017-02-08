@extends('layouts.settings')

@section('settings')
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Posisi Logo</label>
			<select class="form-control" value="agent_settings.data.logo_position">
				<option value="left" {{ $settings->logo_position == 'left' ? 'selected' : '' }}>Kiri</option>
				<option value="top" {{ $settings->logo_position == 'top' ? 'selected' : '' }}>Atas</option>
			</select>
		</div>

		<div class="form-group">
			<label class="control-label">Ukuran</label>
			<div class="input-group">
				<input type="number" value="{{ $settings->logo_size }}" name="logo_size" class="form-control text-right">
				<span class="input-group-addon">px</span>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Header</label>
			<textarea class="form-control" rows="6" name="header_content">{{ $settings->header_content }}</textarea>
		</div>

		<div class="form-group">
			<label class="control-label">Footer</label>
			<textarea class="form-control" rows="6" name="footer_content">{{ $settings->footer_content }}</textarea>
		</div>
	</div>
@stop
