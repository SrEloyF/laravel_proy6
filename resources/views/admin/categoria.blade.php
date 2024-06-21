<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        th{
            font-size: 20px;
            font-weight: bold;
            border: 1px #DB6574 solid;
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
          <h2 class="titulos text-center">Agrega una categoría</h2>
               <div class="div-d m-3 d-flex flex-column justify-content-center align-items-center">
                <div class="col-12 col-md-6">
                    <form action="{{url('agregar_categoria')}}" method="post">
                        @csrf
                        <div class="d-flex justify-content-between my-3">
                            <input type="text" name="categoria" class="form-control in-cate">
                    
                            <input type="submit" value="Agregar categoria" class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-6">
                <table class="table-striped text-center w-100">
                    <tr>
                        <th class="p-1t">Nombre de Categoria</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    @foreach($data as $data) 
                    <tr>
                        <td class="p-1">{{$data->nombre_categoria}}</td>
                        <td>
                            <a class="btn btn-success" href="{{url('editar_categoria', $data->id)}}">Editar</a>
                        </td>
                        <td class="p-1">
                            <a href="{{ url('eliminar_categoria', $data->id) }}" class="btn btn-danger" onclick="confirmacion(event)">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
              </div>
              </div>
              
              
          </div>
      </div>
    </div>

    @include('admin.js')
    @if(session('error'))
    <script>
        swal({
            title: "Error",
            text: "{{ session('error') }}",
            icon: "error",
            button: "OK",
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        swal({
            title: "Éxito",
            text: "{{ session('success') }}",
            icon: "success",
            button: "OK",
        });
    </script>
    @endif
  </body>
</html>