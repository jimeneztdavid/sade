<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Atleta;
use App\Bitacora;
use App\Disciplina;
use Illuminate\Support\Facades\Auth;

class AtletaController extends Controller
{
    /**
     * el modulo para la bitacora
     * 
     * @var
     */

    private $module = 'Atletas';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin', ['except' => [
            'index'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Atleta::all();
    }

    public function obtenerAtletasPorDisciplina(Request $request)
    {
        $disciplina = Disciplina::find($request->id);

        if (!$disciplina) {
            return response()->json(['error' => 'No existe la disciplina seleccionada'], 404);
        }


        $atletas = Atleta::where('disciplina_id', $request->id)->get();

        if (!$atletas) {
            return response()->json(['error' => 'Esta disciplina no tiene atletas registrados'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Búsqueda',
            'descripcion' => "El usuario ha realizado una busqueda de atleta por disciplina: $disciplina->nombre",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return $atletas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:40',
            'apellido'          => 'required|max:40',
            'cedula'            => 'required|unique:atletas|digits_between:7,9',
            'pasaporte'         => 'nullable|digits:9',
            'nacionalidad'      => ['required', Rule::in(['V', 'E'])],
            'correo'            => 'required|unique:atletas',
            'twitter'           => 'max:20',
            'municipio'         => 'required',
            'parroquia'         => 'required',
            'telefono_movil'    => 'required|unique:atletas|digits:11',
            'telefono_casa'     => 'required|digits:11',
            'pnf_id'            => 'required',
            'lapso_inscripcion' => 'required',
            'disciplina_id'     => 'required',
            'fecha_nacimiento'  => 'required|date',
            'lugar_nacimiento'  => 'required',
            'tipo_sangre'       => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'estatura'          => 'required',
            'talla_zapato'      => 'required|numeric|min:30|max:48',
            'talla_franela'     => 'required',
            'talla_short'       => 'required|numeric|min:25|max:55',
            'peso'              => 'required',
            'direccion'         => 'required',
            'observaciones'     => 'max:255',
            'foto_carnet'       => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $atleta = Atleta::create($validator->valid());
        
        if ($request->file('foto_carnet')) {
            $path = $request->file('foto_carnet')->store('fotos_carnet');
            $atleta->foto_carnet = '/uploads/' . $path;
        }
        
        $atleta->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Registro',
            'descripcion' => "El usuario ha registrado al atleta $atleta->nombre $atleta->apellido",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Registro completado']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $atleta = Atleta::find($id);

        if (!$atleta) {
            return response()->json(['res' => 'No se ha encontrado el atleta seleccionado'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Búsqueda',
            'descripcion' => "El usuario ha solicitado la información del atleta: $atleta->nombre $atleta->apellido",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return $atleta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $atleta = Atleta::find($id);

        if (!$atleta) {
            return response()->json(['res' => 'No se ha encontrado el atleta seleccionado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre'            => 'required|max:40',
            'apellido'          => 'required|max:40',
            'cedula'            => '|digits_between:7,9|unique:atletas,cedula,' .$id,
            'pasaporte'         => 'digits:9',
            'nacionalidad'      => ['required', Rule::in(['V', 'E'])],
            'correo'            => 'unique:atletas,correo,'. $id,
            'twitter'           => 'max:20',
            'municipio'         => 'required',
            'parroquia'         => 'required',
            'telefono_movil'    => 'digits:11|unique:atletas,telefono_movil,' .$id,
            'telefono_casa'     => 'required|digits:11',
            'pnf_id'            => 'required',
            'lapso_inscripcion' => 'required',
            'disciplina_id'     => 'required',
            'fecha_nacimiento'  => 'required|date',
            'lugar_nacimiento'  => 'required',
            'tipo_sangre'       => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'estatura'          => 'required',
            'talla_zapato'      => 'required|numeric|min:30|max:48',
            'talla_franela'     => 'required',
            'talla_short'       => 'required|numeric|min:25|max:55',
            'peso'              => 'required',
            'direccion'         => 'required',
            'observaciones'     => 'max:255',
            'foto_carnet'       => 'image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $atleta->nombre            = $request->nombre;
        $atleta->apellido          = $request->apellido;
        $atleta->cedula            = $request->cedula ?? $atleta->cedula;
        $atleta->pasaporte         = $request->pasaporte ?? $atleta->pasaporte;
        $atleta->nacionalidad      = $request->nacionalidad;
        $atleta->correo            = $request->correo ?? $atleta->correo;
        $atleta->twitter           = $request->twitter;
        $atleta->municipio         = $request->municipio;
        $atleta->parroquia         = $request->parroquia;
        $atleta->telefono_movil    = $request->telefono_movil ?? $atleta->telefono_movil;
        $atleta->telefono_casa     = $request->telefono_casa;
        $atleta->pnf_id            = $request->pnf_id;
        $atleta->lapso_inscripcion = $request->lapso_inscripcion;
        $atleta->disciplina_id     = $request->disciplina_id;
        $atleta->fecha_nacimiento  = $request->fecha_nacimiento;
        $atleta->lugar_nacimiento  = $request->lugar_nacimiento;
        $atleta->tipo_sangre       = $request->tipo_sangre;
        $atleta->estatura          = $request->estatura;
        $atleta->talla_zapato      = $request->talla_zapato;
        $atleta->talla_franela     = $request->talla_franela;
        $atleta->talla_short       = $request->talla_short;
        $atleta->peso              = $request->peso;
        $atleta->direccion         = $request->direccion;
        $atleta->observaciones     = $request->observaciones ?? $atleta->observaciones;

        if ($request->foto_carnet) {
            unlink(public_path() . $atleta->foto_carnet);
            $path = $request->file('foto_carnet')->store('fotos_carnet');
            $atleta->foto_carnet = '/uploads/' . $path;
        }
        $atleta->save();

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Actualización',
            'descripcion' => "El usuario ha actualizado la información del atleta $atleta->nombre $atleta->apellido",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        return response()->json(['res' => 'Actualización completada']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $atleta = Atleta::find($id);

        if (!$atleta) {
            return response()->json(['res' => 'No se ha encontrado el atleta seleccionado'], 404);
        }

        Bitacora::create([
            'user_id' => Auth::user()->id,
            'accion' => 'Eliminación',
            'descripcion' => "El usuario ha eliminado al atleta $atleta->nombre $atleta->apellido",
            'modulo' => $this->module,
            'direccion_ip' => $request->ip()
        ]);

        $atleta->delete();

        return response()->json(['res' => 'Se ha eliminado al atleta']);
    }

}
