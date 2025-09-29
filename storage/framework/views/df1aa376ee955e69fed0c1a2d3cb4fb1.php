<?php $__env->startComponent('mail::message'); ?>
# 🔐 Restablecer tu contraseña

Hola **<?php echo e($user->name ?? 'usuario'); ?>**,

Recibimos una solicitud para restablecer la contraseña de tu cuenta en **WualterMOTOS**.
Haz clic en el botón para continuar:

<?php $__env->startComponent('mail::button', ['url' => $url]); ?>
Restablecer contraseña
<?php echo $__env->renderComponent(); ?>

> Si no solicitaste este cambio, simplemente ignora este correo.

Gracias por confiar en WalterMotos.

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\emails\reset-password.blade.php ENDPATH**/ ?>