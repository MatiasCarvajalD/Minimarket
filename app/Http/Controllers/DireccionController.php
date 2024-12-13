<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;


class DireccionController extends Controller
{
    /**
     * Muestra una lista de direcciones del usuario autenticado.
     */
    public function index()
    {
        $usuario = auth()->user();
        $direcciones = Direccion::where('rut_usuario', $usuario->rut_usuario)->get();

        return view('direcciones.index', compact('direcciones'));
    }

    /**
     * Muestra el formulario para crear una nueva dirección.
     */
    public function create()
    {
        return view('direcciones.create');
    }

    /**
     * Almacena una nueva dirección en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'region' => 'required|string|max:255',
        ]);

        Direccion::create([
            'rut_usuario' => auth()->user()->rut_usuario,
            'calle' => $request->calle,
            'ciudad' => $request->ciudad,
            'region' => $request->region,
        ]);

        return redirect()->route('user.profile')->with('success', 'Dirección creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una dirección existente.
     */
    public function edit($id)
    {
        $direccion = Direccion::where('id', $id)->where('rut_usuario', auth()->user()->rut_usuario)->firstOrFail();

        return view('direcciones.edit', compact('direccion'));
    }

    /**
     * Actualiza una dirección en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'calle' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'region' => 'required|string|max:255',
        ]);

        $direccion = Direccion::where('id', $id)
            ->where('rut_usuario', auth()->user()->rut_usuario)
            ->firstOrFail();

        $direccion->update($validated);

        return redirect()->route('user.profile')->with('success', 'Dirección actualizada correctamente.');
    }

    /**
     * Elimina una dirección de la base de datos.
     */
    public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id);
    
        // Verifica que la dirección pertenezca al usuario autenticado
        if ($direccion->rut_usuario !== auth()->user()->rut_usuario) {
            abort(403, 'No tienes permiso para eliminar esta dirección.');
        }
    
        $direccion->delete();
    
        return redirect()->route('user.profile')->with('success', 'Dirección eliminada correctamente.');
    }
    
}
