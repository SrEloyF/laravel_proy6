<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')

    <style>
        table{
            overflow-x: auto !important;
        }
        td{
            border: 1px #DB6574 solid;
        }
        th{
            font-size:20px;
            font-weight:bold;
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

                <div class="mb-3">
                  <form action="{{ url('buscar_orden') }}" method="get" class="d-flex flex-row">
                    @csrf
                    <input type="search" name="buscar" style="max-width: 400px;" placeholder="Nombre del cliente, dirección, producto o estado" class="form-control mr-2">
                    <input type="submit" value="Buscar" class="btn btn-success">
                </form>
            </div>
            <div class="table-responsive">
                <table class="text-center col-11 mx-auto">
                    <tr class="titulos">
                        <th>Nombre del cliente</th>
                        <th>Direccion</th>
                        <th>Teléfono</th>
                        <th>Título del producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Foto</th>
                        <th>Estado</th>
                        <th>Cambiar estado</th>
                    </tr>

                    @foreach($data as $orden)
                    <tr>
                        <td>{{ $orden->user->name }}</td>
                        <td>{{ $orden->user->direccion }}</td>
                        <td>{{ $orden->user->telefono }}</td>
                        <td>{{ $orden->producto->titulo }}</td>
                        <td>{{ $orden->producto->precio }}</td>
                        <td>{{ $orden->cantidad }}</td>
                        <td>
                            <img src="productos/{{ $orden->producto->foto }}" alt="{{ $orden->producto->foto }}" width="150">
                        </td>
                        <td>
                            @if($orden->estado == 'Pendiente')
                            <span style="color:red">{{ $orden->estado }}</span>
                            @elseif($orden->estado == 'Enviado')
                            <span style="color:yellow">{{ $orden->estado }}</span>
                            @else
                            <span style="color:#39FF14">{{ $orden->estado }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('en_camino', $orden->id) }}" class="btn btn-primary m-1" 
                                @if($orden->estado != 'Pendiente') disabled @endif>
                                Enviado
                            </a>
                            <a href="{{ url('entregado', $orden->id) }}" class="btn btn-success m-1" 
                                @if($orden->estado != 'Enviado') disabled @endif>
                                Entregado
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-2">
                {{ $data->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
@include('admin.js')
</body>

</html>