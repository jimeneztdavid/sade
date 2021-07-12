@extends('layouts.dashboard.layout')

@section('title')
Categorías
@endsection

@section('content')
 <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Lista de Categorías</h4>
    </div>
    <div class="col-md-7 align-self-center text-right" hidden>
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-danger d-none d-lg-block m-l-15" data-toggle="modal" data-target=".nueva-disciplina"><i class="fa fa-plus-circle"></i> Nueva Categoría</button>
        </div>
    </div>
</div>


 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categorías</h4>
                <h6 class="card-subtitle">Aquí puede gestionar la(s) Categoría(s) existentes en el sistema</h6>
                <div class="table-responsive m-t-40">
                    <table id="disciplina-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
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

  <!-- Modal Nueva categoria -->
  <div class="modal fade nueva-categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Registrar Categoría</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-nueva-categoria">
                      <div class="form-group">
                          <label for="nombre" class="control-label">Nombre de la Categoría:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Nacional">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-nueva-categoria" class="btn btn-danger waves-effect waves-light">Registrar categoria</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Actualizar Categoría -->
  <div class="modal fade actualizar-categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Actualizar Categoría</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-actualizar-categoria">
                      <div class="form-group">
                          <label for="nombre" class="control-label">Nombre de la Categoría:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Instrumentación">
                          <input type="hidden" name="id">
                          <input type="hidden" name="_method" value="PUT">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-actualizar-categoria" class="btn btn-danger waves-effect waves-light">Actualizar categoria</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Eliminar Categoría -->
  <div class="modal fade eliminar-categoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Eliminar Categoría</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar este registro?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger waves-effect waves-light" data-id="" data-action="eliminar">Eliminar categoria</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
@endsection


@section('scripts')
   <script src="{{ asset('js/categoria/scripts.js') }}"></script> 
@endsection