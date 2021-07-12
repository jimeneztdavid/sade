@extends('layouts.dashboard.layout')

@section('title')
Constancia de Participación
@endsection

@section('content')

 <div class="row page-titles">
    <div class="col-md-12 align-self-center">
        <h4 class="text-themecolor">Constancias de participación</h4>
    </div>
   
</div>


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Eventos</h4>
                <h6 class="card-subtitle">Aquí puede generar constancias de participación a eventos</h6>
                <div class="table-responsive m-t-40">
                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Disciplina</th>
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

  <div class="modal fade seleccionar-atleta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Generar Constancia</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <form id="form-seleccionar-atleta">
                  <select class="form-control" name="atletas_id"><option disabled selected>Cargando...</option>
                  </select>
                </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger waves-effect waves-light btn-print-file">Seleccionar Atleta</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
@endsection

@section('scripts')
   <script src="{{ asset('js/constancias/participacion.js') }}"></script> 
@endsection