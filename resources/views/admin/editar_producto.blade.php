<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
        label{
            display: inline-block;
            width: 200px;
            padding: 10px;
        }

        textarea{
            width: 400px;
            height:80px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="text-center text-light">Actualizar producto</h2>
            <div class="d-flex justify-content-center align-items-center">
                <form method="post" action="{{url('actualizar_producto', $data->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="lbl">Titulo</label>
                        <input class="form-control" type="text" name="titulo" value="{{$data->titulo}}"> 
                    </div>

                    <div>
                        <label class="lbl">Descripcion</label>
                        <textarea name="descripcion" class="form-control">{{$data->descripcion}}</textarea>
                    </div>

                    <div>
                        <label class="lbl">Precio</label>
                        <input class="form-control" type="number" name="precio" value="{{$data->precio}}"> 
                    </div>

                    <div>
                        <label class="lbl">Stock</label>
                        <input class="form-control" type="number" name="stock" value="{{$data->stock}}" id="inte" min="1"> 
                    </div>

                    <div>
                        <label class="lbl">Categoria</label>
                        <select name="id_categoria" class="form-control">
                            <option  value="{{ $data->categoria->id }}">{{ $data->categoria->nombre_categoria }}</option>
                            @foreach($categorias as $categoria)
                                @if($categoria->id != $data->categoria->id)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>



                    <div class="mt-2">
                        <label class="lbl" for="foto">Foto</label>
                        @if($data->foto)
                            <img src="/productos/{{$data->foto}}" width="140" id="foto">
                        @else
                            <i>No disponible</i>
                        @endif
                    </div>

                    <div>
                        <label class="lbl" for="foto">Nueva foto</label>
                        <input class="form-control" type="file" name="foto" id="foto">
                    </div>


                    <div>
                        <input class="btn btn-primary mt-2" type="submit" class="btn btn-success" value="Actualizar producto">
                    </div>
                </form>

            </div>

          </div>
      </div>
    </div>
    
    @include('admin.js') 
    <script>
        const input = document.getElementById('inte');

        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, ''); 
        });
    </script>

  </body>
</html>