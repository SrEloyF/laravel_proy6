<div class="container">
    <h2 class="text-center my-4 titulos">Revise nuestros productos por categoría</h2>
    

    <section>
        <div class="container">
          <div class="row mb-4 d-flex justify-content-center">

            <select name="categoria" id="categoria" class="s-form-control">
                <option value="0">TODOS</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                @endforeach
            </select>
            
        </div>
        <div class="row" id="productos-container">

            @foreach($producto as $productos)
            <div class="col-xl-3 col-md-6 col-sm-12 mb-4">
                <div class="card card-gradi">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="productos/{{$productos->foto}}" alt="" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;">
                        </div>
                        <div class="mt-3 d-flex flex-column align-items-center">
                            <h6 class="detalles">{{$productos->titulo}}</h6>
                            <h6 class="detalles">Precio <span>${{$productos->precio}}</span></h6>
                        </div>
                        <div class="mt-3 d-flex flex-column align-items-center">
                            <a href="{{url('detalles_producto', $productos->id)}}" class="btn btn-danger btn-sm mb-2">Detalles</a>
                            <form class="d-flex flex-column align-items-center" id="carrito-form" action="{{ url('anadir_carrito', ['id' => $productos->id]) }}" method="POST">
                                @csrf
                                <input type="number" name="cantidad" id="cantidad" class="s-form-control w-25 mb-2 px-2" min="1" value="1">
                                <button type="submit" class="btn btn-success btn-sm">Añadir al carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
</div>
@include('home.js')
<script>
    document.getElementById('categoria').addEventListener('change', function() {
        var idCategoria = this.value;
        var url = '/productos/' + idCategoria;
        fetch(url)
        .then(response => response.json())
        .then(data => {
            var productosContainer = document.getElementById('productos-container');
            productosContainer.innerHTML = '';
            data.forEach(producto => {
                var productoCard = `
                <div class="col-md-3 mb-4">
                <div class="card card-gradi">
                <div class="card-body">
                <div class="text-center">
                <img src="productos/${producto.foto}" alt="" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover;">
                </div>
                <div class="mt-3 d-flex flex-column align-items-center">
                <h6 class="detalles" >${producto.titulo}</h6>
                <h6 class="detalles">Precio <span>$${producto.precio}</span></h6>
                </div>
                <div class="mt-3 d-flex flex-column align-items-center">
                <a href="detalles_producto/${producto.id}" class="btn btn-danger btn-sm mb-2">Detalles</a>
                <form class="d-flex flex-column align-items-center" id="carrito-form" action="anadir_carrito/${producto.id}" method="POST">
                @csrf
                <input type="number" name="cantidad" id="cantidad" class="s-form-control w-25 mb-2 px-2" min="0" value="1">
                <button type="submit" class="btn btn-success btn-sm">Añadir al carrito</button>
                </form>
                </div>
                </div>
                </div>
                </div>`;
                productosContainer.innerHTML += productoCard;
            });
        });
    });
</script>
