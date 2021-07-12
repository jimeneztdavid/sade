@extends('layouts.dashboard.layout')

@section('styles')
<link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
@endsection

@section('title')
Agregar Atletas
@endsection

@section('content')

<div class="row page-titles">
   <div class="col-md-12 align-self-center">
       <h4 class="text-themecolor">Gestión de eventos</h4>
   </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atletas a participar en el evento</h4>
                <h6 class="card-subtitle">Aquí puede gestionar todos los atletas que participarán en el evento.</h6>
                <div class="table-responsive m-t-40" id_evento="{{ $id_evento }}">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
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

  <!-- Modal Nuevo atleta -->
  <div class="modal fade nuevo-atleta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Registrar Atletas</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <form id="form-nuevo-atleta">
                  <input type="hidden" name="eventos_id" value="{{ $id_evento }}">
                  <select name="atletas_id[]" id="atletas_id" multiple data-live-search="true" class="selectpicker">
                  </select>
                </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-nuevo-atleta" class="btn btn-danger waves-effect waves-light">Registrar Atleta</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Eliminar Atleta -->
  <div class="modal fade eliminar-atleta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Eliminar Atleta</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar este registro?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger waves-effect waves-light" data-id="" data-action="eliminar">Eliminar atleta</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

</div>
@endsection

@section('scripts')
   <script src="{{ asset('js/agregar_atletas/scripts.js') }}"></script> 
   <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script> 
@endsection