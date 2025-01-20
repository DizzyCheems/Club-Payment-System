<?php $__env->startSection('content'); ?>

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Create User</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="<?php echo e(route ('user.post.user')); ?>" method="POST" novalidate>
                        <?php echo csrf_field(); ?>
                        
                    <div>
	                   <?php if(Session::has('success')): ?>
                             <div class="alert alert-success">
                                <?php echo e(Session::get('success')); ?> 
                             </div>
                      <?php endif; ?>
                   </div>
                        <div class="form-body">
                            <div class="form-group">
                             <h5>FullName<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control mb-1" required data-validation-required-message="• This field is required">
                                </div>
                         </div>

                         <div class="form-group">
                            <h5> Course <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="course_id" id="lang" class="form-control" required class="form-control mb-1">
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($course->id); ?>"><?php echo e($course->course_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select> 
                                </div>  
                        </div>
                         
                         <div class="form-group">
                             <h5>Email<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="email" name="email" class="form-control mb-1" required data-validation-required-message="• This field is required">
                                    <?php if($errors->has('email')): ?>
                                          <div class="text-danger"><?php echo e($errors->first('email')); ?></div>
                                    <?php endif; ?>
                                </div>
                         </div>

                         <div class="form-group">
                          <h5> Role <span class="required"></span></h5>
                                <div class="controls">
                                <select name="role" id="lang" class="form-control" required class="form-control mb-1">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                  </select> 
                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Password<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password" id="input-password" class="form-control mb-1" >
                                </div>
                         </div>
                               
                         <div class="form-group">
                             <h5>Confirm Password<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" id="input-confirm" class="form-control mb-1" data-validation-match-match="password" >
                                </div>
                         </div>

                         <div class="form-group">
                             <h5>School ID Number<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="id_num" class="form-control mb-1" required data-validation-required-message="• This field is required">

                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Contact / Social Media<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="social_acc" class="form-control mb-1" required data-validation-required-message="• This field is required">

                                </div>
                         </div>

                         
                         <div class="form-group">
                             <h5>G Cash Number<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="payment_acc" class="form-control mb-1" required data-validation-required-message="• This field is required">

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


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Club-Payment-System\resources\views/users/create.blade.php ENDPATH**/ ?>