@extends('layouts.settings')

@section('settings')
	<div class="form-group">
		<label class="control-label">E-mail Provider</label>
		<select class="form-control" name="mail_provider">
			<option value="none" {{ $settings->mail_provider == 'none' ? 'selected' : '' }}>None</option>
			<option value="gmail" {{ $settings->mail_provider == 'gmail' ? 'selected' : '' }}>Gmail</option>
			<option value="yahoo" {{ $settings->mail_provider == 'yahoo' ? 'selected' : '' }}>Yahoo</option>
			<option value="manual" {{ $settings->mail_provider == 'manual' ? 'selected' : '' }}>Lainnya / isi setting di bawah</option>
		</select>
	</div>

	<div class="form-group">
		<label class="control-label">Alamat E-mail</label>
		<input class="form-control" type="email" value="{{ $settings->mail_address }}" name="mail_address" autocomplete="off">
	</div>

	<div class="form-group">
		<label class="control-label">Password E-mail</label>
		<input class="form-control" type="password" value="{{ $settings->mail_password }}" name="mail_password" autocomplete="off">
	</div>

	<hr>

	<div>
		<p>
			<b>Advanced</b> - dibawah ini hanya untuk setting manual. Jika
			menggunakan e-mail Yahoo atau Gmail, setting ini
			tidak perlu diisi.
		</p>

		<hr>

		<div class="form-group">
			<label class="control-label">SMTP Server</label>
			<input class="form-control" type="text" value="{{ $settings->smtp_server }}" name="smtp_server">
		</div>

		<div class="form-group">
			<label class="control-label">SMTP Port</label>
			<input class="form-control" type="text" value="{{ $settings->smtp_port }}" name="smtp_port">
		</div>

		<div class="form-group">
			<label class="control-label">Connection</label>
			<input class="form-control" type="text" value="TLS" disabled>
		</div>
	</div>
@endsection
