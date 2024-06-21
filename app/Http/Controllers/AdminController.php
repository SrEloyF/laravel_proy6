<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Orden;
use App\Models\Producto;
use Illuminate\Database\QueryException; 

class AdminController extends Controller
{
    public function view_categoria()
    {
        $data = Categoria::all();

        return view('admin.categoria', compact('data'));
    }

    public function agregar_categoria(Request $request)
    {
        $categoria = new Categoria;
        $categoria->nombre_categoria = $request->categoria;
        $categoria->save();

        toastr()->closeButton()->success('La categoria fue creada exitosamente');
        return redirect()->back();
    }

    
    public function eliminar_categoria($id)
    {
        try {
            Categoria::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Categoría eliminada exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar la categoría.');
        }
    }

    public function editar_categoria($id)
    {
        $data = Categoria::find($id);
        return view('admin.editar_categoria', compact('data'));
    }

    public function actualizar_categoria(Request $request ,$id)
    {
        $data = Categoria::find($id);
        $data->nombre_categoria = $request->categoria;
        $data->save();
        toastr()->closeButton()->success('La categoria fue actualizada exitosamente');
        return redirect('/view_categoria');
    }

    public function agregar_producto()
    {
        $categorias = Categoria::all();
        return view('admin.agregar_producto', compact('categorias'));
    }

    public function subir_producto(Request $request)
    {
        $data = new Producto;
        $data->titulo = $request->titulo;
        $data->descripcion = $request->descripcion;
        $data->precio = $request->precio;
        $data->stock = $request->stock;
        $data->id_categoria = $request->id_categoria; 

        $foto = $request->file('foto'); 
        if ($foto) {
            $foto_nombre = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move('productos', $foto_nombre);

            $data->foto = $foto_nombre;
        }

        $data->save();
        toastr()->closeButton()->success('El producto fue creado exitosamente');
        return redirect()->back();
    }


    public function view_producto()
    {
        $productos = Producto::with('categoria')->paginate(3);
        return view('admin.view_producto', compact('productos'));
    }

    public function eliminar_producto($id)
    {
        $data = Producto::find($id);

        $foto_r = public_path('productos/' . $data->foto);

        if(file_exists($foto_r)){
            unlink($foto_r);
        }

        $data->delete();
        toastr()->closeButton()->success('El producto fue eliminado exitosamente');
        return redirect()->back();
    }

    public function editar_producto($id)
    {
        $data = Producto::with('categoria')->find($id);
        $categorias = Categoria::all(); 
        return view('admin.editar_producto', compact('data', 'categorias'));
    }


    public function actualizar_producto(Request $request, $id)
    {
        $data = Producto::find($id);
        $data->titulo = $request->titulo;
        $data->descripcion = $request->descripcion;   
        $data->precio = $request->precio;
        $data->stock = $request->stock;
        $data->id_categoria = $request->id_categoria;

        $foto = $request->foto;
        if($foto){
            $nombre_foto = time() . "." . $foto->getClientOriginalExtension();
            $request->foto->move('productos', $nombre_foto);
            $data->foto = $nombre_foto; 
        }

        $data->save();
        toastr()->closeButton()->success('El producto fue editado exitosamente');
        return redirect('/view_producto');
    }

    public function buscar_producto(Request $request)
    {
        $buscar = $request->input('buscar');
        
        $productos = Producto::where('titulo', 'LIKE', '%' . $buscar . '%')
        ->orWhereHas('categoria', function($query) use ($buscar) {
            $query->where('nombre_categoria', 'LIKE', '%' . $buscar . '%');
        })
        ->paginate(3);

        return view('admin.view_producto', compact('productos'));
    }

//////////////
    public function buscar_orden(Request $request)
{
    $buscar = $request->input('buscar');

    $data = Orden::whereHas('user', function($query) use ($buscar) {
            $query->where('name', 'LIKE', '%' . $buscar . '%')
                ->orWhere('direccion', 'LIKE', '%' . $buscar . '%');
        })
        ->orWhereHas('producto', function($query) use ($buscar) {
            $query->where('titulo', 'LIKE', '%' . $buscar . '%');
        })
        ->orWhere('estado', 'LIKE', '%' . $buscar . '%')
        ->orderByRaw("FIELD(estado, 'Pendiente', 'Enviado', 'Entregado')")
        ->paginate(10);

    return view('admin.ordenes', compact('data'));
}

/////////////



    public function view_ordenes()
    {
        $data = Orden::orderByRaw("FIELD(estado, 'Pendiente', 'Enviado', 'Entregado')")
        ->paginate(8);

        return view('admin.ordenes', compact('data'));
    }

    public function en_camino($id)
    {
        $orden = Orden::find($id);

        if ($orden->estado == 'Pendiente') {
            $orden->estado = "Enviado";
            $orden->save();
            toastr()->closeButton()->success('El pedido fue enviado exitosamente');
        } else {
            toastr()->closeButton()->error('No se puede marcar como enviado. La orden ya está ' . $orden->estado);
        }

        return redirect('/view_ordenes');
    }

    public function entregado($id)
{
    $orden = Orden::find($id);

    if ($orden->estado == 'Enviado') {
        $orden->estado = "Entregado";
        $orden->save();
        toastr()->closeButton()->success('El pedido fue entregado exitosamente');
    } else {
        toastr()->closeButton()->error('No se puede marcar como entregado. La orden está ' . $orden->estado);
    }

    return redirect('/view_ordenes');
}
}
