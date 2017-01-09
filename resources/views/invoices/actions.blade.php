<ul class="nav nav-stacked">
	@if ($invoice->status == 'Draft')
		<li>
			<a href="{{ url("invoices/$invoice->id/edit") }}">
				<i class="fa fa-pencil"></i>
				Edit Invoice
			</a>
		</li>

		<li>
			<a href="{{ url("invoices/$invoice->id/edit") }}">
				<i class="fa fa-trash"></i>
				Delete Invoice
			</a>
		</li>

		<li>
			<a href="#" class="invoice-action" data-action="send" data-id="{{ $invoice->id }}">
				<i class="fa fa-arrow-right"></i>
				Send
			</a>
		</li>
	@endif

	@if ($invoice->status == 'Sent')
		<li>
			<a href="#" class="invoice-action" data-action="confirm-payment" data-id="{{ $invoice->id }}">
				<i class="fa fa-check"></i>
				Receive Payment...
			</a>
		</li>
		<li>
			<a href="#">
				<i class="fa fa-times"></i>
				Cancel &amp; Delete Invoice
			</a>
		</li>
	@endif

	@if ($invoice->status == 'Shipping')
		<button class="btn btn-default">
			Cancel Shipping
		</button>
	@endif

	@if ($invoice->status == 'In Progress')
		<li>
			<a href="#" onclick="window.print()">
				<i class="fa fa-print"></i>
				Print
			</a>
		</li>

		<li>
			<a href="#" onclick="window.print()">
				<i class="fa fa-times"></i>
				Cancel and Refund
			</a>
		</li>
	@endif

	@if ($invoice->status == 'Completed')

	@endif
</ul>
