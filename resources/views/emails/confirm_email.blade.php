@php
	$app_name = config('app.name');
	$support_mail = config('mail.from.address');
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Confirm your email for {{ $app_name }}</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				background: #f6f7fb;
				color: #111827;
				font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			}
			.wrapper {
				width: 100%;
				padding: 32px 16px;
			}
			.container {
				max-width: 600px;
				margin: 0 auto;
				background: #ffffff;
				border-radius: 12px;
				overflow: hidden;
				box-shadow: 0 10px 30px rgba(17, 24, 39, 0.08);
			}
			.header {
				padding: 28px 32px;
				background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
				color: #ffffff;
			}
			.header h1 {
				margin: 0;
				font-size: 24px;
				font-weight: 700;
			}
			.content {
				padding: 28px 32px 32px;
				line-height: 1.6;
				font-size: 15px;
			}
			.content h2 {
				font-size: 18px;
				margin: 0 0 12px;
				color: #111827;
			}
			.button {
				display: inline-block;
				margin-top: 18px;
				padding: 12px 20px;
				background: #4f46e5;
				color: #ffffff;
				text-decoration: none;
				border-radius: 8px;
				font-weight: 600;
			}
			.list {
				margin: 16px 0 0;
				padding: 0 0 0 18px;
			}
			.footer {
				padding: 20px 32px 28px;
				font-size: 12px;
				color: #6b7280;
				background: #f9fafb;
				text-align: center;
			}
			.footer a {
				color: #4f46e5;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="header">
					<h1>Confirm your email</h1>
				</div>
				<div class="content">
					<h2>Hi {{ $username ?? 'there' }},</h2>
					<p>
						Please confirm your email address to finish setting up your {{ $app_name }} account.
						This helps us keep your account secure.
					</p>
					<p>Click the button below to confirm your email address:</p>
					@if (!empty($confirmation_link))
						<a class="button" href="{{ $confirmation_link }}">Confirm email</a>
					@endif
					<p>If the button doesn't work, copy and paste this link into your browser:</p>
					@if (!empty($confirmation_link))
						<p><a href="{{ $confirmation_link }}">{{ $confirmation_link }}</a></p>
					@endif
					<p>
						If you didn't create an account, you can ignore this email.
						If you have questions, reply to this email or reach us at
						<a href="mailto:{{ $support_mail }}">{{ $support_mail }}</a>.
					</p>
					<p>Thanks,<br>The {{ $app_name }} Team</p>
				</div>
				<div class="footer">
					<p>
						You are receiving this email because someone signed up for {{ $app_name }} with this email address.
						If this wasn't you, please contact
						<a href="mailto:{{ $support_mail }}">{{ $support_mail }}</a>.
					</p>
					<p>&copy; {{ now()->year }} {{ $app_name }}. All rights reserved.</p>
				</div>
			</div>
		</div>
	</body>
</html>
