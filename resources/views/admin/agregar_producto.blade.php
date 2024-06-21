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

          <h2 class="text-center titulos">Agregue un producto</h2>
          <div class="d-flex flex-column justif-content-center align-items-center mt-2">
            <form action="{{url('subir_producto')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="lbl">Título del producto</label>
                    <input class="form-control" type="text" name="titulo" required>
                </div>

                <div class="mb-3">
                    <label class="lbl">Descripcion</label>
                    <textarea name="descripcion" required="" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="lbl">Precio</label>
                    <input class="form-control" type="number" name="precio" required>
                </div>

                <div class="mb-3">
                    <label class="lbl">Stock </label>
                    <input class="form-control" type="number" name="stock" id="inte" required>
                </div>

                <div class="mb-3">
                    <label class="lbl">Categoria del producto</label>
                    <select name="id_categoria" class="form-control" required>
                        <option value="">SELECCIONAR</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="lbl">Foto del producto</label>
                    <input class="form-control" type="file" name="foto" accept=".png, .jpg, .jpeg">
                </div>

                <div class="mb-3">
                    <input class="form-control" type="submit" value="Agregar producto" class="btn btn-primary">
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