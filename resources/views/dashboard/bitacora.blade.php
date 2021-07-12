@extends('layouts.dashboard.layout')

@section('title')
Bitacora
@endsection

@section('content')
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Bitacoras</h4>
    </div>
    <div class="col-md-7 align-self-center text-right" hidden>
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-danger d-none d-lg-block m-l-15" data-toggle="modal" data-target=".nuevo-pnf"><i class="fa fa-plus-circle"></i> Nuevo PNF</button>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bitacora</h4>
                <h6 class="card-subtitle">Aquí puede ver los registros y cambios del sistema.</h6>
                <div class="table-responsive m-t-40">
                    <table id="bitacora" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Correo</th>
                                <th>Acción</th>
                                <th>Modulo</th>
                                <th>Fecha</th>
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

  <!-- Modal Ver Bitacora -->
  <div class="modal fade ver-bitacora" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Ver Bitacora</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-ver-registro" class="row" autocomplete="off" readonly>
                      <div class="form-group col-md-6">
                          <label for="accion" class="control-label">Acción:</label>
                          <input type="text" class="form-control" id="accion" name="accion" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="direccion_ip" class="control-label">Dirección IP:</label>
                          <input type="text" class="form-control" id="direccion_ip" name="direccion_ip" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="modulo" class="control-label">Modulo:</label>
                          <input type="text" class="form-control" id="modulo" name="modulo" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="fecha" class="control-label">Fecha:</label>
                          <input type="text" class="form-control" id="fecha" name="fecha" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="nombre" class="control-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="apellido" class="control-label">Apellido:</label>
                          <input type="text" class="form-control" id="apellido" name="apellido" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="cedula" class="control-label">Cedula:</label>
                          <input type="text" class="form-control" id="cedula" name="cedula" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="email" class="control-label">Email:</label>
                          <input type="text" class="form-control" id="email" name="email" disabled>
                      </div>
                      <div class="form-group col-md-12">
                          <label for="descripcion" class="control-label">Descripción:</label>
                          <textarea class="form-control" name="descripcion" id="descripcion" disabled></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
@endsection

@section('scripts')
   <script src="{{ asset('js/bitacora/scripts.js') }}"></script> 
@endsection