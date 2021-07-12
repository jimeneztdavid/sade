@extends('layouts.dashboard.layout')

@section('title')
Usuarios
@endsection


@section('content')
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Lista de Usuarios</h4>
    </div>
    <div class="col-md-7 align-self-center text-right" hidden>
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-danger d-none d-lg-block m-l-15" data-toggle="modal" data-target=".nuevo-usuario"><i class="fa fa-plus-circle"></i> Nuevo Usuario</button>
        </div>
    </div>
</div>


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Usuarios</h4>
                <h6 class="card-subtitle">Aquí puede gestionar los usuario(s) existentes en el sistema</h6>
                <div class="table-responsive m-t-40">
                    <table id="usuario-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Correo Electrónico</th>
                                <th>Rango</th>
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

  <!-- Modal Nuevo usuario -->
  <div class="modal fade nuevo-usuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Registrar usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-nuevo-usuario" class="row" autocomplete="off">
                      <div class="form-group col-md-6">
                          <label for="nombre" class="control-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Pedro">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="apellido" class="control-label">Apellido:</label>
                          <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Perez">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="cedula" class="control-label">Cédula:</label>
                          <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ej: 00000000">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="email" class="control-label">Correo Electrónico:</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Ej: ex@ejemplo.com">
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
                      <div class="form-group col-md-12">
                          <label>Rango:</label>
                          <select class="form-control" name="role_id" style="text-transform: capitalize">
                             @foreach ($roles as $rol)
                              <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                          </select>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-nuevo-usuario" class="btn btn-danger waves-effect waves-light">Registrar usuario</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Actualizar Usuario -->
  <div class="modal fade actualizar-usuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Actualizar usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-actualizar-usuario" class="row" autocomplete="off">
                      <div class="form-group col-md-6">
                          <label for="nombre" class="control-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Pedro">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="apellido" class="control-label">Apellido:</label>
                          <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Perez">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="cedula" class="control-label">Cédula:</label>
                          <input type="text" maxlength="12" minlength="8" class="form-control" id="cedula" name="cedula" placeholder="Ej: 00000000">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="email" class="control-label">Correo Electrónico:</label>
                          <input type="email" maxlength="60" class="form-control" id="email" name="email" placeholder="Ej: ex@ejemplo.com">
                      </div>
                      <div class="form-group col-md-6">
                          <label for="clave" class="control-label">Clave:</label>
                          <input type="password" data-toggle="tooltip" data-placement="bottom" title="Si no desea cambiar la contraseña puede dejarla en blanco." class="form-control" id="clave" name="clave" autocomplete="off">
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
                      <div class="form-group col-md-12">
                          <label>Rango:</label>
                          <select class="form-control" name="role_id" style="text-transform: capitalize">
                             @foreach ($roles as $rol)
                              <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <input type="hidden" name="id">
                      <input value="PUT" name="_method" hidden>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-actualizar-usuario" class="btn btn-danger waves-effect waves-light">Actualizar usuario</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Eliminar Usuario -->
  <div class="modal fade eliminar-usuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Eliminar usuario</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar este registro?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger waves-effect waves-light" data-id="" data-action="eliminar">Eliminar usuario</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

<!-- Modal Activar/Desactivar Usuario -->
<div class="modal fade act-des-usuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Activar/Desactivar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <p>¿Está seguro de <span id="new-status"></span> este usuario?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" data-id="" data-new-status="" data-action="activar-desactivar">Continuar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection


@section('scripts')
   <script src="{{ asset('js/usuario/scripts.js') }}"></script> 
@endsection