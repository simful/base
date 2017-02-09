<div class="box">
	<div class="box-header">
		Actions
	</div>
	<div class="box-body">
		<ul class="nav nav-stacked">


			@if ($invoice->status == 'Draft')
				<li>
					<a href="#" class="invoice-action" data-action="send" data-id="{{ $invoice->id }}">
						<i class="fa fa-arrow-right fa-icon"></i>
						Finalize Invoice
						<small class="help-block">
							Finishes creating invoice and its items.
						</small>
					</a>

				</li>

				<hr>

				<li>
					<a href="{{ url("invoices/$invoice->id/edit") }}">
						<i class="fa fa-pencil fa-icon"></i>
						Edit Invoice
					</a>
				</li>

				<li>
					<a href="#" class="delete-invoice" data-id="{{ $invoice->id }}">
						<i class="fa fa-trash fa-icon"></i>
						Delete Invoice
					</a>
				</li>
			@endif

			@if ($invoice->status == 'Sent')
				<li>
					<a href="#" class="invoice-action" data-action="confirm-payment" data-id="{{ $invoice->id }}">
						<i class="fa fa-check fa-icon"></i>
						Receive Payment...
					</a>
				</li>
				<li>
					<a href="#" class="delete-invoice" data-id="{{ $invoice->id }}">
						<i class="fa fa-times fa-icon"></i>
						Cancel &amp; Delete Invoice
					</a>
				</li>
			@endif

			@if ($invoice->status == 'Shipping')
				<a href="#">
					Cancel Shipping
				</a>
			@endif

			@if ($invoice->status == 'In Progress')
				<li>
					<a href="#" class="invoice-action" data-action="complete" data-id="{{ $invoice->id }}">
						<i class="fa fa-check-circle fa-icon"></i>
						Complete Transaction
					</a>
				</li>

				<li>
					<a href="#" onclick="window.print()">
						<i class="fa fa-times fa-icon"></i>
						Cancel and Refund
					</a>
				</li>
			@endif

			@if ($invoice->status == 'Completed')

			@endif

			<li>
				<a href="{{ url("invoices/$invoice->id/print") }}" target="_blank">
					<i class="fa fa-print fa-icon"></i>
					Print
				</a>
			</li>

			<li>
				<a href="#" onclick="window.print()">
					<i class="fa fa-print fa-icon"></i>
					Email Invoice
				</a>
			</li>

			<li>
				<a href="#" onclick="window.print()">
					<i class="fa fa-print fa-icon"></i>
					Email Receipt
				</a>
			</li>
		</ul>
	</div>
</div>

@if ($invoice->status != 'Draft')
	@if ($invoice->paid)
		<div class="alert alert-success">
			<i class="fa fa-check fa-btn"></i> This invoice is fully paid.
		</div>
	@else
		<div class="alert alert-warning">
			<i class="fa fa-times fa-btn"></i> No payment received yet.
		</div>
	@endif

	@if ($invoice->stock_updated)
		<div class="alert alert-success">
			<i class="fa fa-check fa-btn"></i> Stock updated.
		</div>
	@else
		<div class="alert alert-warning">
			<i class="fa fa-times fa-btn"></i> Stock not updated yet.
		</div>
	@endif
@endif
