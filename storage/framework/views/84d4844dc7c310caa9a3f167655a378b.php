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

        .text-justify {
            text-align: justify;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="container">

        <table style="width: 100%; text-align: center;">
            <tr>
                <td>
                    <h2 class="text-center">BOLETO DE COMPRAVENTA</h2>
                </td>

            </tr>
        </table>

        <p class="text-justify">
            Entre el señor <strong>MIÑO WALTER</strong> DNI Nº 25.065.190, con domicilio en calle PARAGUAY S/N de la
            ciudad de SAN JOSÉ DE FELICIANO, provincia de ENTRE RÍOS, en adelante <strong>EL VENDEDOR</strong>,
            y EL COMPRADOR: <strong><?php echo e($venta->cliente->apellido_cliente); ?>,
                <?php echo e($venta->cliente->nombre_cliente); ?></strong>,
            DNI: <?php echo e(number_format($venta->cliente->dni_cliente, 0, ',', '.')); ?>,
            fecha de nacimiento:
            <strong><?php echo e(\Carbon\Carbon::parse($venta->cliente->fecha_nacimiento_cliente)->format('d-m-Y')); ?></strong>,
            de profesion: <strong><?php echo e($venta->cliente->profesion); ?></strong>,
            estado civil: <strong><?php echo e($venta->cliente->estado_civil_cliente); ?></strong>
            <?php if($venta->cliente->estado_civil_cliente === 'En Concubinato' && $conyugue): ?>
                con <strong><?php echo e($conyugue->apellido_conyugue); ?>, <?php echo e($conyugue->nombre_conyugue); ?></strong>,
            <?php endif; ?>
            , con domicilio en calle <strong><?php echo e($venta->cliente->calle); ?></strong>
            de la ciudad de <strong><?php echo e($venta->cliente->ciudad); ?></strong>,
            provincia de <strong><?php echo e($venta->cliente->provincia); ?></strong>. Ambos mayores de edad y
            hábiles para contratar, convienen en celebrar el presente BOLETO DE COMPRAVENTA, sujeto a las siguientes
            cláusulas y condiciones.
        </p>

        <p class="text-justify"><strong>PRIMERA:</strong> El vendedor dice que: VENDE y el comprador dice que: COMPRA una MOTOCICLETA
            MARCA:
            <strong><?php echo e($venta->moto->marca->nombre_marca); ?></strong>, COLOR
            <strong><?php echo e($venta->moto->color_moto); ?></strong>,
            MOTOR Nro.: <strong><?php echo e($venta->moto->nr_motor); ?></strong>, CHASIS Nro.:
            <strong><?php echo e($venta->moto->nr_chasis); ?></strong>, el estado en que se encuentra y con previa revisación,
            es
            recibido/a por el comprador a su entera satisfacción.
        </p>

        <p class="text-justify"><strong>SEGUNDA:</strong> Esta venta se realiza de la siguiente manera:
            <?php if($venta->forma_pago === 'Contado'): ?>
                ENTREGA EL MONTO TOTAL DE CONTADO EFECTIVO:
                $<?php echo e(number_format($venta->precio_venta ?? 0, 0, ',', '.')); ?>

                <em>(<?php echo e($montoLetrasContado); ?>)</em>,
                <strong><em>El importe recibido, sirve el presente como formal recibo y carta de pago por dicha
                        suma.
                    <?php elseif($venta->forma_pago === 'Credito' && $credito): ?>
                        UNA ENTREGA INICIAL DE: $<?php echo e(number_format($credito->entrega, 0, ',', '.')); ?>

                        <em>(<?php echo e($montoLetrasCredito); ?>)</em>,
                        saldo FINANCIADO de $<?php echo e(number_format($credito->valor_financiado, 0, ',', '.')); ?>

                        en <?php echo e($credito->cantidad_cuotas); ?> cuotas de
                        $<?php echo e(number_format($credito->monto_cuota, 0, ',', '.')); ?> cada una.

                        <strong><em>El monto de la entrega inicial fue recibido en dinero en efectivo, sirviendo el
                                presente
                                como formal
                                recibo y carta de pago por dicha suma:
                                $<?php echo e(number_format($credito->entrega, 0, ',', '.')); ?></em>.
            <?php endif; ?>
        </p>

        <p class="text-justify"><strong>TERCERA:</strong> La forma de pago en la fecha expresada importa la mora automática y autoriza al
            vendedor a entablar las acciones judiciales pertinentes por la totalidad del saldo adeudado, sin
            necesidad
            de interpelación judicial o extrajudicial, siendo a cargo del comprador todos los gastos que deriven de
            su
            morosidad. El vendedor queda autorizado, en caso de ejecución a solicitar de inmediato, el secuestro del
            vehículo objeto de este boleto, a título de mero depósito, hasta el pago del saldo adeudado.----------
        </p>

        <p class="text-justify"><strong>TERCERA:</strong> La forma de pago en la fecha expresada importa la mora automática y autoriza al
            vendedor a entablar las acciones judiciales pertinentes por la totalidad del saldo adeudado, sin
            necesidad
            de interpelación judicial o extrajudicial, siendo a cargo del comprador todos los gastos que deriven de
            su
            morosidad. El vendedor queda autorizado, en caso de ejecución a solicitar de inmediato, el secuestro del
            vehículo objeto de este boleto, a título de mero depósito, hasta el pago del saldo adeudado.----------.
        </p>

        <p class="text-justify"><strong>CUARTA:</strong> El vendedor otorga al comprador, desde la fecha del presente boleto, la simple
            tenencia del vehículo objeto de este boleto, hasta el pago total del saldo adeudado.---------- .</p>
        <p class="text-justify"><strong>QUINTA:</strong> El comprador no tendrá derecho y así se conviene, a reclamar judicial o
            extrajudicialmente la transferencia del vehículo objeto de este boleto, hasta el pago total del saldo
            adeudado.---------- .</p>
        <p class="text-justify"><strong>SEXTA:</strong> El comprador se compromete y así se conviene irrevocablemente a no vender o
            grabar el
            vehículo objeto de este boleto, hasta el pago total del saldo adeudado.-----------.</p>
        <p class="text-justify"><strong>SEPTIMA:</strong> Será por cuenta del comprador, a partir de la fecha del presente boleto de
            compara
            venta, cualquier deterioro que sufra el vehículo objeto de este boleto, sea por accidentes, casos
            fortuitos,
            de fuerza mayor o por hechos del hombre y será responsable civil y criminalmente de todas las
            consecuencias
            derivadas del uso y tenencia de la citada unidad.----------.</p>
        <p class="text-justify"><strong>OCTAVA:</strong> Son a cargo del comprador, en forma exclusiva, los gastos de: patente,
            patentamiento, transferencia y/o cualquier tasa o tributo que grave a la unidad vendida, desde la fecha
            del
            presente boleto.-----------.</p>
        <p class="text-justify"><strong>NOVENA:</strong> El señor: DNI: con domicilio en calle: provincia de: se constituye en GARANTE
            solidario, liso y llano y principal pagador d. las obligaciones emergentes del presente boleto,
            renunciando
            al beneficio de divisiones .-----------.</p>
        <p class="text-justify"><strong>DECIMA:</strong> El comprador y el garante, firman este boleto enterados de todas y cada una de
            sus
            cláusulas, las que previamente han sido leídas por ambos y prestada la consiguiente conformidad.---.</p>
        <p class="text-justify"><strong>DECIMA PRIMERA:</strong> En caso de incumplimiento a lo pactado, se procederá a la devolución del
            bien adquirido, sin juicio previo y con una retención del valor recibido, del…0…..% en concepto de
            desvalorización por el uso del bien objeto del presente contrato..</p>
        <p class="text-justify"><strong>DECIMA SEGUNDA:</strong> Para todos los efectos legales del presente boleto de compra venta, las
            partes se someten voluntariamente a la jurisdicción de los Tribunales Ordinarios de la Ciudad de San
            José de
            Feliciano, Provincia de Entre Ríos, Jurisdicción a la que se someten, renunciando a cualquier otro fuero
            que
            pudiera corresponder, fijando domicilios legales y especiales, a los efectos de cualquier notificación o
            citación judicial o extrajudicial, en los arriba mencionados.----------------.</p>

        <p class="text-end">Leído y de conformidad, se firman tres ejemplares de un mismo tenor y a un solo
            efecto en la ciudad de SAN JOSE DE FELICIANO provincia de ENTRE RIOS, con fecha 
            <strong><?php echo e(\Carbon\Carbon::parse($venta->fehca_venta)->format('d-m-Y')); ?></strong>
        </p>

        <table style="width: 100%; text-align: center; margin-top: 50px;">
            <tr>
                <td style="width: 33%;">
                    <p>……………………..………</p>
                    <p>VENDEDOR</p>
                </td>
                <td style="width: 33%;">
                    <p>…………………………...</p>
                    <p>COMPRADOR</p>
                </td>
                <td style="width: 33%;">
                    <p>………………… …………...</p>
                    <p>GARANTE</p>
                </td>
            </tr>
        </table>


    </div>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\admin\ventas\reporte.blade.php ENDPATH**/ ?>