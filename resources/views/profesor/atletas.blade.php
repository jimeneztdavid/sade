@extends('layouts.dashboard.layout')

@section('title')
Atletas
@endsection

@section('styles')
<link href="{{ asset('dist/css/jquery.steps.css') }}" rel="stylesheet"> 
<link href="{{ asset('dist/css/datepicker.css') }}" rel="stylesheet"> 


@endsection


@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Lista de Atletas</h4>
    </div>
    <div class="col-md-7 align-self-center text-right" hidden>
        <div class="d-flex justify-content-end align-items-center">
            <button type="button" class="btn btn-danger d-none d-lg-block m-l-15" data-toggle="modal" data-target=".nuevo-atleta"><i class="fa fa-plus-circle"></i> Nuevo Atleta</button>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Atletas</h4>
                <h6 class="card-subtitle">Aquí puede gestionar los atleta(s) existentes en el sistema</h6>
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


  <!-- Modal Ver atleta -->
  <div class="modal fade ver-atleta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Ver atleta</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                  <form id="form-ver-atleta">
                      <div class="this-for-steps">
                          <h3>Principal</h3>
                          <section>
                            <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="nombre" class="control-label">Nombre:</label>
                                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Pedro" maxlength="40" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="apellido" class="control-label">Apellido:</label>
                                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ej: Perez" maxlength="40" readonly>
                              </div>
                              <div class="form-group col-md-2">
                                  <label for="nacionalidad" class="control-label">Nacionalidad:</label>
                                  <select id="nacionalidad" name="nacionalidad" class="form-control" disabled>
                                    <option>V</option>
                                    <option>E</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="cedula" class="control-label">Cédula:</label>
                                  <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ej: 12345678" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="pasaporte" class="control-label">Pasaporte:</label>
                                  <input type="text" class="form-control" id="pasaporte" name="pasaporte" placeholder="Ej: 12345678" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="correo" class="control-label">Correo Electrónico:</label>
                                  <input type="email" class="form-control" id="correo" name="correo" placeholder="Ej: ejemplo@dominio.com" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="telefono_movil" class="control-label">Teléfono movil:</label>
                                  <input type="tel" class="form-control" id="telefono_movil" name="telefono_movil" placeholder="Ej: 04146145252" maxlength="11" readonly>
                              </div>
                            </div>
                          </section>
                          <h3>Domicilio</h3>
                          <section>
                            <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="telefono_casa" class="control-label">Teléfono de Casa:</label>
                                  <input type="text" class="form-control" id="telefono_casa" name="telefono_casa" placeholder="Ej: 02681234567" maxlength="11" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="twitter" class="control-label">Twitter:</label>
                                  <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Ej: @usuario" readonly>
                              </div>
                              <div class="form-group col-md-12">
                                  <label for="direccion" class="control-label">Dirección:</label>
                                  <textarea class="form-control" name="direccion" id="direccion" placeholder="Ej: Calle Churuguara, entre ..." readonly></textarea>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="municipio" class="control-label">Municipio:</label>
                                  <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Ej: Miranda" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="parroquia" class="control-label">Parroquia:</label>
                                  <input type="text" class="form-control" id="parroquia" name="parroquia" placeholder="Ej: San Gabriel" readonly>
                              </div>
                            </div>
                          </section>
                          <h3>Academicos</h3>
                          <section>
                            <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="pnf_id" class="control-label">PNF:</label>
                                  <select id="pnf_id" name="pnf_id" class="form-control" disabled>
                                    @foreach ($pnfs as $pnf)
                                    <option value="{{ $pnf->id }}"> {{ $pnf->nombre }}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="lapso_inscripcion" class="control-label">Lapso de Inscripción:</label>
                                  <input type="text" class="form-control" id="lapso_inscripcion" name="lapso_inscripcion" placeholder="Ej: 2018-02" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="disciplina_id" class="control-label">Disciplina:</label>
                                  <select id="disciplina_id" name="disciplina_id" class="form-control" disabled>
                                    @foreach ($disciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}"> {{ $disciplina->nombre }}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="fecha_nacimiento" class="control-label">Fecha de Nacimiento:</label>
                                  <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Ej: 19/10/1997" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="lugar_nacimiento" class="control-label">Lugar de Nacimiento:</label>
                                  <input type="text" class="form-control" id="lugar_nacimiento" name="lugar_nacimiento" placeholder="Ej: Coro" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="tipo_sangre" class="control-label">Tipo de sangre:</label>
                                  <select id="tipo_sangre" name="tipo_sangre" class="form-control" disabled>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    <option>O+</option>
                                    <option>O-</option>
                                  </select>
                              </div>
                            </div>
                          </section>
                          <h3>Fisicos</h3>
                          <section>
                            <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="estatura" class="control-label">Estatura:</label>
                                  <input type="text" class="form-control" id="estatura" name="estatura" placeholder="Ej: 1.80m" maxlength="5" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="peso" class="control-label">Peso:</label>
                                  <input type="text" class="form-control" id="peso" name="peso" placeholder="Ej: 80k" maxlength="4" readonly>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="talla_zapato" class="control-label">Talla de Zapato:</label>
                                  <input type="number" class="form-control" id="talla_zapato" name="talla_zapato" placeholder="Ej: 40" maxlength="2" min="30" max="48" readonly>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="talla_franela" class="control-label">Talla de Franela:</label>
                                  <select class="form-control" name="talla_franela" disabled>
                                      <option>XS</option>
                                      <option>S</option>
                                      <option>M</option>
                                      <option>L</option>
                                      <option>XL</option>
                                      <option>XXL</option>
                                  </select>
                              </div>
                              <div class="form-group col-md-4">
                                  <label for="talla_short" class="control-label">Talla de Short:</label>
                                  <input type="number" class="form-control" id="talla_short" name="talla_short" placeholder="Ej: 40" maxlength="2" min="25" max="55" readonly>
                              </div>
                              <div class="form-group col-md-12">
                                  <label for="observaciones" class="control-label">Observaciones:</label>
                                  <textarea class="form-control" name="observaciones" id="observaciones" readonly></textarea>
                              </div>
                            </div>
                          </section>
                          <h3>Foto</h3>
                          <section>
                              <div class="form-group col-md-12">
                                  <img id="preview-ver-atleta" src="#" class="img-responsive"/>
                              </div>
                          </section>
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
@endsection

@section('scripts')
   <script src="{{ asset('dist/js/jquery.steps.min.js') }}"></script>
   <script src="{{ asset('js/atleta/scripts_profesor.js') }}"></script> 
@endsection