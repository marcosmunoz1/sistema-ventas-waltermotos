<script>
    function agregarMotoATabla() {

     // Verificar si ya hay una moto en la tabla
     const tablaBody = document.getElementById('tabla-motos-body');
     if (tablaBody && tablaBody.querySelectorAll('tr').length > 0) {
         alert('Solo puedes tener una moto a la vez. Limpia la tabla primero.');
         return;
     }

    // Primero validar campos
     if (!validarCampos()) {
         // Mostrar primer error si la validación falla
         const primerError = document.querySelector('.is-invalid, .campo-invalido');
         if (primerError) {
             primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
         }
         return; // Detener la ejecución si la validación falla
     }

     if (!tablaBody) {
             console.error('Error: No se encontró el elemento #tabla-motos-body');
             alert('Error interno. Recarga la página e intenta nuevamente.');
             return;
         }



     // Obtener valores (corregido para checkbox)



         let contador = 1;
         let id_marca = document.getElementById('id_marca').value;
         let modelo_moto = document.getElementById('modelo_moto').value;
         let dominio = document.getElementById('dominio').value;
         let cilindrada_moto = document.getElementById('cilindrada_moto').value;
         let km_moto = document.getElementById('km_moto').value;
         let es_usada = document.getElementById('es_usada').checked ? '1' : '0';
         let dnrpa = document.getElementById('dnrpa').value;
         let nr_certificado = document.getElementById('nr_certificado').value;
         let precio_venta = parseFloat(document.getElementById('precio_venta').value);
         let id_deposito = document.getElementById('id_deposito').value;
         let color_moto = document.getElementById('color_moto').value;
         let anio_moto =   document.getElementById('anio_moto').value;
         let id_nacionalidad =   document.getElementById('id_nacionalidad').value;
         let nr_motor =   document.getElementById('nr_motor').value;
         let nr_chasis =   document.getElementById('nr_chasis').value;
         let precio_compra = parseFloat(document.getElementById('precio_compra').value);
         actualizarVariable(precio_compra);
        // Manejo CORRECTO de la imagen
         const imagenInput = document.getElementById('imagen_moto');
         let imagenNombre = 'sin_imagen.jpg';
         let imagenURL = 'ruta/a/imagen_por_defecto.jpg';

         if (imagenInput.files && imagenInput.files[0]) {
             imagenNombre = imagenInput.files[0].name;
             imagenURL = URL.createObjectURL(imagenInput.files[0]);
         }



          // 1. Crear fila
         const fila = document.createElement('tr');
         fila.innerHTML = `
                 <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="contador[]" class="form-control" value="${contador}" min="1" required readonly>
                     <input type="hidden" name="dominio[]" class="form-control" value="${dominio}" min="1" required readonly>
                     <input type="hidden" name="cilindrada_moto[]" class="form-control" value="${cilindrada_moto}" min="1" required readonly>
                     <input type="hidden" name="km_moto[]" class="form-control" value="${km_moto}" min="1" required readonly>
                     <input type="hidden" name="es_usada[]" class="form-control" value="${es_usada}" min="1" required readonly>
                     <input type="hidden" name="dnrpa[]" class="form-control" value="${dnrpa}" min="1" required readonly>
                     <input type="hidden" name="nr_certificado[]" class="form-control" value="${nr_certificado}" min="1" required readonly>
                     <input type="hidden" name="precio_venta[]" class="form-control" value="${precio_venta}" min="1" required readonly>
                     <input type="hidden" name="id_deposito[]" class="form-control" value="${id_deposito}" min="1" required readonly>
                     <input type="hidden" name="precio_compra[]" class="form-control" value="${precio_compra}" min="1" required readonly>
                     ${contador}
                 </td>
                 <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="id_marca[]" class="form-control" value="${id_marca}" min="1" required readonly>
                     ${id_marca}
                 </td>
                  <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="modelo_moto[]" class="form-control" value="${modelo_moto}" min="1" required readonly>
                     ${modelo_moto}
                 </td>
                  <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="color_moto[]" class="form-control" value="${color_moto}" min="1" required readonly >
                     ${color_moto}
                 </td>
                  <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="anio_moto[]" class="form-control" value="${anio_moto}" min="1" required readonly >
                     ${anio_moto}
                 </td>
                  <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="id_nacionalidad[]" class="form-control" value="${id_nacionalidad}" min="1" required readonly >
                     ${id_nacionalidad}
                 </td>
                 <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="nr_motor[]" class="form-control" value="${nr_motor}" min="1" required readonly >
                     ${nr_motor}
                 </td>
                  <td class="text-center" style="vertical-align: middle;">
                     <input type="hidden" name="nr_chasis[]" class="form-control" value="${nr_chasis}" min="1" required readonly >
                     ${nr_chasis}
                 </td>
                 <td class="text-center" style="vertical-align: middle;">
                    <input type="hidden" name="imagen_moto[]" value="${imagenNombre}">
                      <img src="${imagenURL}" width="50" class="img-thumbnail">
                 </td>
                 <td class="text-center" style="vertical-align: middle;">
                    <button type="button" class="btn btn-primary btn-sm" onclick="editarMoto(this)">
                         <i class="fas fa-edit"></i> Editar
                     </button>
                     <button type="button" class="btn btn-danger btn-sm" onclick="limpiarTabla()">
                         <i class="fas fa-trash"></i>
                     </button>
                 </td>
         `;

           // 4. Agregar fila
          tablaBody.appendChild(fila);

         // 2. Agregar DIRECTAMENTE al formulario (no solo a la tabla)
         const form = document.getElementById('formulario-compra');



         // 3. Resetear solo los campos del modal (no el formulario completo)
      /*    $('#modalMoto').find('input').not('[type="hidden"]').val(''); */
         $('#crearMotoModal').find('input').not('[type="hidden"]').val('');
         $('#crearMotoModal').find('select').val('');
         document.getElementById('es_usada').checked = false;

         $('#crearMotoModal').modal('hide'); // Cierra correctamente el modal

         actualizarEstadoBotonAgregar();

         return true;
     }
</script>
