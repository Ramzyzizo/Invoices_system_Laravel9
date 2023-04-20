<?php $__env->startSection('css'); ?>
    <!-- Internal Data table css -->
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="<?php echo e(URL::asset('assets/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    قائمة الفواتير المدفوعة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/الفواتير المدفوعة</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(session()->has('delete_invoice')): ?>
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    <?php endif; ?>
    <?php if(session()->has('Status_Update')): ?>
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }
        </script>
    <?php endif; ?>
				<!-- row -->

                    <div class="row row-sm">
                        <!--div-->
                        <div class="col-xl-13">
                            <div class="card mg-b-20">
                                <div class="card-body">
                                    <div class="">
                                        <table id="example" class="table  key-buttons text-md-nowrap">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">رقم الفاتوره</th>
                                                <th class="border-bottom-0">تاريخ الفاتوره</th>
                                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                                <th class="border-bottom-0">المتج</th>
                                                <th class="border-bottom-0">القسم</th>
                                                <th class="border-bottom-0">الخصم</th>
                                                <th class="border-bottom-0">نسبة الضريبة</th>
                                                <th class="border-bottom-0">قيمة الضريبة</th>
                                                <th class="border-bottom-0">الاجمالى</th>
                                                <th class="border-bottom-0">الحالة</th>
                                                <th class="border-bottom-0">الملاحظات</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>

                                            </thead>
                                            <tbody>
                                            <?php $i=0    ?>
                                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $i++  ?>
                                            <tr>
                                                <td><?php echo e($i); ?></td>
                                                <td><?php echo e($invoice->invoice_number); ?></td>
                                                <td><?php echo e($invoice->invoice_Date); ?></td>
                                                <td><?php echo e($invoice->Due_date); ?></td>
                                                <td><?php echo e($invoice->product); ?></td>
                                                <td>
                                                   <a href="<?php echo e(url('InvoicesDetails')); ?>/<?php echo e($invoice->id); ?>">
                                                        <?php echo e($invoice->section->section_name); ?></td>
                                                    </a>
                                                <td><?php echo e($invoice->Discount); ?></td>
                                                <td><?php echo e($invoice->Rate_VAT); ?></td>
                                                <td><?php echo e($invoice->Value_VAT); ?></td>
                                                <td><?php echo e($invoice->Total); ?></td>
                                                <td>
                                                    <?php if($invoice->status_id == 1): ?> 
                                                        <span class="text-success"><?php echo e($invoice->Status); ?></span>
                                                    <?php elseif($invoice->status_id == 2): ?> 
                                                        <span class="text-danger"><?php echo e($invoice->Status); ?></span>
                                                    <?php else: ?>
                                                        <span class="text-warning"><?php echo e($invoice->Status); ?></span>
                                                    <?php endif; ?>

                                                </td>
                                                <td><?php echo e($invoice->note); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true"
                                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                        <div class="dropdown-menu tx-13">
                                                                <a class="dropdown-item"
                                                                   href="#" data-invoice_id="<?php echo e($invoice->id); ?>"
                                                                   data-toggle="modal" data-target="#delete_invoice"><i
                                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                    الفاتورة</a>

                                                                <a class="dropdown-item"
                                                                   href="<?php echo e(URL::route('invoices.show', [$invoice->id])); ?>"><i
                                                                        class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير حالة الدفع</a>









                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/div-->
                        <!-- حذف الفاتورة -->
                        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <form action="<?php echo e(route('invoices.destroy', 'test')); ?>" method="post">
                                        <?php echo e(method_field('delete')); ?>

                                        <?php echo e(csrf_field()); ?>

                                    </div>
                                    <div class="modal-body">
                                        هل انت متاكد من عملية الحذف ؟
                                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')); ?>"></script>
    <!--Internal  Datatable js -->
    <script src="<?php echo e(URL::asset('assets/js/table-data.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifIt.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifit-custom.js')); ?>"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inovices_proj\resources\views/invoices/paid.blade.php ENDPATH**/ ?>