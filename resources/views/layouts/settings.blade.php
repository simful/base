@extends('layouts.app')

@section('title')
	Settings
@endsection

@section('content')
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
								<a href="{{ url('settings/users') }}">
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
						<form action="{{ url('settings/set') }}" method="post">
							@yield('settings')
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
