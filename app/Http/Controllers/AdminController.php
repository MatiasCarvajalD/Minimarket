<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\DetalleCompra;
use App\Models\Ajuste;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->rol !== 'admin') {
                abort(403, 'Acceso denegado.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalUsuarios = User::count();
        $totalProductos = Producto::count();
        $stockCritico = Producto::whereColumn('stock_actual', '<=', 'stock_critico')->count();
        $pedidosPendientes = Venta::where('entrega_completada', false)->count();
    
        $ultimosPedidos = Venta::orderBy('fecha', 'desc')->take(5)->get();
        $ultimosAjustes = Ajuste::orderBy('fecha', 'desc')->take(5)->get();
    
        // Ventas y compras del mes anterior
        $mesAnterior = Carbon::now()->subMonth();
    
        $ventasMesAnterior = Venta::whereMonth('fecha', $mesAnterior->month)
            ->whereYear('fecha', $mesAnterior->year)
            ->count();
    
        $comprasMesAnterior = Compra::whereMonth('fecha', $mesAnterior->month)
            ->whereYear('fecha', $mesAnterior->year)
            ->count();
    
        // Productos con stock crítico
        $productosCriticos = Producto::whereColumn('stock_actual', '<=', 'stock_critico')->get();
    
        // Datos para el gráfico de ventas
        $ventasMensuales = Venta::selectRaw('MONTH(fecha) as mes, SUM(detalle_venta.cantidad * detalle_venta.valor_unidad) as total')
            ->join('detalle_venta', 'ventas.id_venta', '=', 'detalle_venta.id_venta')
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();
    
        // Datos para el gráfico de compras
        $comprasMensuales = Compra::selectRaw('MONTH(fecha) as mes, SUM(detalle_compra.cantidad * detalle_compra.valor_unitario) as total')
            ->join('detalle_compra', 'compra.cod_compra', '=', 'detalle_compra.cod_compra')
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();
    
        $ventasLabels = $ventasMensuales->pluck('mes');
        $ventasData = $ventasMensuales->pluck('total');
        $comprasData = $comprasMensuales->pluck('total'); // Asignar datos de compras
    
        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalProductos', 'stockCritico', 'pedidosPendientes',
            'ultimosPedidos', 'ultimosAjustes', 'productosCriticos',
            'ventasLabels', 'ventasData', 'comprasData', 'ventasMesAnterior', 'comprasMesAnterior'
        ));
    }
    

    // Gestión de Usuarios
    public function usuarios()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function editarUsuario($rut_usuario)
    {
        $usuario = User::where('rut_usuario', $rut_usuario)->firstOrFail();
        return view('admin.usuarios.edit', compact('usuario'));
    }


    public function actualizarUsuario(Request $request, $rut_usuario)
    {
        // Buscar al usuario por RUT
        $usuario = User::where('rut_usuario', $rut_usuario)->firstOrFail();
    
        // Verificar si el usuario tiene rol "invitado"
        if ($usuario->rol === 'invitado') {
            return redirect()->route('admin.usuarios.index')->withErrors('No puedes editar a un usuario con rol "invitado".');
        }
    
        // Evitar que el admin cambie su propio rol a "usuario"
        if (auth()->user()->rut_usuario == $rut_usuario && $request->rol !== 'admin') {
            return redirect()->route('admin.usuarios.index')->withErrors('No puedes cambiar tu propio rol.');
        }
    
        // Validar los datos
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->rut_usuario . ',rut_usuario',
            'rol' => 'required|string|in:usuario,admin',
        ]);
    
        // Actualizar los datos del usuario
        $usuario->update($validated);
    
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }
    
    // Gestión de Productos
    public function productos()
    {
        $productos = Producto::all();
        return view('admin.productos.index', compact('productos'));
    }

    // Gestión de Ventas
    public function pedidos()
    {
        $ventas = Venta::with('detalles')->get();
        return view('admin.ventas.index', compact('ventas'));
    }
    public function usuariosDestroy($rut_usuario)
    {
        // Evitar que el usuario se elimine a sí mismo
        if (auth()->user()->rut_usuario == $rut_usuario) {
            return redirect()->route('admin.usuarios.index')->withErrors('No puedes eliminar tu propio usuario.');
        }
    
        // Buscar y eliminar el usuario
        $usuario = User::where('rut_usuario', $rut_usuario)->first();
    
        if ($usuario) {
            $usuario->delete();
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        }
    
        return redirect()->route('admin.usuarios.index')->withErrors('El usuario no existe.');
    }
    // Mostrar el formulario para crear un usuario
    public function crearUsuario()
    {
        return view('admin.usuarios.create');
    }

    // Procesar la creación de un nuevo usuario
    public function guardarUsuario(Request $request)
    {
        // Validar los datos ingresados
        $validated = $request->validate([
            'rut_usuario' => 'required|unique:usuarios,rut_usuario|max:12',
            'nombre_usuario' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'nullable|string|max:15',
            'rol' => 'required|string|in:usuario,admin,invitado',
        ]);

        // Crear el usuario
        User::create([
            'rut_usuario' => $validated['rut_usuario'],
            'nombre_usuario' => $validated['nombre_usuario'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'telefono' => $validated['telefono'] ?? null,
            'rol' => $validated['rol'],
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }
    public function indexProveedores()
    {
        $proveedores = Proveedor::all(); // Obtener proveedores
        return view('admin.proveedores.index', compact('proveedores'));
    }
    
    public function crearProveedor()
    {
        return view('admin.proveedores.crear'); // Vista del formulario
    }
    
    public function guardarProveedor(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'rut_proveedor' => 'required|unique:proveedor,rut_proveedor|max:15',
            'nom_proveedor' => 'required|max:255',
            'telefono_proveedor' => 'nullable|numeric',
            'direccion_proveedor' => 'nullable|max:255',
            'correo_proveedor' => 'nullable|email|max:255',
        ]);
    
        // Crear un nuevo proveedor
        Proveedor::create([
            'rut_proveedor' => $request->rut_proveedor,
            'nom_proveedor' => $request->nom_proveedor,
            'telefono_proveedor' => $request->telefono_proveedor,
            'direccion_proveedor' => $request->direccion_proveedor,
            'correo_proveedor' => $request->correo_proveedor,
        ]);
    
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor creado correctamente.');
    }
    
    
    public function crearCompra()
    {
        $proveedores = Proveedor::all(); // Lista de proveedores
        $productos = Producto::all(); // Lista de productos
    
        return view('admin.compras.crear', compact('proveedores', 'productos'));
    }
    

    public function guardarCompra(Request $request)
    {
        DB::transaction(function () use ($request) {
            // Guardar la compra
            $compra = Compra::create([
                'rut_proveedor' => $request->rut_proveedor,
                'fecha' => now(),
                'detalle_general' => $request->detalle_general,
            ]);
    
            // Guardar los detalles de la compra y actualizar stock
            foreach ($request->productos as $producto) {
                DetalleCompra::create([
                    'cod_compra' => $compra->cod_compra,
                    'cod_producto' => $producto['cod_producto'],
                    'cantidad' => $producto['cantidad'],
                    'valor_unitario' => $producto['precio_unitario'],
                    'subtotal' => $producto['cantidad'] * $producto['precio_unitario'],
                    'descripcion' => $producto['descripcion'] ?? null,
                ]);
    
                // Actualizar el stock del producto
                $productoModel = Producto::find($producto['cod_producto']);
                if ($productoModel) {
                    $productoModel->increment('stock_actual', $producto['cantidad']);
                }
            }
        });
    
        return redirect()->route('admin.compras.index')->with('success', 'Compra registrada y stock actualizado correctamente.');
    }
    
    public function showCompra($cod_compra)
    {
        $compra = Compra::with(['detalles.producto', 'proveedor'])->findOrFail($cod_compra);
        return view('admin.compras.show', compact('compra'));
    }
    
    

    public function indexCompras()
    {
        $compras = Compra::all(); // Obtener todas las compras
        return view('admin.compras.index', compact('compras'));
    }

    


    
    

}
