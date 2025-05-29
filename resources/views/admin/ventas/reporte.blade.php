<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contrato de Compraventa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 2rem;
        }

        .firma {
            margin-top: 3rem;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .firma div {
            width: 30%;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">BOLETO DE COMPRAVENTA</h2>

        <p>
            Entre el señor <strong>MIÑO WALTER</strong> DNI Nº 25.065.190, con domicilio en calle PARAGUAY S/N de la
            ciudad de SAN JOSÉ DE FELICIANO, provincia de ENTRE RÍOS, en adelante <strong>EL VENDEDOR</strong>,
            y EL COMPRADOR: <strong>{{ $venta->cliente->apellido_cliente }},
                {{ $venta->cliente->nombre_cliente }}</strong>,
            DNI: {{ number_format($venta->cliente->dni_cliente, 0, ',', '.') }},
            fecha de nacimiento:
            <strong>{{ \Carbon\Carbon::parse($venta->cliente->fecha_nacimiento_cliente)->format('d-m-Y') }}</strong>,
            de profesion: <strong>{{ $venta->cliente->profesion }}</strong>,
            estado civil: <strong>{{ $venta->cliente->estado_civil_cliente }}</strong>
            @if ($venta->cliente->estado_civil_cliente === 'En Concubinato' && $conyugue)
                con <strong>{{ $conyugue->apellido_conyugue }}, {{ $conyugue->nombre_conyugue }}</strong>,
            @endif
            , con domicilio en calle <strong>{{ $venta->cliente->calle }}</strong>
            de la ciudad de <strong>{{ $venta->cliente->ciudad }}</strong>,
            provincia de <strong>{{ $venta->cliente->provincia }}</strong>. Ambos mayores de edad y
            hábiles para contratar, convienen en celebrar el presente BOLETO DE COMPRAVENTA, sujeto a las siguientes
            cláusulas y condiciones.
        </p>

        <p><strong>PRIMERA:</strong> El vendedor dice que: VENDE y el comprador dice que: COMPRA una MOTOCICLETA MARCA:
            <strong>{{ $venta->moto->marca->nombre_marca }}</strong>, COLOR
            <strong>{{ $venta->moto->color_moto }}</strong>,
            MOTOR Nro.: <strong>{{ $venta->moto->nr_motor }}</strong>, CHASIS Nro.:
            <strong>{{ $venta->moto->nr_chasis }}</strong>, el estado en que se encuentra y con previa revisación, es
            recibido/a por el comprador a su entera satisfacción.
        </p>

        <p><strong>SEGUNDA:</strong> Esta venta se realiza de la siguiente manera:
            @if ($venta->forma_pago === 'Contado')
                ENTREGA EL MONTO TOTAL DE CONTADO EFECTIVO:
                ${{ number_format($venta->precio_venta ?? 0, 0, ',', '.') }}
                <em>({{ $montoLetrasContado }})</em>,
                <strong><em>El importe recibido, sirve el presente como formal recibo y carta de pago por dicha suma.
            @elseif($venta->forma_pago === 'Credito' && $credito)
                UNA ENTREGA INICIAL DE: ${{ number_format($credito->entrega, 0, ',', '.') }}
                <em>({{ $montoLetrasCredito }})</em>,
                saldo FINANCIADO de ${{ number_format($credito->valor_financiado, 0, ',', '.') }}
                en {{ $credito->cantidad_cuotas }} cuotas de
                ${{ number_format($credito->monto_cuota, 0, ',', '.') }} cada una.

                <strong><em>El monto de la entrega inicial fue recibido en dinero en efectivo, sirviendo el presente
                        como formal
                        recibo y carta de pago por dicha suma:
                        ${{ number_format($credito->entrega, 0, ',', '.') }}</em>.
            @endif
        </p>

        <p><strong>TERCERA:</strong> La forma de pago en la fecha expresada importa la mora automática y autoriza al
            vendedor a entablar las acciones judiciales pertinentes por la totalidad del saldo adeudado, sin necesidad
            de interpelación judicial o extrajudicial, siendo a cargo del comprador todos los gastos que deriven de su
            morosidad. El vendedor queda autorizado, en caso de ejecución a solicitar de inmediato, el secuestro del
            vehículo objeto de este boleto, a título de mero depósito, hasta el pago del saldo adeudado.----------</p>

        <p><strong>TERCERA:</strong> La forma de pago en la fecha expresada importa la mora automática y autoriza al
            vendedor a entablar las acciones judiciales pertinentes por la totalidad del saldo adeudado, sin necesidad
            de interpelación judicial o extrajudicial, siendo a cargo del comprador todos los gastos que deriven de su
            morosidad. El vendedor queda autorizado, en caso de ejecución a solicitar de inmediato, el secuestro del
            vehículo objeto de este boleto, a título de mero depósito, hasta el pago del saldo adeudado.----------.</p>

        <p><strong>CUARTA:</strong> El vendedor otorga al comprador, desde la fecha del presente boleto, la simple
            tenencia del vehículo objeto de este boleto, hasta el pago total del saldo adeudado.---------- .</p>
        <p><strong>QUINTA:</strong> El comprador no tendrá derecho y así se conviene, a reclamar judicial o
            extrajudicialmente la transferencia del vehículo objeto de este boleto, hasta el pago total del saldo
            adeudado.---------- .</p>
        <p><strong>SEXTA:</strong> El comprador se compromete y así se conviene irrevocablemente a no vender o grabar el
            vehículo objeto de este boleto, hasta el pago total del saldo adeudado.-----------.</p>
        <p><strong>SEPTIMA:</strong> Será por cuenta del comprador, a partir de la fecha del presente boleto de compara
            venta, cualquier deterioro que sufra el vehículo objeto de este boleto, sea por accidentes, casos fortuitos,
            de fuerza mayor o por hechos del hombre y será responsable civil y criminalmente de todas las consecuencias
            derivadas del uso y tenencia de la citada unidad.----------.</p>
        <p><strong>OCTAVA:</strong> Son a cargo del comprador, en forma exclusiva, los gastos de: patente,
            patentamiento, transferencia y/o cualquier tasa o tributo que grave a la unidad vendida, desde la fecha del
            presente boleto.-----------.</p>
        <p><strong>NOVENA:</strong> El señor: DNI: con domicilio en calle: provincia de: se constituye en GARANTE
            solidario, liso y llano y principal pagador d. las obligaciones emergentes del presente boleto, renunciando
            al beneficio de divisiones .-----------.</p>
        <p><strong>DECIMA:</strong> El comprador y el garante, firman este boleto enterados de todas y cada una de sus
            cláusulas, las que previamente han sido leídas por ambos y prestada la consiguiente conformidad.---.</p>
        <p><strong>DECIMA PRIMERA:</strong> En caso de incumplimiento a lo pactado, se procederá a la devolución del
            bien adquirido, sin juicio previo y con una retención del valor recibido, del…0…..% en concepto de
            desvalorización por el uso del bien objeto del presente contrato..</p>
        <p><strong>DECIMA SEGUNDA:</strong> Para todos los efectos legales del presente boleto de compra venta, las
            partes se someten voluntariamente a la jurisdicción de los Tribunales Ordinarios de la Ciudad de San José de
            Feliciano, Provincia de Entre Ríos, Jurisdicción a la que se someten, renunciando a cualquier otro fuero que
            pudiera corresponder, fijando domicilios legales y especiales, a los efectos de cualquier notificación o
            citación judicial o extrajudicial, en los arriba mencionados.----------------.</p>

        <p class="text-end">Leído y de conformidad, se firman tres ejemplares de un mismo tenor y a un solo
            efecto en la ciudad de SAN JOSE DE FELICIANO provincia de ENTRE RIOS, a los
            <strong>{{ \Carbon\Carbon::parse($venta->fehca_venta)->format('d-m-Y') }}</strong>
        </p>

        <div class="firma">
            <div>
                <p>……………………..………</p>
                <p>VENDEDOR</p>
            </div>
            <div>
                <p>…………………………...</p>
                <p>COMPRADOR</p>
            </div>
            <div>
                <p>………………… …………...</p>
                <p>GARANTE</p>
            </div>
        </div>
    </div>

</body>

</html>
