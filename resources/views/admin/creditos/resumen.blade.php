<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eaf3f9;
        }

        .text-right {
            text-align: right;
        }

        .text-green {
            color: green;
        }

        .text-red {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Detalle de Crédito: {{ $credito->venta->cliente->apellido_cliente }},
        {{ $credito->venta->cliente->nombre_cliente }}</h2>
    <p><b>Fecha de Impresión:</b> {{ now()->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Cuota</th>
                <th>Vencimiento</th>
                <th>Fecha Pago</th>
                <th>Valor</th>
                <th>Interés x Mora</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($credito->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->numero_cuota }}</td>
                    <td>{{ \Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d-m-Y') }}</td>
                    <td class="text-center" style="vertical-align: middle">
                        @if ($detalle->fecha_pago)
                            {{ \Carbon\Carbon::parse($detalle->fecha_pago)->format('d-m-Y') }}
                        @else
                            Impaga
                        @endif
                    </td>
                    <td class="text-right">${{ number_format($detalle->valor_cuota, 2, ',', '.') }}</td>
                    <td class="text-right">${{ number_format($detalle->interes_mora, 2, ',', '.') }}</td>
                    <td>
                        @if ($detalle->estado_cuota == 'Paga')
                            <span class="text-green">Paga</span>
                        @else
                            <span class="text-red">Pendiente</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="tabla-detalle">>
          <tr>
            <td class="text-right"><b>Fecha de Venta:</b></td>
            <td class="text-right"> {{ \Carbon\Carbon::parse($credito->venta->fecha_venta)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Total de Venta:</b></td>
            <td class="text-right">${{ number_format($credito->venta->precio_venta, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Entrega:</b></td>
            <td class="text-right">${{ number_format($credito->entrega, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Total Financiado:</b></td>
            <td class="text-right">${{ number_format($credito->valor_financiado, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Interés de Crédito:</b></td>
            <td class="text-right">{{ $credito->interes }} %</td>
        </tr>
        <tr>
            <td class="text-right"><b>Cuotas:</b></td>
            <td class="text-right">{{ $credito->cantidad_cuotas }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Interés por Mora:</b></td>
            <td class="text-right">${{ number_format($credito->total_interes, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Total Cancelado:</b></td>
            <td class="text-green text-right">${{ number_format($credito->venta->total_pago, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="text-right"><b>Saldo de Crédito:</b></td>
            <td class="text-red text-right">${{ number_format($credito->saldo_credito, 2, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
<style>
    .tabla-detalle {
        width: 50%; /* ajusta el ancho de la tabla */
        border-collapse: collapse;
        margin-left: auto; /* alinea a la derecha */
        margin-right: 0;
    }

    .tabla-detalle td {
        padding: 4px 8px; /* espacio interno */
        border: none; /* sin bordes */
        font-size: 12px;
    }

    .tabla-detalle td.text-right {
        text-align: right;
    }

    .tabla-detalle td.text-green {
        color: green;
        font-weight: bold;
    }

    .tabla-detalle td.text-red {
        color: red;
        font-weight: bold;
    }
</style>
