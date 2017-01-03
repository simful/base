<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Payment Receipt</title>
<link href="/emails.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">

<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" width="600">
			<div class="content">
				<table class="main" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="content-wrap aligncenter">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td class="content-block">
										<h1 class="aligncenter">{{ m($invoice->total[0]->price) }} Paid</h1>
									</td>
								</tr>
								<tr>
									<td class="content-block">
										<h2 class="aligncenter">Thank you for shopping in {{ $agent->name }}.</h2>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										<table class="invoice">
											<tr>
												<td>
													{{ $invoice->customer->name }}<br>
													Invoice #{{ $invoice->id }}<br>
													{{ d($invoice->created_at) }}
												</td>
											</tr>
											<tr>
												<td>
													<table class="invoice-items" cellpadding="0" cellspacing="0">
														@foreach ($invoice->details as $item)
															<tr>
																<td>{{ $item->description }}</td>
																<td class="alignright">{{ m($item->price) }}</td>
															</tr>
														@endforeach
														<tr class="total">
															<td>Total</td>
															<td class="alignright" width="30%">{{ m($invoice->total[0]->price) }}</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										<a href="http://www.mailgun.com">View in browser</a>
									</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
									 	{{ $agent->name }}<br>
										{{ $agent->address }}<br>
										{{ $agent->phone }}<br>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table width="100%">
						<tr>
							<td class="aligncenter content-block">Questions? Email <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></td>
						</tr>
					</table>
				</div></div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>
