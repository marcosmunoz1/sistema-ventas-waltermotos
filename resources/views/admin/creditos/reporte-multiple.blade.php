<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJxX3GZpY8m6NGGq56tXje77hP3vRCE0j+z93ZgDd8lg9rtPx6y9QRSX7GiX" crossorigin="anonymous">
    <style>
        /* Estilos personalizados */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative;
            min-height: 100vh;
            /* Asegura que el cuerpo ocupe al menos el 100% de la altura */
        }

        .container {
            margin-bottom: 50px;
            /* Espacio para el pie de página */
        }

        hr {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Aquí va el contenido de la factura (encabezado, cliente, detalles, etc.) -->

        <div class="header">
            <table border="0" style="font-size: 8pt">
                <tr>
                    <td><img src="{{ public_path('vendor/adminlte/dist/img/AdminLTELogo.png') }}" width="80px"
                            alt=""></td>
                    <td style="text-align: left" width="180px">
                        <span style="font-size: 10pt;">Walter<b>MOTOS</b></span><br>
                        CUIT: 99-99999999-9<br>
                        Tel: 3458-421587 <br>
                        Dir: Rep. Paraguay y Concordia
                    </td>
                    <td width="250px" style="font-size: 24pt; text-align: center;">Recibo</td>
                    <td width="200px" style="font-size: 12pt; text-align: end;">
                        Fecha:
                        <strong>{{ \Carbon\Carbon::parse($fecha_pago)->format('d-m-Y') }}</strong><br><br>
                        N°: <strong>{{ sprintf('%04d-%08d', 1, $credito->id) }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        <table border="0">
            <tr>
                <td style="font-size: 14pt;">
                    <p style="text-align: justify;">
                        En el día de la fecha recibí de
                        <strong>{{ $cliente->apellido_cliente }}, {{ $cliente->nombre_cliente }}</strong>,
                        número de DNI <strong>{{ number_format($cliente->dni_cliente, 0, ',', '.') }}</strong>,
                        la suma de <strong>${{ number_format($total_pagado, 2, ',', '.') }}</strong>
                        <em>({{ $montoLetras }})</em>,
                        en concepto de pago correspondiente a las cuotas número
                        <strong>{{ $numerosCuotas }}</strong> de su crédito personal.
                    </p>
                </td>
            </tr>

        </table>
    </div>

    <table border="0" style="font-size: 8pt; width: 100%;">
        <tr>
            <td width="80%"></td>
            <td width="250px" style="text-align: center; font-size: 12pt;">
                <p>_____________________________</p>
                <p>Firma y sello</p>
            </td>
        </tr>
    </table>

</body>

</html>
