@extends('layouts.pdf.acreditacion')

@section('content')
	<h2 class="title center">Constancia de Participación</h2>
	<p class="paragraph">
		Quien suscribe, Jefe de la Cooridnación de Deportes de la Universidad Politécnica
		Territorial “Alonso Gamero” hace constar que el estudiante: 
		<span class="underlined">{{ $nombre }} {{ $apellido }}</span> portador de la cédula de identidad 
		<span class="underlined">{{ $cedula }}</span>,
		 participará en un encuentro deportivo que tiene como descripción: {{ $descripcion_evento }},
		 el día <span class="underlined">{{ $fecha_evento }}</span>.
	</p>
	
@endsection

@section('footer')
	<p class="paragraph">
		Por tal motivo pedimos el apoyo para dicho estudiante atleta que representará
		nuestra casa de estudios, concediéndole permiso sin que esto menoscabe sus
		procesos académicos. Constancia que se expide de parte interesada, 
		en Santa Ana de Coro a los 
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