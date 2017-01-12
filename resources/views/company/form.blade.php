@extends('layouts.settings')

@section('settings')
	@if (File::exists(public_path() . "/logo/" . md5(Auth::user()->agent_id) . '.jpg'))
		<div class="form-group">
			<img src="/logo/{{ md5(Auth::user()->agent_id) }}.jpg" style="max-height: 200px; max-width: 200px"/>
		</div>
	@endif

	<form action="/settings/upload-logo" method="post" enctype="multipart/form-data">
		<label class="control-label">Upload Logo</label>
		<input type="file" accept="image/*" name="logo" class="mbot20">
		<button class="btn btn-primary btn-sm" type="submit">
			<i class="fa fa-upload fa-btn"></i>
			Upload
		</button>
	</form>

	<hr>

	<form action="{{ url('settings/company') }}" method="post">
		<div class="form-group">
			<label class="control-label">Nama Agen</label>
			<input type="text" class="form-control" value="{{ old('name', $company->name) }}" name="name">
		</div>

		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<input type="email" class="form-control" value="{{ old('email', $company->email) }}" name="email">
		</div>

		<div class="form-group">
			<label for="phone" class="control-label">Telepon</label>
			<input type="text" class="form-control" value="{{ old('phone', $company->phone) }}" name="phone">
		</div>

		<div class="form-group">
			<label class="control-label">Alamat</label>
			<textarea class="form-control" name="address">{{ old('address', $company->address) }}</textarea>
		</div>

		<div class="form-group">
			<label class="control-label">Kota</label>
			<input type="text" class="form-control" value="{{ old('city', $company->city) }}" name="city">
		</div>

		<div class="form-group">
			<label class="control-label">Propinsi</label>
			<input type="text" class="form-control" value="{{ old('state', $company->state) }}" name="state">
		</div>

		<div class="form-group">
			<label class="control-label">Negara</label>
			<input type="text" class="form-control" value="{{ old('country', $company->country) }}" name="country">
		</div>

		<div class="form-group">
			<label class="control-label">Website</label>
			<input type="text" class="form-control" value="{{ old('website', $company->website) }}" name="website">
		</div>

		<hr>

		<button class="btn btn-primary" type="submit">
			<i class="fa fa-check"></i>
			Save Changes
		</button>
	</form>
@stop
