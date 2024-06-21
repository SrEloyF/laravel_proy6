<!DOCTYPE html>
<html>
<head>
    <title>PDF Carrito</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            position: relative; 
            z-index: 1; 
            margin: 0; 
            padding: 0; 
        }
        .bg-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .bg-container img {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: auto;
            opacity: 0.1;
            transform: translate(-50%, -50%) rotate(-70deg);
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            padding: 8px 12px; 
            border: 1px solid #ddd; 
        }
        th { 
            background-color: #f4f4f4; 
        }
    </style>
</head>
<body>
    <div class="bg-container">
        <img src="{{ public_path('images/logo.jpg') }}" alt="Logo de Fondo">
    </div>
    <h1 class="text-center">Boleta de Venta</h1>
    <h5>{{ $user->name }}</h5>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                <tr>
                    <td>{{ $item->producto->titulo }}</td>
                    <td>{{ $item->producto->precio }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->producto->precio * $item->cantidad }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h6>Total: {{ $total }}</h6>
    </div>
</body>
</html>
