@extends('layouts.dashboard.layout')

@section('title')
Constancia de Acreditación
@endsection

@section('content')

 <div class="row page-titles">
    <div class="col-md-12 align-self-center">
        <h4 class="text-themecolor">Constancias de acreditación</h4>
    </div>
   
</div>


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atletas</h4>
                <h6 class="card-subtitle">Aquí puede generar constancias de acreditación</h6>
                <div class="table-responsive m-t-40">
                    <table id="atleta-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
   </div>
@endsection

@section('scripts')
   <script src="{{ asset('js/constancias/acreditacion.js') }}"></script> 
@endsection