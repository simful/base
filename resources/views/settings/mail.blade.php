@extends('layouts.settings')

@section('settings')
	<div class="form-group">
		<label class="control-label">E-mail Provider</label>
		<select class="form-control" value="agent_settings.data.outgoing_mail_provider">
			<option value="gmail">Gmail</option>
			<option value="yahoo">Yahoo</option>
			<option value="manual">Lainnya / isi setting di bawah</option>
		</select>
	</div>

	<div class="form-group">
		<label class="control-label">Alamat E-mail</label>
		<input class="form-control" type="email" value="agent_settings.data.outgoing_mail_address">
	</div>

	<div class="form-group">
		<label class="control-label">Password E-mail</label>
		<input class="form-control" type="password" value="agent_settings.data.outgoing_mail_password">
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
			<input class="form-control" type="text" value="agent_settings.data.smtp_server">
		</div>

		<div class="form-group">
			<label class="control-label">SMTP Port</label>
			<input class="form-control" type="text" value="agent_settings.data.smtp_port">
		</div>

		<div class="form-group">
			<label class="control-label">Connection</label>
			<input class="form-control" type="text" value="TLS" disabled>
		</div>
	</div>
@endsection
