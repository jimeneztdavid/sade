<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Acreditación</title>

	{{-- usar la siguiente clase para añadir saltos de página --}}
	{{-- de esta forma <div class="page-break"></div> --}}
	<style>
		.page-break {
		    page-break-after: always;
		}
	</style>

	<style>
		@page {
			margin: 40px 60px;
		}

		p {
			line-height: 1.5em;
			font-size: 14px;
			font-family: Arial, sans-serif;
		}

		.title {
			margin: 60px 0px;
		}

		.content {
			text-align: justify;
			margin: 40px 0px;
		}

		.center {
			text-align: center;
		}

		.underlined {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<header>
		<img src="{{ public_path() . '/images/logo-full.jpg' }}" width="200" />
	</header>

	<div class="content">
		@yield('content')
	</div>

	<div class="footer">
		@yield('footer')
	</div>

	<br/><br/>

	<div class="sign">
		<hr/ style="max-width: 200px">
		<br/>
		@yield('sign')
	</div>
</body>
</html>