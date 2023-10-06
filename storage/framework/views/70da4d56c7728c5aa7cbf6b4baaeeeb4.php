<?php

    $url_segment = Request::segment(1);

    $menu_items = array(
        'customer'  => '',
        'job-order' => '',
        'payment'   => '',
        'employee'  => '',
        'payroll'   => '',
        'branch'    => '',
        'user'      => ''
    );

    foreach( $menu_items as $key => $item ) {
        if( strpos($url_segment, $key) > -1 ) {
            $menu_items[$key] = ' active ';
        }
    }

?>

<div class="main-menu material-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="company-logo">        
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">              
            <li class="navigation-header"><span data-i18n="Admin Panels">Main Menu</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Admin Panels">more_horiz</i></li>                          
            <li class="nav-item <?php echo e($menu_items['customer']); ?>"><a href="<?php echo e(route('customer.index')); ?>"><i class="material-symbols-rounded">group</i><span class="menu-title" data-i18n="Hospital">Customers</span></a>
            <li class="nav-item <?php echo e($menu_items['job-order']); ?>"><a href="#"><i class="material-symbols-rounded">work_history</i><span class="menu-title" data-i18n="Project">Job Orders</span></a>
                <ul class="menu-content">
                    <li><a href="<?php echo e(route('job-order.index')); ?>"><span data-i18n="All Job Orders">All Orders</span></a></li>
                    <li><a href="<?php echo e(route('job-order.create')); ?>"><span data-i18n="Create New Order">Create New Order</span></a></li>
                    <li><a href="<?php echo e(route('category.index')); ?>"><span data-i18n="Item Categories">Item Categories</span></a></li>   
                </ul>
            </li>
            <li class="nav-item <?php echo e($menu_items['payment']); ?>"><a href="<?php echo e(route('payment.index')); ?>"><i class="material-symbols-rounded">payments</i><span class="menu-title" data-i18n="Hospital">Payments</span></a>
            <li class="nav-item <?php echo e($menu_items['employee']); ?>"><a href="<?php echo e(route('employee.index')); ?>"><i class="material-symbols-rounded">engineering</i><span class="menu-title" data-i18n="Hospital">Employees</span></a>
            <li class="nav-item <?php echo e($menu_items['payroll']); ?>"><a href="<?php echo e(route('payroll.index')); ?>"><i class="material-symbols-rounded">receipt_long</i><span class="menu-title" data-i18n="Hospital">Payroll</span></a>
            <li class="nav-item <?php echo e($menu_items['branch']); ?>"><a href="<?php echo e(route('branch.index')); ?>"><i class="material-symbols-rounded">store</i><span class="menu-title" data-i18n="Hospital">Branches</span></a>                        
            <li class="nav-item <?php echo e($menu_items['user']); ?>"><a href="<?php echo e(route('user.index')); ?>"><i class="material-symbols-rounded">admin_panel_settings</i><span class="menu-title" data-i18n="Hospital">Users</span></a>
        </li>
        </ul>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Club-Payment-System\resources\views/layouts/menu.blade.php ENDPATH**/ ?>