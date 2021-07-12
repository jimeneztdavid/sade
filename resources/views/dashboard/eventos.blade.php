@extends('layouts.dashboard.layout')

@section('title')
Eventos
@endsection

@section('styles')
<link href="{{ asset('dist/css/datepicker.css') }}" rel="stylesheet"> 
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
                <h4 class="card-title">Eventos</h4>
                <h6 class="card-subtitle">Aquí puede gestionar todos los Eventos</h6>
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

  <!-- Modal Ver evento -->
  <div class="modal fade ver-evento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Ver evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-ver-evento">
                      <div class="form-group">
                          <label class="control-label">Fecha del Evento:</label>
                          <input type="text" class="form-control datepicker" name="fecha" placeholder="" disabled>
                      </div>
                      <div class="form-group">
                          <label>Disciplina:</label>
                          <select class="form-control" name="disciplina_id" disabled>
                             @foreach ($disciplinas as $disciplina)
                              <option value="{{ $disciplina->id }}"> {{ $disciplina->nombre }} </option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Categoria:</label>
                          <select class="form-control" name="categoria_id" disabled>
                             @foreach ($categorias as $categoria)
                              <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                             @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Descripción:</label>
                          <textarea name="descripcion" class="form-control" placeholder="..." disabled></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Nuevo evento -->
  <div class="modal fade nuevo-evento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Registrar evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-nuevo-evento">
                      <div class="form-group">
                          <label class="control-label">Fecha del Evento:</label>
                          <input type="text" class="form-control datepicker" name="fecha" placeholder="" readonly>
                      </div>
                      <div class="form-group">
                          <label>Disciplina:</label>
                          <select class="form-control" name="disciplina_id">
                             @foreach ($disciplinas as $disciplina)
                              <option value="{{ $disciplina->id }}"> {{ $disciplina->nombre }} </option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Categoria:</label>
                          <select class="form-control" name="categoria_id">
                             @foreach ($categorias as $categoria)
                              <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                             @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Descripción:</label>
                          <textarea name="descripcion" class="form-control" placeholder="..."></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-nuevo-evento" class="btn btn-danger waves-effect waves-light">Registrar evento</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Actualizar Evento -->
  <div class="modal fade actualizar-evento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel" readonly>Actualizar evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-actualizar-evento">
                      <div class="form-group">
                          <label class="control-label">Fecha del Evento:</label>
                          <input type="text" class="form-control datepicker" name="fecha" placeholder="">
                          <input type="hidden" name="id">
                          <input type="hidden" name="_method" value="PUT">
                      </div>
                      <div class="form-group">
                          <label>Disciplina:</label>
                          <select class="form-control" name="disciplina_id">
                             @foreach ($disciplinas as $disciplina)
                              <option value="{{ $disciplina->id }}"> {{ $disciplina->nombre }} </option>
                             @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Categoria:</label>
                          <select class="form-control" name="categoria_id">
                             @foreach ($categorias as $categoria)
                              <option value="{{ $categoria->id }}"> {{ $categoria->nombre }} </option>
                             @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Descripción:</label>
                          <textarea name="descripcion" class="form-control" placeholder="..."></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" form="form-actualizar-evento" class="btn btn-danger waves-effect waves-light">Actualizar evento</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>

  <!-- Modal Eliminar Evento -->
  <div class="modal fade eliminar-evento" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Eliminar evento</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <p>¿Está seguro de eliminar este registro?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-danger waves-effect waves-light" data-id="" data-action="eliminar">Eliminar evento</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
@endsection

@section('scripts')
   <script src="{{ asset('dist/js/datepicker.js') }}"></script>
   <script src="{{ asset('dist/js/datepicker.es-ES.js') }}"></script>
   <script src="{{ asset('js/eventos/scripts.js') }}"></script> 
@endsection