<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{

    /** ********************************** INDEX ********************************************************
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Consulta tomando 5 valores
        $datos['empleados'] = Empleado::paginate(1);
        return view('empleado.index', $datos);
    }



    /** ********************************** CREATE ********************************************************
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }



    /** ********************************** STORE (INSERT)***************************************************
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validaciones: 
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Apellido1' => 'required|string|max:100',
            'Apellido2' => 'required|string|max:100',
            'Email' => 'required|email',
            'Telefono' => 'required|max:16',
            'Foto' => 'required|max:10000|mimes:jpeg,png,jpg'
        ];

        // Mensajes: 
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);


        // Recoger todos los datos del formulario: 
        //$datosEmpleado=request()->all();

        // Recoger datos del formulario EXCEPTO EL TOKEN: 
        $datosEmpleado = request()->except('_token');

        // Guardar la foto:
        if ($request->hasFile('Foto')) {
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        // Insertar en la BBDD: 
        Empleado::insert($datosEmpleado);

        // Imprimir json para las comprobaciones:
        //return response()->json($datosEmpleado);

        // Redirigir y mandar mensaje: 
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito!!');
    }



    /**  Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }




    /** ********************************** EDIT ********************************************************
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Recuperar la información a partir del id: 
        $empleado = Empleado::findOrFail($id);
        // Retornamos la vista con la información del empleado: 
        return view('empleado.edit', compact('empleado'));
    }



    /** ********************************** UPDATE ********************************************************
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validaciones: 
        $campos = [
            'Nombre' => 'required|string|max:100',
            'Apellido1' => 'required|string|max:100',
            'Apellido2' => 'required|string|max:100',
            'Email' => 'required|email',
            'Telefono' => 'required|max:16'
        ];

        // Mensajes: 
        $mensaje = [
            'required' => 'El :attribute es requerido'
        ];

        // Si se cambia la foto: 
        if ($request->hasFile('Foto')) {

            $campos = ['Foto' => 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['Foto.required' => 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        // Recuperamos todos los datos del formulario excepto el _token y el _method:
        $datosEmpleado = request()->except('_token', '_method');

        // Guardar la foto:
        if ($request->hasFile('Foto')) {
            // Recuperar la información: 
            $empleado = Empleado::findOrFail($id);
            // Borrar la Foto antigua: 
            Storage::delete('public/' . $empleado->Foto);
            // Guardar la nueva Foto: 
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }

        // Ejecutar el update: 
        Empleado::where('id', '=', $id)->update($datosEmpleado);
        // Recuperar la información a partir del id: 
        $empleado = Empleado::findOrFail($id);
        // Retornamos la vista con la información del empleado: 
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Empleado modificado!!');
    }



    /** ********************************** DESTROY (DELETE) *****************************************************
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Recuperar datos del empleado: 
        $empleado = Empleado::findOrFail($id);

        // Comprobar si se borra la Foto: 
        if (Storage::delete('public/' . $empleado->Foto)) {
            // Borrar empleado
            Empleado::destroy($id);
        }

        // Redirigir
        return redirect('empleado')->with('mensaje', 'Empleado borrado!!');
    }
}
