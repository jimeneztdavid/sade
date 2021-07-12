@extends('layouts.pdf.acreditacion')

@section('content')
	<h2 class="title center">Constancia de Acreditación</h2>
	<p class="paragraph">	Quien suscribe <span class="underlined">{{ $admin_nombre }} {{ $admin_apellido }}</span>, 
		venezolano, mayor de edad, portador de la Cédula de Identidad Nº {{ $admin_cedula }},
		 Director de Deportes  de la Universidad Politécnica Territorial de Falcón Alonso Gamero,
		  hace constar que el Estudiante: <span class="underlined">{{ $nombre }} {{ $apellido }} </span> 
		  CI Nº: <span class="underlined">{{ $cedula }}</span>, es ATLETA de esta Institución.</p>
@endsection

@section('footer')
	<p class="paragraph">	
		Constancia que se expide de parte interesada, en Santa Ana de Coro a los 
		<span class="underlined"> {{ $day_number }} </span>
		 días del mes de <span class="underlined">{{ $month }}</span> de 
		 <span class="underlined">{{ $year }}</span>
	</p>
@endsection

@section('sign')
	<p class="center">
		Director de Deportes de la UPTAG
	</p>
@endsection