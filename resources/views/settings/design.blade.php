@extends('layouts.settings')

@section('settings')
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Logo</label>
			<img src="" class="img img-responsive" style="max-width: 100px">
		</div>

		<div class="form-group">
			<form action="/api/settings/upload-logo" method="post" enctype="multipart/form-data">
				<label class="control-label">Upload Logo</label>
				<input type="file" accept="image/*" name="logo" class="mbot20">
				<button class="btn btn-primary btn-sm" type="submit">
					<i class="fa fa-upload fa-btn"></i>
					Upload
				</button>
			</form>
		</div>

		<hr>

		<div class="form-group">
			<label class="control-label">Posisi Logo</label>
			<select class="form-control" value="agent_settings.data.logo_position">
				<option value="left">Kiri</option>
				<option value="top">Atas</option>
			</select>
		</div>

		<div class="form-group">
			<label class="control-label">Ukuran</label>
			<div class="input-group">
				<input type="number" value="agent_settings.data.logo_size" class="form-control text-right">
				<span class="input-group-addon">px</span>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Header</label>
			<textarea class="form-control" rows="6" value="agent_settings.data.document_header"></textarea>
		</div>

		<div class="form-group">
			<label class="control-label">Footer</label>
			<textarea class="form-control" rows="6" value="agent_settings.data.document_footer"></textarea>
		</div>
	</div>
@stop
