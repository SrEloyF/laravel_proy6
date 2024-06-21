<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Orden;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index()
    {
        $n_user = User::where('tipo_usuario', 'user')->get()->count();
        $n_productos = Producto::all()->count();
        $n_ordenes = Orden::all()->count();
        $n_envios = Orden::where('estado', 'Entregado')->get()->count();
        return view('admin.index', compact('n_user', 'n_productos', 'n_ordenes', 'n_envios'));
    }
    public function pdf()
    {
        $id_usuario = Auth::user()->id;
        $carrito_items = Carrito::where('id_usuario', $id_usuario)->with('producto')->get();
        $total = 0;

        foreach ($carrito_items as $item) {
            $total += $item->producto->precio * $item->cantidad;
        }

        $pdf = PDF::loadView('home.pdf', [
            'carrito' => $carrito_items,
            'total' => $total,
            'user' => Auth::user()
        ]);

        return $pdf->stream();
    }




    public function home()
    {
        $producto = Producto::all();
        $categorias = Categoria::all(); 

        if (Auth::id()) {
            $usuario = Auth::user();
            $id_usuario = $usuario->id;
            $count = Carrito::where('id_usuario', $id_usuario)->count();
        } else {
            $count = '';
        }

        return view('home.index', compact('producto', 'count', 'categorias'));
    }

    public function getProductosByCategoria($id_categoria)
    {
        if ($id_categoria == 0) {
            $productos = Producto::all();
        } else {
            $productos = Producto::where('id_categoria', $id_categoria)->get();
        }

        return response()->json($productos);
    }


    public function login_home()
    {
        $producto = Producto::all();
        $categorias = Categoria::all(); 
        if(Auth::id()){
            $usuario = Auth::user();
            $id_usuario = $usuario->id;
            $count = Carrito::where('id_usuario', $id_usuario)->count();
        }
        else{
            $count='';
        }
        return view('home.index', compact('producto', 'count', 'categorias'));
    }

    public function detalles_producto($id)
    {
        $data = Producto::with('categoria')->find($id);
        if(Auth::id()){
            $usuario = Auth::user();
            $id_usuario = $usuario->id;
            $count = Carrito::where('id_usuario', $id_usuario)->count();
        }
        else{
            $count = '';
        }
        return view('home.detalles_producto', compact('data', 'count'));
    }


    public function anadir_carrito(Request $request, $id)
    {
        $cantidad = $request->input('cantidad');
        $user = Auth::user();
        $id_user = $user->id;
        $data = new Carrito;
        $data->id_usuario = $id_user;
        $data->id_producto = $id;
        $data->cantidad = $cantidad;

        $data->save();
        toastr()->closeButton()->success('Producto agregado exitosamente');
        return redirect()->back();
    }


    public function mi_carrito()
    {
        if(Auth::id()){
            $usuario = Auth::user();
            $id_usuario = $usuario->id;
            $count = Carrito::where('id_usuario', $id_usuario)->count();

            $carrito = Carrito::where('id_usuario', $id_usuario)->get();
        }
        return view('home.mi_carrito', compact('count', 'carrito'));
    }

    public function confirmar_orden(Request $request)
    {
        $id_usuario = Auth::user()->id;
        $carrito_items = Carrito::where('id_usuario', $id_usuario)->get();

        if ($carrito_items->isEmpty()) {
            return redirect()->back()->withErrors('El carrito está vacío.');
        }

        foreach ($carrito_items as $item) {
            $orden = new Orden;
            $orden->id_usuario = $id_usuario;
            $orden->id_producto = $item->id_producto;
            $orden->cantidad = $item->cantidad;
            $orden->estado = 'Pendiente'; 

            $orden->save();
        }
        Carrito::where('id_usuario', $id_usuario)->delete();

        toastr()->closeButton()->success('Orden generada exitosamente');
        return redirect()->back();
    }


    public function actualizar_cantidad(Request $request, $id)
    {
        $item = Carrito::find($id);
        if ($item) {
            $item->cantidad = $request->input('cantidad');
            $item->save();
        }
        return redirect()->back();
    }




    public function eliminar_prod_del_carrito($id){
        $item = Carrito::find($id);
        if($item){
            $item->delete();
        }
        toastr()->closeButton()->success('Producto eliminado exitosamente');
        return redirect()->back();
    }



    public function mis_ordenes()
    {
        $usuario = Auth::user()->id;
        $count = Carrito::where('id_usuario', $usuario)->count();
        $orden = Orden::where('id_usuario', $usuario)
        ->orderByRaw("FIELD(estado, 'En proceso', 'Enviado', 'Entregado')")
        ->get();
        return view('home.orden', compact('count', 'orden'));
    }

}
