<?php $__env->startSection('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">User</h1>
                </div>

                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input type="text" style="width:400px;" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit"  class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-auto">
                                    <select class="form-select w-auto" id="elements-select">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>
                                </div>

                            <div class="col-md-auto">
                                <a class="btn app-btn-secondary" href="#">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    Download CSV
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <!--Tab Selections -->
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true" onclick="filterRows('all')">All</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-admin-tab" data-bs-toggle="tab" href="#orders-admin" role="tab" aria-controls="orders-admin" aria-selected="false" onclick="filterRows('admin')">Admin</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-user-tab" data-bs-toggle="tab" href="#orders-user" role="tab" aria-controls="orders-user" aria-selected="false" onclick="filterRows('user')">User</a>
            </nav>
            <!--END Tab Selections -->

            <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="userTable">
                            <thead>
                                <tr>
                                    <th class="cell">Name</th>
                                    <th class="cell">E-mail</th>
                                    <th class="cell">Role</th>
                                    <th class="cell">Date</th>
                                    <th class="cell">Action</th>
                                </tr>
                                    </thead>
                                    <tbody>
            
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr data-role="<?php echo e($user->role); ?>">
                                            <td class="cell"><?php echo e($user->name); ?></td>
                                            <td class="cell"><span class="truncate"><?php echo e($user->email); ?></span></td>
                                            <?php if($user->role == "ADMIN"): ?>
                                                <td class="cell"><span class="badge bg-danger"><?php echo e($user->role); ?></span></td>
                                            <?php else: ?>
                                                <td class="cell"><span class="badge bg-success"><?php echo e($user->role); ?></span></td>
                                            <?php endif; ?>
                                            <td class="cell">
                                                <span><?php echo e(date('j M', strtotime($user->created_at))); ?></span>
                                                <span class="note"><?php echo e(date('g:i A', strtotime($user->created_at))); ?></span>
                                            </td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="<?php echo e(route('user.view', array('id' => $user->id))); ?>">View</a></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="orders-admin" role="tabpanel" aria-labelledby="orders-admin-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="adminTable">
                                    <thead>
                                        <tr>
                                            <th class="cell">Name</th>
                                            <th class="cell">E-mail</th>
                                            <th class="cell">Role</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($user->role == "ADMIN"): ?>
                                        <tr data-role="<?php echo e($user->role); ?>">
                                            <td class="cell"><?php echo e($user->name); ?></td>
                                            <td class="cell"><span class="truncate"><?php echo e($user->email); ?></span></td>
                                            <td class="cell"><span class="badge bg-danger"><?php echo e($user->role); ?></span></td>
                                            <td class="cell">
                                                <span><?php echo e(date('j M', strtotime($user->created_at))); ?></span>
                                                <span class="note"><?php echo e(date('g:i A', strtotime($user->created_at))); ?></span>
                                            </td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="<?php echo e(route('user.view', array('id' => $user->id))); ?>">View</a></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="orders-user" role="tabpanel" aria-labelledby="orders-user-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left" id="userTable">
                                    <thead>
                                        <tr>
                                            <th class="cell">Name</th>
                                            <th class= "cell">E-mail</th>
                                            <th class="cell">Role</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($user->role == "USER"): ?>
                                        <tr data-role="<?php echo e($user->role); ?>">
                                            <td class="cell"><?php echo e($user->name); ?></td>
                                            <td class="cell"><span class="truncate"><?php echo e($user->email); ?></span></td>
                                            <td class="cell"><span class="badge bg-success"><?php echo e($user->role); ?></span></td>
                                            <td class="cell">
                                                <span><?php echo e(date('j M', strtotime($user->created_at))); ?></span>
                                                <span class="note"><?php echo e(date('g:i A', strtotime($user->created_at))); ?></span>
                                            </td>
                                            <td class="cell"><a class="btn-sm app-btn-secondary" href="<?php echo e(route('user.view', array('id' => $user->id))); ?>">View</a></td>
                                        </tr>
                                        <?php endif; ?>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to filter rows based on the selected filter
    function filterRows(filter) {
        const rows = document.querySelectorAll('tr[data-role]');
        rows.forEach((row) => {
            const role = row.getAttribute('data-role');
            if (filter === 'all' || role === filter || filter === 'admin' || role === filter || filter === 'user' || role === filter) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listener for the filter select
    const filterSelect = document.getElementById('filter-select');
    filterSelect.addEventListener('change', (event) => {
        filterRows(event.target.value);
    });

    // Event listener for the search form
    const searchInput = document.getElementById('search-orders');
    const userTable = document.getElementById('userTable');
    const adminTable = document.getElementById('adminTable');

    searchInput.addEventListener('input', () => {
        const searchValue = searchInput.value.toLowerCase();

        // Function to filter rows based on search input
        function filterSearch(table) {
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach((row) => {
                const name = row.querySelector('.cell:first-child').textContent.toLowerCase();
                if (name.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        filterSearch(userTable);
        filterSearch(adminTable);
    });
</script>


<script>
    const elementsSelect = document.getElementById('elements-select');
    const table = document.getElementById('userTable'); // Replace 'userTable' with the actual table ID

    elementsSelect.addEventListener('change', function () {
        const selectedValue = elementsSelect.value;
        const rows = table.querySelectorAll('tbody tr');

        // Show or hide rows based on the selected value
        rows.forEach((row, index) => {
            if (index < selectedValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>



<!-- BEGIN: Page JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')); ?>"></script>
<!-- END: Page JS-->

<script>
    // delete Branch ajax request
    $(document).on('click', '.dropdown-user-delete', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '<?php echo e(csrf_token()); ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo e(route('user/destroy')); ?>',
                    method: 'get',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        location.replace('<?php echo e(route('user.index')); ?>');
                    }
                });
            }
        })
    });
</script>




<!-- Javascript -->          
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script> 
<script src="assets/js/index-charts.js"></script> 

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script> 

<?php $__env->stopSection(); ?>
</html>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Club-Payment-System\resources\views/users/list.blade.php ENDPATH**/ ?>