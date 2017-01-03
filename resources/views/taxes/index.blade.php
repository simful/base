@extends('layouts.app')

@section('title')
	Taxes
@endsection

@section('content')
	<div class="container">
		<h2>@yield('title')</h2>

		<div class="mbot20">
			<a href="{{ url('taxes/create') }}" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add Tax
			</a>

			<form class="form-inline pull-right">
				@include('partials.search-form')
			</form>
		</div>

		<div class="box">
			<div class="box-body">
				<table class="table">
					<thead>
						<tr>
							<th>Code</th>
							<th>Name</th>
							<th>Rate</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($taxes as $tax)
							<tr>
								<td>{{ $tax->code }}</td>
								<td>{{ $tax->name }}</td>
								<td>{{ $tax->rate }}</td>
								<td class="actions">
									<a class="btn btn-default" href="/taxes/{{ $tax->id }}/edit">
										<i class="fa fa-pencil"></i>
									</a>&nbsp;
									<a class="btn btn-default delete-tax">
										<i class="fa fa-trash"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

				{{ $taxes->links() }}
			</div>
		</div>

	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('.delete-tax').click(function() {
				var taxId = $(this).attr('data-id');
				if (confirm('Are you sure you want to delete ' + taxId + '?')) {
					$.ajax('/taxes/' + taxId, {
						method: 'DELETE',
						complete: function() {
							location.reload();
						}
					});
				}
			});
		});
	</script>
@stop
