<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          <h2 class="titulos text-center">Editar categoria</h2>
            <div class="m-2">
                
                <form action="{{url('actualizar_categoria', $data->id)}}" method="post" class="d-flex justify-content-center">
                    @csrf
                    <div class="d-flex col-md-6 col-10 d-flex justify-content-center align-items-center">
                      <input type="text" name="categoria" value="{{$data->nombre_categoria}}" class="form-control in-cate mr-2">
                      <input type="submit" value="Editar categoria" class=" btn btn-primary">
                    </div>
                </form>
            </div>

          </div>
      </div>
    </div>
    @include('admin.js')
  </body>
</html>