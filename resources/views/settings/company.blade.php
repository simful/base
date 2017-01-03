@extends('layouts.settings')

@section('settings')
	<div class="form-group">
		<label class="control-label">Nama Agen</label>
		<input type="text" class="form-control" value="{{ old('name', $settings->name) }}" name="name">
	</div>

	<div class="form-group">
		<label for="email" class="control-label">Email</label>
		<input type="email" class="form-control" value="{{ old('email', $settings->email) }}" name="email">
	</div>

	<div class="form-group">
		<label for="phone" class="control-label">Telepon</label>
		<input type="text" class="form-control" value="{{ old('phone', $settings->phone) }}" name="phone">
	</div>

	<div class="form-group">
		<label class="control-label">Alamat</label>
		<textarea class="form-control" name="address">{{ old('address', $settings->address) }}</textarea>
	</div>

	<div class="form-group">
		<label class="control-label">Kota</label>
		<input type="text" class="form-control" value="{{ old('city', $settings->city) }}" name="city">
	</div>

	<div class="form-group">
		<label class="control-label">Propinsi</label>
		<input type="text" class="form-control" value="{{ old('state', $settings->state) }}" name="state">
	</div>

	<div class="form-group">
		<label class="control-label">Negara</label>
		<input type="text" class="form-control" value="{{ old('country', $settings->country) }}" name="country">
	</div>

	<div class="form-group">
		<label class="control-label">Website</label>
		<input type="text" class="form-control" value="{{ old('website', $settings->website) }}" name="website">
	</div>
@stop
