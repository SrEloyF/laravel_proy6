<div class="d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('images/logo.jpg')}}" alt=":/" class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">El sol</h1>
            <p>Jirón Raymondy 397</p>
          </div>
        </div>
         <span class="heading">Menú</span>
        <ul class="list-unstyled">
                <li><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Inicio</a></li>
                <li>
                  <a href="{{url('view_categoria')}}"> <i class="icon-grid"></i>Categorias</a>
                </li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Productos</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('agregar_producto')}}">Agregar producto</a></li>
                    <li><a href="{{url('view_producto')}}">Ver productos</a></li>
                  </ul>
                </li>

                <li>
                  <a href="{{url('view_ordenes')}}"> <i class="icon-grid"></i>Ordenes</a>
                </li>
        </ul>
      </nav>