<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Invoice</title>
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
							<td class="alert alert-warning">
								{{ $agent->name }}<br>
								Invoice #{{ $invoice->id }}
							</td>
						</tr>
						<tr>
							<td class="content-wrap">
								<table width="100%" cellpadding="0" cellspacing="0">
									<tr>
										<td class="content-block aligncenter">
											<table class="invoice" style="width: 100%; margin: 0;">
												<tr>
													<td style="font-size: 14px; padding-bottom: 30px"><b>To</b>
														<br>{{ $invoice->customer->name }}
														<br>{{ $invoice->customer->email }}
														<br>{{ $invoice->customer->address }}
													</td>
												</tr>
												<tr>
													<td>
														<table class="invoice-items" cellpadding="0" cellspacing="0">
															@foreach ($invoice->details as $detail)
															<tr>
																<td>{!! str_replace("\n", "
																	<br>", $detail->description) !!}</td>
																<td class="alignright">{{ m($detail->price) }}</td>
															</tr>
															@endforeach
															<tr class="total">
																<td width="80%">Total</td>
																<td class="alignright">{{ m($invoice->total[0]->price) }}
																	<td>
															</tr>
														</table>
														</td>
												</tr>
											</table>
										</td>
									</tr>

									<tr>
										<td class="content-block">
											Please notify us after payment. Thank you.
										</td>
									</tr>

									<tr>
										<td class="content-block" style="border-top: 1px solid #ccc; font-size: 12px; line-height: 16px; text-align: center">
											<br>{{ $agent->name }}
											<br>{{ $agent->address }} {{ $agent->city }}
											<br>Phone: {{ $agent->phone }}
											<br>Email: {{ $agent->email }}
											<br>Website: {{ $agent->website }}
										</td>
									</tr>

								</table>
								</td>
						</tr>
					</table>
					<div class="footer">
						<table width="100%">
							<tr>
								<td class="aligncenter content-block">Powered by <a href="https://travel.simful.com">Simful Travel</a>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</td>
				<td></td>
		</tr>
	</table>

</body>

</html>
