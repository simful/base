<div class="box">
	<div class="box-header">
		Actions
	</div>
	<div class="box-body">
		<ul class="nav nav-stacked">

			{{-- kalau statusnya draft, masih bisa edit dan delete. action hanya finalize. --}}

			@if ($invoice->status == 'Draft')
				<li>
					<a href="#" class="invoice-action" data-action="finalize" data-id="{{ $invoice->id }}">
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
			@else

				{{-- setelah difinalize, pilihannya receive payment dan update stock. --}}

 				@if ($invoice->paid)
					<li class="nav-static">
						<i class="fa fa-check-circle fa-btn"></i> Paid
					</li>
				@else
					<li>
						<a href="{{ url("invoices/$invoice->id/pay") }}">
							<i class="fa fa-check fa-icon"></i>
							Post to Journal...
						</a>
					</li>
				@endif

				@if ($invoice->stock_updated)
					<li class="nav-static">
						<i class="fa fa-check-circle fa-btn"></i> Stock Updated
					</li>
				@else
					<li>
						<a href="#" class="invoice-action" data-action="updateStock" data-id="{{ $invoice->id }}">
							<i class="fa fa-check fa-icon"></i>
							Update Stock...
						</a>
					</li>
				@endif

				<li>
					<a href="#" class="delete-invoice" data-id="{{ $invoice->id }}">
						<i class="fa fa-times fa-icon"></i>
						Cancel &amp; Delete Invoice
					</a>
				</li>

				<hr>

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

			@endif
		</ul>
	</div>
</div>
