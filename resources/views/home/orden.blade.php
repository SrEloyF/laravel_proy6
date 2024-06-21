<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis órdenes</title>
    @include('home.css')
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

    <div class="table-responsive m-5">
        <table class="table-striped table-bordered text-center col-6 mx-auto">
            <tr class="titulos">
                <th>Nombre del producto</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Foto</th>
                <th>Unidadades</th>
            </tr>

            @foreach($orden as $orden)
            <tr>
                <td>{{$orden->producto->titulo}}</td>
                <td>{{$orden->producto->precio}}</td>
                <td>{{$orden->estado}}</td>
                <td><img width="200" src="productos/{{$orden->producto->foto}}" alt="{{$orden->producto->foto}}"></td>
                <td>{{$orden->cantidad}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    @include('home.js')
    @include('home.footer')
</body>
</html>