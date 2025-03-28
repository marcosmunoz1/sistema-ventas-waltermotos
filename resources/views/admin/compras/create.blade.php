@extends('adminlte::page')

@section('title', 'Cargar Compra')

@section('content_header')
    <h2 class="brand-text font-weight-light">Admin/Compras/<b>Cargar-Comrpa</b></h2>
    <hr>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <div class="card-title">Datos de Compra </div>
                </div>

                <div class="card-body">
                    <form action="{{ url('/admin/compras/cargar-compra') }}" id="form_compra" method="post">
                        @csrf
                        <input type="hidden" name="actualizar_precios" id="actualizar_precios" value="0">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha </label><b style="color: red;"> *</b>
                                    <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                                        class="form-control" required>
                                    @error('fecha')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Proveedor </label><b style="color: red;"> *</b>
                                    <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                                        <option value="">Seleccione un proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Remito </label>
                                    <input type="text" name="remito" class="form-control" value="{{ old('remito') }}"
                                        placeholder="Ingrese el numero de remito si lo tienes">
                                    @error('remito')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Factura</label>
                                    <input type="text" name="factura" class="form-control" value="{{ old('factura') }}"
                                        placeholder="Ingrese el número de factura si lo tiene.">
                                    @error('factura')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Total de la compra</label>
                                    <input type="text" name="total" id="total-compra2" class="form-control" readonly
                                        value="{{ old('total', 0) }}">
                                </div>
                            </div>
                        </div>

                        <hr class="card card-outline card-success">

                        <div class="row">
                            <!-- Cantidad -->
                            <div class="col-md-1">
                                <label class="form-label">Cantidad *</label>
                                <input type="number" id="cantidad" name="cantidad" class="form-control" value="1"
                                    min="1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Código</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="codigo"
                                        placeholder="codigo de producto">
                                    <!-- Boton bouscar -->
                                    <button type="button" class="btn btn-outline-info" id="buscarProducto"
                                        data-bs-toggle="modal" data-bs-target="#productosModal">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <!-- Boton agregar -->
                                    <a href="{{ url('/admin/productos/crear-producto') }}" class="btn btn-outline-primary"
                                        id="agregarProducto">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr class="card card-outline card-info">

                        <!-- Detalle de Productos -->

                        {{-- <div class="card-title ">Detalle de compra</div> --}}
                        <div class="card-body">
                            <div class="col-md-12 mx-auto d-flex justify-content-center">
                                <table class="table table-sm table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 2%">Cantidad</th>
                                            <th class="text-center" style="width: 15%">codigo</th>
                                            <th style="width: 40%">Producto</th>
                                            <th class="text-center" style="width: 12%">P.Compra</th>
                                            <th class="text-center" style="width: 12%">P.Venta</th>
                                            <th class="text-center" style="width: 13%">Subtotal</th>
                                            <th class="text-center" style="width: 2%">...</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle-productos">
                                        <!-- Aquí se agregarán productos con JavaScript -->
                                    </tbody>

                                </table>
                            </div>
                            <!-- Mostrar el total -->
                            <div class="row">
                                <div class="col-md-12 mx-auto d-flex justify-content-end">
                                    <div class="text-end mt-2 mx-4 bg-info p-3 rounded border" style="width: 250px;">
                                        <h4 class="text-center mb-0">Total: <span id="total-compra">$0.00</span></h4>
                                    </div>
                                </div>
                            </div>


                            <!-- Botones de acción -->
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-success" id="btnRegistrar">
                                    <i class="fas fa-save"></i> Registrar
                                </button>
                                <a href="{{ url('admin/compras') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Buscar producto</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table">
                            <table class="table table-striped table-responsive"  id="tablaProductos"
                                style="table-layout: fixed; width: 100%;">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 5%;">Acción</th>
                                        <th scope="col" style="width: 10%;">Código</th>
                                        <th scope="col" style="width: 35%;">Nombre del Producto</th>
                                        <th scope="col" style="width: 15%;">P. Compra</th>
                                        <th scope="col" style="width: 15%;">P. Venta</th>
                                        <th scope="col" style="width: 5%;">Stock</th>
                                        <th scope="col" style="width: 15%;">Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button class="btn btn-info"
                                                    onclick="seleccionarProductoDesdeModal(
                                                    '{{ $producto->id }}',
                                                    '{{ $producto->codigo }}',
                                                    '{{ $producto->nombre }}',
                                                    '{{ $producto->precio_compra }}',
                                                    '{{ $producto->precio_venta }}'
                                                )">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                </button>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $producto->codigo }}
                                            </td>
                                            <td class="text-truncate" style="vertical-align: middle;">
                                                {{ $producto->nombre }}
                                            </td>
                                            <td class="text-success"
                                                style="vertical-align: middle; font-size: 18px; text-align: right;">
                                                ${{ number_format($producto->precio_compra, 2) }}
                                            </td>
                                            <td class="text-danger"
                                                style="vertical-align: middle; font-size: 18px; text-align: right;">
                                                ${{ number_format($producto->precio_venta, 2) }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                {{ $producto->stock }}
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if ($producto->image != '')
                                                    <img src="{{ asset('storage/' . $producto->image) }}" alt="Imagen"
                                                        style="max-width: 100px; height: auto;">
                                                @else
                                                    <span>No hay imagen</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>

        </div>


    @endsection

    @section('css')
        {{-- Aquí puedes agregar estilos personalizados --}}
    @endsection

    @section('js')
        {{-- Aquí puedes agregar scripts adicionales --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function() {
                // Inicializar DataTable
                $('#tablaProductos').DataTable({
                    "pageLength": 5,
                    "language": {
                        "emptyTable": "No hay información.",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                        "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                        "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                        "lengthMenu": "Mostrar _MENU_ Productos",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscador:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                });
            });

            $('#form_compra').on('keypress', function(e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                }
            });

            $("#codigo").on("keyup", function(event) {
                if (event.which === 13) { // Detecta "Enter"
                    let codigo = $(this).val();
                    let cantidad = $("#cantidad").val(); // Obtener la cantidad


                    if (codigo.length > 0) {
                        $.ajax({
                            url: "{{ route('admin.compras.buscarProducto') }}", // Ruta a la función en el controlador
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}", // Token CSRF para seguridad
                                codigo: codigo
                            },
                            dataType: "json", // Indicar que la respuesta es JSON
                            success: function(response) {
                                if (response.success) {
                                    let producto = response
                                        .producto;
                                    agregarFilaDesdeCodigo(producto,
                                        cantidad);
                                    $("#codigo").val(""); // Limpiar el campo después de agregar
                                    $("#cantidad").val("1"); // Resetear cantidad
                                } else {
                                    //alert(`No se encontró el producto con código: ${codigo}`);
                                    Swal.fire({
                                        icon: "error",
                                        title: "Producto no encotrado",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Error en AJAX:", xhr.responseText);
                                alert(`Error al buscar el producto con código: ${codigo}`);
                            }

                        });

                    }
                }
            });


            function seleccionarProductoDesdeModal(id, codigo, nombre, precioCompra, precioVenta) {
                let cantidad = parseInt($("#cantidad").val()) || 1; // Si no hay valor, usa 1

                if (!id || !nombre || isNaN(precioCompra) || isNaN(precioVenta)) {
                    alert("Por favor, selecciona un producto válido.".precioCompra, value);
                    return;
                }

                // Verifica si el producto ya está en la tabla
                if (!agregarOActualizarFila(id, nombre, precioCompra, precioVenta, cantidad, codigo)) {
                    agregarFilaDesdeModal(id, nombre, precioCompra, precioVenta, cantidad, codigo);
                }

                // Cerrar el modal según la versión de Bootstrap
                let modal = document.getElementById("productosModal");
                if (typeof bootstrap !== "undefined") {
                    let modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) modalInstance.hide();
                } else {
                    $("#productosModal").modal("hide"); // Para Bootstrap 4
                }
            }

            function agregarFilaDesdeCodigo(producto, cantidad) {
                let id = producto.id;
                let codigo = producto.codigo;
                let nombre = producto.nombre;
                let precioCompra = parseFloat(producto.precio_compra);
                let precioVenta = parseFloat(producto.precio_venta);

                if (!id || !nombre || isNaN(precioCompra) || isNaN(precioVenta)) {
                    alert("El producto no es válido.");
                    return;
                }

                // Verifica si el producto ya está en la tabla
                if (!agregarOActualizarFila(id, nombre, precioCompra, precioVenta, cantidad, codigo)) {
                    agregarFilaDesdeModal(id, nombre, precioCompra, precioVenta, cantidad, codigo);
                }
            }

            // Función para agregar o actualizar la fila con el producto
            function agregarOActualizarFila(productoId, productoNombre, precioCompra, precioVenta, cantidad, codigo) {
                const detalleProductos = document.getElementById('detalle-productos');
                const filas = detalleProductos.querySelectorAll('tr');

                for (let fila of filas) {
                    const idProducto = fila.querySelector('input[name="productos[]"]').value;

                    // Si el producto ya existe, actualiza la cantidad
                    if (idProducto == productoId) {
                        const cantidadInput = fila.querySelector('input[name="cantidades[]"]');
                        const subtotalInput = fila.querySelector('input[name="subtotales[]"]');
                        let nuevaCantidad = parseInt(cantidadInput.value) + parseInt(cantidad, 10); // Suma la cantidad

                        cantidadInput.value = nuevaCantidad;
                        subtotalInput.value = (precioCompra * nuevaCantidad).toFixed(2); // Actualiza el subtotal
                        calcularTotal(); // Recalcula el total de la compra
                        return true; // Producto ya estaba, no es necesario agregar nueva fila
                    }
                }
                return false; // Producto no encontrado, se necesita agregar nueva fila
            }

            // Función para agregar la fila con el producto seleccionado en el modal
            function agregarFilaDesdeModal(productoId, productoNombre, precioCompra, precioVenta, cantidad, codigo) {
                const detalleProductos = document.getElementById('detalle-productos');
                const fila = document.createElement('tr');

                fila.innerHTML = `
                        <td class="text-center">
                            <input type="number" name="cantidades[]" class="form-control" value="${cantidad}" min="1" required oninput="calcularSubtotal(this)">
                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <input type="hidden" name="codigos[]" class="form-control" value="${codigo}" min="1" required readonly oninput="calcularSubtotal(this)">
                            ${codigo}
                        </td>
                        <td style="vertical-align: middle;">
                            <input type="hidden" name="productos[]" value="${productoId}">
                            ${productoNombre}
                        </td>
                        <td class="text-success bg-light fs-5">
                            <input style="text-align: right;" type="number" name="precios_compra[]" class="form-control" step="0.01" value="${precioCompra}" required oninput="calcularSubtotal(this)">
                        </td>
                        <td class="text-success bg-light fs-5">
                            <input style="text-align: right;" type="number" name="precios_venta[]" class="form-control" step="0.01" value="${precioVenta}" required>
                        </td>
                        <td class=" bg-light fs-5">
                            <input style="text-align: right;" type="number" name="subtotales[]" class="form-control" step="0.01" value="${(precioCompra * cantidad).toFixed(2)}" required readonly>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove(); calcularTotal()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;

                detalleProductos.appendChild(fila);
                calcularTotal(); // Recalcula el total de la compra
            }

            function calcularTotal() {
                let total = 0;

                // Accede a todos los campos "subtotales[]"
                let subtotales = document.querySelectorAll('input[name="subtotales[]"]');

                // Suma los valores de los subtotales
                subtotales.forEach(function(subtotalInput) {
                    total += parseFloat(subtotalInput.value) || 0;
                    console.log('Total:', total);
                });

                document.getElementById('total-compra').innerText = '$' + new Intl.NumberFormat('es-AR').format(total
                    .toFixed(
                        2));
                document.getElementById('total-compra2').value = new Intl.NumberFormat('es-AR', {
                    style: 'currency',
                    currency: 'ARS'
                }).format(total);


            }

            function actualizarPrecio(select) {
                const precioCompra = select.options[select.selectedIndex].getAttribute('data-precio-compra');
                const fila = select.closest('tr');
                const inputPrecio = fila.querySelector('input[name="preciosCompra[]"]');

                inputPrecio.value = parseFloat(precioCompra || 0).toFixed(2);
            }

            document.getElementById('detalle-productos').addEventListener('input', function(e) {
                if (e.target.matches('input[name="cantidades[]"], input[name="preciosCompra[]"]')) {
                    calcularSubtotal(e.target);
                }
            });

            // Ajusta la función que calcula el subtotal de la compra
            function calcularSubtotal(input) {
                let fila = input.closest('tr');
                let cantidad = fila.querySelector('input[name="cantidades[]"]').value || 0;
                let precio_compra = fila.querySelector('input[name="precios_compra[]"]').value || 0;
                let subtotal = parseFloat(cantidad) * parseFloat(precio_compra);

                fila.querySelector('input[name="subtotales[]"]').value = subtotal.toFixed(2);
                calcularTotal(); // Recalcula el total después de actualizar
            }
        </script>

     {{--    <script>
            $(document).ready(function() {
                $('#btnRegistrar').on('click', function(e) {
                    e.preventDefault(); // Evita que el formulario se envíe inmediatamente

                    // Mostrar la confirmación antes de continuar
                    Swal.fire({
                        title: '¿Deseas actualizar los precios de los productos?',
                        text: "Esto actualizará los precios de compra y venta de los productos seleccionados.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'No, continuar sin cambios',
                    }).then((result) => {
                        let actualizarPreciosFlag = result.isConfirmed ? '1' : '0';
                        $('#actualizar_precios').val(
                        actualizarPreciosFlag); // Actualizar el valor del campo1

                        $('#form-compra').submit();
                    });
                });
            });
        </script> --}}


    @endsection
