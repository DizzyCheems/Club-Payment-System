
<?php $__env->startSection('content'); ?>
    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Edit User</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="<?php echo e(route('user.update', array('id' => $user->id))); ?>" method="POST" novalidate>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($user['id']); ?>">
                    <div>
	                   <?php if(Session::has('success')): ?>
                             <div class="alert alert-success">
                                <?php echo e(Session::get('success')); ?> 
                             </div>
                      <?php endif; ?>
                   </div>
                   
                         <div class="form-body">
                            <div class="form-group">
                             <h5>Name <span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control mb-1"  value="<?php echo e($user['name']); ?>">
                                </div>
                         </div>
                                                
                        <div class="form-group">
                          <h5> Email <span class="required"></span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control mb-1" value="<?php echo e($user['email']); ?>">
                                </div>
                         </div>

                         <div class="form-group">
                                    <h5>Role<span class="required"></span></h5>
                                    <div class="controls">
                                        <select name="role" id="lang" class="form-control" required class="form-control mb-1">
                                            <option value="USER" <?php echo e($user['role'] == 'USER' ? 'selected' : ''); ?>>User</option>
                                            <option value="ADMIN" <?php echo e($user['role'] == 'ADMIN' ? 'selected' : ''); ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                          <h5> Password <span class="required"></span></h5>
                                <div class="controls">
                                    <input type="password" id="input-password" name="password"  class="form-control mb-1" value="<?php echo e($user['password']); ?>">
                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Confirm Password<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" id="input-confirm" class="form-control mb-1"  data-validation-match-match="password" value="<?php echo e($user['password']); ?>">
                                </div>
                         </div>
                          
                            </div>
                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="<?php echo e(route('user.index')); ?>">
                                <i class="ft-x"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Save
                            </button>
                        </div>
                    </form>
						    </div><!--//app-card-footer-->
						</div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    

	    
    </div><!--//app-wrapper-->    	

 <!-- BEGIN: Page JS-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 <script src="<?php echo e(asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')); ?>"></script>
<!-- END: Page JS-->


<?php $__env->stopSection(); ?>
</html> 


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Club-Payment-System\resources\views/users/edit.blade.php ENDPATH**/ ?>