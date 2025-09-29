<aside class="main-sidebar <?php echo e(config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')); ?>">

    
    <?php if(config('adminlte.logo_img_xl')): ?>
        <?php echo $__env->make('adminlte::partials.common.brand-logo-xl', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make('adminlte::partials.common.brand-logo-xs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>

    
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column <?php echo e(config('adminlte.classes_sidebar_nav', '')); ?>"
                data-widget="treeview" role="menu"
                <?php if(config('adminlte.sidebar_nav_animation_speed') != 300): ?>
                    data-animation-speed="<?php echo e(config('adminlte.sidebar_nav_animation_speed')); ?>"
                <?php endif; ?>
                <?php if(!config('adminlte.sidebar_nav_accordion')): ?>
                    data-accordion="false"
                <?php endif; ?>>
                
                <?php echo $__env->renderEach('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item'); ?>
            </ul>
        </nav>
    </div>
     <li class="nav-item">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="margin: 0;">
            <?php echo csrf_field(); ?>
            <div class="logout-wrapper">
                <button type="submit" class="logout-button">
                    <i class="nav-icon fas fa-power-off text-danger"></i>
                    <span class="ml-2">Cerrar Sesión</span>
                </button>
            </div>
        </form>
     </li>




</aside>
<style>
.logout-wrapper {
    margin-left: 9px;
    margin-right: 9px;
    transition: transform 0.3s ease;
}

.logout-wrapper:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px; /* se extiende hacia la derecha */
}

.logout-button {
    display: flex;
    align-items: center;
    font-size: 17px;
    background-color: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.719);
    padding: 7px 15px;
    border-radius: 8px;
    width: 100%;
}

</style>
<?php /**PATH C:\xampp\htdocs\Pruebas-tp-final\resources\views/vendor/adminlte/partials/sidebar/left-sidebar.blade.php ENDPATH**/ ?>