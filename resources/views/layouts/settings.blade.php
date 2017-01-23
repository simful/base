@extends('layouts.app')

@section('title')
	Settings
@endsection

@section('content')
	@if (isset($settings_footer))
		<form id="settingsForm" action="{{ url('settings') }}" method="post">
			{{ csrf_field() }}
	@endif
		<div class="container">
			<div class="box">
				<div class="box-header">Settings</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-4 col-lg-3" style="border-right: 1px solid #eee;">
							<ul class="nav nav-stacked">
								<li ui-sref-active="active">
									<a href="{{ url('settings/main') }}">
										<i class="fa fa-wrench fa-btn"></i>
										General
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/company') }}">
										<i class="fa fa-building fa-btn"></i>
										Company
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/accounts') }}">
										<i class="fa fa-exchange fa-btn"></i>
										Default Accounts
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('users') }}">
										<i class="fa fa-user fa-btn"></i>
										Users
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/permissions') }}">
										<i class="fa fa-unlock-alt fa-btn"></i>
										Permissions
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/design') }}">
										<i class="fa fa-file-image-o fa-btn"></i>
										Design
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/regional') }}">
										<i class="fa fa-globe fa-btn"></i>
										Regional
									</a>
								</li>
								<li ui-sref-active="active" class="">
									<a href="{{ url('settings/mail') }}">
										<i class="fa fa-envelope-o fa-btn"></i>
										Email
									</a>
								</li>
							</ul>
						</div>
						<div class="col-md-8 col-lg-9">
							@yield('settings')
						</div>
					</div>
				</div>

				<div class="box-footer">
					@if (Session::has('message'))
						<div class="alert alert-success">
							{{ Session::get('message') }}
						</div>
					@endif
					@if (isset($settings_footer))
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-check"></i>
							Save Changes
						</button>
					@endif
				</div>
			</div>
		</div>
	@if (isset($settings_footer))
	</form>
	@endif
@endsection
