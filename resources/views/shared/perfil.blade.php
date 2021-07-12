@extends('layouts.dashboard.layout')

@section('title')
Perfil
@endsection

@section('styles')



@endsection


@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Perfil</h4>
    </div>
</div>

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar perfil</h4>
                <h6 class="card-subtitle">Aquí puede editar su perfil</h6>
                 <form id="form-actualizar-perfil" class="row" autocomplete="off">
                      <div class="form-group col-md-6">
                          <label for="nombre" class="control-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Pedro" value="{{ Auth::user()->nombre }}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="apellido" class="control-label">Apellido:</label>
                          <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Perez" value="{{ Auth::user()->apellido }}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="cedula" class="control-label">Cédula:</label>
                          <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ej: 00000000" value="{{ Auth::user()->cedula }}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="email" class="control-label">Correo Electrónico:</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Ej: ex@ejemplo.com" value="{{ Auth::user()->email }}">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="clave" class="control-label">Clave:</label>
                          <input type="password" class="form-control" id="clave" name="clave" autocomplete="off">
                          <div class="well well-sm password-matcher" style="display: none">
                              La contraseña debe contener:
                              <ul class="p-l-20 m-b-0 m-t-5">
                                <li id="req-1" class="req">Minimo 8 caracteres</li>
                                <li id="req-2" class="req">Maximo 15 caracteres</li>
                                <li id="req-3" class="req">Al menos una letra mayúscula </li>
                                <li id="req-4" class="req">Al menos una letra minúscula</li>
                                <li id="req-5" class="req">Al menos un dígito númerico</li>
                                <li id="req-6" class="req">No contenga espacios en blanco</li>
                                <li id="req-7" class="req">Al menos 1 caracter especial</li>
                              </ul>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="conf_clave" class="control-label">Confirme la clave:</label>
                          <input type="password" class="form-control" id="conf_clave" name="conf_clave">
                      </div>
                      <hr>

                      <div class="button-group col-md-6">
						    <button type="submit" form="form-actualizar-perfil" class="btn waves-effect waves-light btn-danger">Guardar</button>
					    </div>
                      
                  </form>
				</div>
            </div>
        </div>
     </div>
   </div>



	

@endsection

@section('scripts')
   <script src="{{ asset('js/perfil/scripts.js') }}"></script> 
@endsection