<div class="box">
	<div class="box-header">
		Actions
	</div>
	<div class="box-body">
		<ul class="nav nav-stacked">
			@if ($purchase->status == 'Draft')
				<li>
					<a href="{{ url("/purchases/$purchase->id/edit") }}">
						<i class="fa fa-pencil fa-icon"></i>
						Edit Invoice
					</a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-times fa-icon"></i>
						Delete Invoice
					</a>
				</li>
				<hr>
				<li>
					<a href="#" class="invoice-action" data-action="process" data-id="{{ $purchase->id }}">
						<i class="fa fa-arrow-circle-right fa-icon"></i>
						Process Invoice
					</a>
				</li>
			@endif
		</ul>
	</div>
</div>
