<!DOCTYPE html>
<html>

<head>
  @include('home.css')
</head>

<body style="background-color: #22252A">
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

  </div>

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2 class="titulos">
          Producto seleccionado
        </h2>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="box">

              <div class="d-flex justify-content-center align-items-center p-2">
                <img src="/productos/{{$data->foto}}" alt="{{$data->foto}}" width="400">
              </div>


              <div class="detail-box p-2">
                <h6 class="titulos">{{$data->titulo}}</h6>
                <h6 class="titulos">Precio<span>${{$data->precio}}</span></h6>
              </div>

              <div class="detail-box p-2">
                  <h6 class="titulos">Categoría: {{ $data->categoria->nombre_categoria }}</h6>
                  <h6 class="titulos">Stock: <span>{{ $data->stock }}</span></h6>
              </div>


              <div class="detail-box p-2">
                <p class="titulos">Descripción: {{$data->descripcion}}</p>
              </div>

          </div>
        </div>

      </div>  
    </div>
  </section>



  @include('home.footer')

</body>

</html>