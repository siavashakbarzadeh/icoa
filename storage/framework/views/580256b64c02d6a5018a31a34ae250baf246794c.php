<?php
   // $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Resells')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Resell')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('resell.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import resell CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('resell.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="lg" data-url="<?php echo e(route('resell.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Customer')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>

                                <th> <?php echo e(__('billing_acount_name')); ?></th>
                                <th> <?php echo e(__('billing_acount_id')); ?></th>
                                <th> <?php echo e(__('project_name')); ?></th>
                                <th> <?php echo e(__('project_id')); ?></th>
                                <th> <?php echo e(__('project_hierarchy')); ?></th>
                                <th><?php echo e(__('Service_description')); ?></th>
                                <th><?php echo e(__('Service_ID')); ?></th>
                                <th><?php echo e(__('SKU_ID')); ?></th>
                                <th><?php echo e(__('Credit_type')); ?></th>
                                <th><?php echo e(__('Cost_type')); ?></th>
                                <th><?php echo e(__('Usage_start_date')); ?></th>
                                <th><?php echo e(__('Usage_end_date')); ?></th>
                                <th><?php echo e(__('Usage_amount')); ?></th>
                                <th><?php echo e(__('Usage_unit')); ?></th>
                                <th><?php echo e(__('Unrounded_cost')); ?></th>
                                <th><?php echo e(__('Cost')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $resells; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$resell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="cust_tr" id="cust_detail ">











                                    <td class="font-style"><?php echo e($resell['billing_acount_name']); ?></td>
                                    <td class="font-style"><?php echo e($resell['billing_acount_id']); ?></td>
                                    <td class="font-style"><?php echo e($resell['project_name']); ?></td>
                                    <td class="font-style"><?php echo e($resell['project_id']); ?></td>
                                    <td class="font-style"><?php echo e($resell['project_hierarchy']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Service_description']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Service_ID']); ?></td>
                                    <td class="font-style"><?php echo e($resell['SKU_ID']); ?></td>
                                    <td class="font-style">
                                    <?php if($resell['Credit_type']==="PROMOTION"): ?>
                                            Gettoni
                                        <?php else: ?>
                                        <?php echo e($resell['Credit_type']); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="font-style"><?php echo e($resell['Cost_type']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Usage_start_date']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Usage_end_date']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Usage_amount']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Usage_unit']); ?></td>
                                    <td class="font-style"><?php echo e($resell['Unrounded_cost']); ?></td>
                                    <td class="font-style"><?php echo e(number_format((float)$resell['Cost']*1.1, 2, '.', '')); ?></td>


































                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\siavash\Documents\GitHub\icoa\resources\views/resell/index.blade.php ENDPATH**/ ?>