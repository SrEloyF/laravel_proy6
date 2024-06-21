<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <title>Mi carrito</title>
  <style>
    table {
      width: 800px;
    }

    td {
      border: 1px #DB6574 solid;
      color: #8A8D93;
    }

    th {
      font: 20px;
      font-weight: bold;
      border: 1px #DB6574 solid;
    }
  </style>

</head>

<body style="background-color: #22252A">
  <div class="hero_area">
    @include('home.header')
  </div>

  <div class="d-flex flex-column justify-content-center align-items-center m-3">
    @if($carrito->isEmpty())
    <i>No hay productos en el carrito</i>
    @else
    
    <div class="table-responsive">
      <table class="table-striped text-center col-11 mx-auto">
        <tr class="titulos">
          <th>Titulo del producto</th>
          <th>Precio</th>
          <th>Foto</th>
          <th>Unidades</th>
          <th>Quitar</th>
        </tr>

        @php
        $value = 0;
        @endphp

        @foreach($carrito as $item)
        <tr>
          <td>{{ $item->producto->titulo }}</td>
          <td>{{ $item->producto->precio }}</td>
          <td>
            <img src="/productos/{{ $item->producto->foto }}" alt="{{ $item->producto->foto }}" width="150">
          </td>
          <td class="col-md-4">
            <form action="{{ route('actualizar_cantidad', $item->id) }}" method="post" class="d-flex align-items-center justify-content-center">
              @csrf
              @method('PUT')
              <input type="number" name="cantidad" class="form-control w-25 m-1" min="1" value="{{ $item->cantidad }}">
              <button type="submit" class="btn btn-primary m-1">Actualizar</button>
            </form>
          </td>
          <td>
            <a href="{{ url('eliminar_prod_del_carrito', $item->id) }}" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
          </td>
        </tr>
        @php
        $value += $item->producto->precio * $item->cantidad;
        @endphp
        @endforeach
      </table>
    </div>

    <div class="mt-4">
      <h4>Total: {{ $value }}</h4>
    </div>

    <div><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
  <input type="hidden" name="cmd" value="_s-xclick" />
  <input type="hidden" name="hosted_button_id" value="3U6YUABMY9X8E" />
  <input type="hidden" name="currency_code" value="USD" />
  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" title="PayPal es una forma segura y fácil de pagar en línea." alt="Agregar al carrito" />
</form>
      <form action="{{url('confirmar_orden')}}" method="post">
        @csrf
        <div>
          <input type="submit" value="Realizar pedido" class="btn btn-primary">
        </div>
      </form>
    </div>
    @endif
  </div>

  <a href="{{ route('carrito.pdf') }}" target="_blank">Ver PDF del Carrito</a>
  @include('home.js')
  @include('home.footer')
</body>

</html>
