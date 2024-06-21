<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        th{
            font-size: 20px;
            border: 1px #DB6574 solid;
            padding-right: 1rem;
            padding-left: 1rem;
        }
        td{
            border: 1px #DB6574 solid;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <form action="{{ url('buscar_producto') }}" method="get" class="d-flex">
            @csrf
            <input type="search" name="buscar" placeholder="Nombre o Categoria" class="form-control mr-2" style="max-width: 300px;">
            <input type="submit" value="Buscar" class="btn btn-success">
          </form>


          <div class="table-responsive col-11 mx-auto mt-3">
            <table class="table-striped text-center">
                <tr>
                    <th>Titulo del producto</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Foto</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>

                @foreach($productos as $producto)
                    <tr>
                        <td>{{$producto->titulo}}</td>
                        <td>{!!Str::words($producto->descripcion, 7)!!}</td>
                        <td>{{$producto->categoria->nombre_categoria }}</td>
                        <td>{{$producto->precio}}</td>
                        <td>{{$producto->stock}}</td>
                        <td>
                            <img  height="150" src="productos/{{$producto->foto}}">
                        </td>
                        <td>
                          <a href="{{url('editar_producto', $producto->id)}}" class="btn btn-success">Editar</a>
                        </td>
                        <td>
                            <a href="{{url('eliminar_producto', $producto->id)}}" class="btn btn-danger" onclick="confirmacion(event)">Eliminar</a>
                        </td>
                    </tr>
                @endforeach

            </table>
            
          </div>
            <div class="d-flex justify-content-center align-items-center mt-2">
            {{$productos->onEachSide(1)->links()}}
            </div>
          </div>
      </div>
    </div>

    @include('admin.js')
  </body>
</html>