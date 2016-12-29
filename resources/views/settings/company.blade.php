@extends('layouts.settings')

@section('settings')
	<div class="form-group">
		<label class="control-label">Nama Agen</label>
		<input type="text" class="form-control" value="tenant.data.name">
	</div>

	<div class="form-group">
		<label for="email" class="control-label">Email</label>
		<input type="email" class="form-control" value="tenant.data.email">
	</div>

	<div class="form-group">
		<label for="phone" class="control-label">Telepon</label>
		<input type="text" class="form-control" value="tenant.data.phone">
	</div>

	<div class="form-group">
		<label class="control-label">Alamat</label>
		<textarea class="form-control">tenant.data.address</textarea>
	</div>

	<div class="form-group">
		<label class="control-label">Kota</label>
		<input type="text" class="form-control" value="tenant.data.city">
	</div>

	<div class="form-group">
		<label class="control-label">Propinsi</label>
		<input type="text" class="form-control" value="tenant.data.state">
	</div>

	<div class="form-group">
		<label class="control-label">Negara</label>
		<input type="text" class="form-control" value="tenant.data.country">
	</div>

	<div class="form-group">
		<label class="control-label">Website</label>
		<input type="text" class="form-control" value="tenant.data.website">
	</div>
@stop
