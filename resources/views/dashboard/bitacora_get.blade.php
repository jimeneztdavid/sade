@extends('layouts.dashboard.layout')

@section('title')
Bitacora
@endsection

@section('content')

    {{-- variables get --}}
    <p>
        {{ $bitacora }}
    </p>
@endsection