//ac{a} hagan sus scrips, no sean desordenados ;)

$(document).ready(function () {
$('#crearRolModal').on('hidden.bs.modal', function () {
  $(this).find('form')[0].reset();
   $('#id').val('0'); });
});

function abrir_modal(modal, title, accion, campos, dato)
{
    $(`#${modal}`).modal('show');
    $(`#${modal}_titulo`).text(title);
    document.getElementById("accion").value=accion;
    if(campos.length>=1)
    {
      campos.forEach(
        (campo) => {
          document.getElementById(campo).value=dato[campo];
        }
        );
        document.getElementById("id").value=dato['id'];
    }else
    {
      document.form.reset();
    }
}

window.onload = function() {
    muestraReloj();

};
