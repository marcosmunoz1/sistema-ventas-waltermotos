<?php $__env->startSection('title', 'Bienvenido'); ?>

<?php $__env->startSection('auth_body'); ?>
    <div class="text-center p-5">
        <h1 class="mb-4" style="font-size: 2.4rem; font-weight: bold; color: #007BFF;">
            ¡Bienvenido a <span style="color: #0056b3;">WalterMOTOS</span>!
        </h1>
        <p class="mb-5" style="color: #555; font-size: 1.2rem;">
            Necesitas iniciar sesión para acceder a todas las funcionalidades del sistema.
        </p>
        <a href="<?php echo e(url('/login')); ?>" class="btn btn-primary btn-lg shadow-sm px-5 py-3">
            <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth_footer'); ?>
    <div class="text-center" style="color: #777; font-size: 0.9rem;">
        &copy; <?php echo e(date('Y')); ?> WalterMOTOS. Todos los derechos reservados.
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .auth-page {
            background: linear-gradient(135deg, #007BFF, #00C6FF);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* 🔹 AdminLTE usa .login-box, no .auth-box */
        .login-box {
             width: 90% !important;
            width: 800px !important;   /* más ancha */
            min-height: 500px !important; /* más alta */
        }

        .login-box .card {
            border-radius: 16px !important;
            box-shadow: 0px 8px 24px rgba(0,0,0,0.25) !important;
            height: 80% !important;
        }

        h1 {
            line-height: 1.4;
        }
        @media (max-width: 576px) {
            .login-box {
                min-height: 400px !important; /* más bajo en mobile */
                padding: 20px !important;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::auth.auth-page', ['authType' => 'login'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views\welcome.blade.php ENDPATH**/ ?>