<?php $__env->startSection('css'); ?>
    <!-- Internal Data table css -->
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    تفاصيل الفاتوره
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصيل الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ فاتوره رقم <?php echo e($invoice->invoice_number); ?></span>
            </div>
        </div>

    </div>

    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="col-xl-12">
        <!-- div -->
        <div class="card mg-b-20" id="tabs-style2">
            <div class="card-body">
                <div class="main-content-label mg-b-5">
                    <?php if(session()->has('delete')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo e(session()->get('delete')); ?></strong>
                            <button type="button" class="close float-left" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if(session()->has('Add')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo e(session()->get('Add')); ?></strong>
                            <button type="button" class="close float-left" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab4" class="nav-link active" data-toggle="tab">تفاصيل الفاتورو</a></li>
                                        <li><a href="#tab5" class="nav-link" data-toggle="tab">معاملات الفاتورة</a></li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                    </ul>
                                </div>
                            </div>


                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    
                                    <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">
                                                <table class="table table-striped" style= "text-align:center">
                                                    <tbody>

                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td><a href="<?php echo e(url('invoices')); ?>/<?php echo e($invoice->id); ?>/edit"> <?php echo e($invoice->invoice_number); ?> </a></td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td><?php echo e($invoice->invoice_Date); ?></td>
                                                        <th scope="row">تاريخ الاستحقاق</th>
                                                        <td><?php echo e($invoice->Due_date); ?></td>
                                                        <th scope="row">القسم</th>
                                                        <td><?php echo e($invoice->section->section_name); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td><?php echo e($invoice->product); ?></td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td><?php echo e($invoice->Amount_collection); ?></td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td><?php echo e($invoice->Amount_Commission); ?></td>
                                                        <th scope="row">الخصم</th>
                                                        <td><?php echo e($invoice->Discount); ?></td>
                                                    </tr>


                                                    <tr>
                                                        <th scope="row">نسبة الضريبة</th>
                                                        <td><?php echo e($invoice->Rate_VAT); ?></td>
                                                        <th scope="row">قيمة الضريبة</th>
                                                        <td><?php echo e($invoice->Value_VAT); ?></td>
                                                        <th scope="row">الاجمالي مع الضريبة</th>
                                                        <td><?php echo e($invoice->Total); ?></td>
                                                        <th scope="row">الحالة الحالية</th>

                                                        <?php if($invoice->status_id == 1): ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-success"><?php echo e($invoice->Status); ?></span>
                                                            </td>
                                                        <?php elseif($invoice->status_id ==2): ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-danger"><?php echo e($invoice->Status); ?></span>
                                                            </td>
                                                        <?php else: ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-warning"><?php echo e($invoice->Status); ?></span>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">ملاحظات</th>
                                                        <td><?php echo e($invoice->note); ?></td>
                                                    </tr>
                                                    </tbody>

                                                </table>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab5">
                                        <div class="table-responsive mt-15">
                                            <table class="table center-aligned-table mb-0 table-hover"
                                                   style="text-align:center">
                                                <thead>
                                                <tr class="text-dark">
                                                    <th>#</th>
                                                    <th>رقم الفاتورة</th>
                                                    <th>نوع المنتج</th>
                                                    <th>القسم</th>
                                                    <th>حالة الدفع</th>
                                                    <th>تاريخ الدفع </th>
                                                    <th>ملاحظات</th>
                                                    <th>تاريخ الاضافة </th>
                                                    <th>المستخدم</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 0; ?>
                                                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <td><?php echo e($i); ?></td>
                                                        <td><?php echo e($x->invoice_number); ?></td>
                                                        <td><?php echo e($x->product); ?></td>
                                                        <td><?php echo e($invoice->section->section_name); ?></td>
                                                        <?php if($x->status_id == 1): ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-success"><?php echo e($x->Status); ?></span>
                                                            </td>
                                                        <?php elseif($x->status_id ==2): ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-danger"><?php echo e($x->Status); ?></span>
                                                            </td>
                                                        <?php else: ?>
                                                            <td><span
                                                                    class="badge badge-pill badge-warning"><?php echo e($x->Status); ?></span>
                                                            </td>
                                                        <?php endif; ?>
                                                        <td><?php echo e($x->Payment_Date); ?></td>
                                                        <td><?php echo e($x->note); ?></td>
                                                        <td><?php echo e($x->created_at); ?></td>
                                                        <td><?php echo e($x->user_name->name); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab6">
                                        <!--المرفقات-->
                                        <div class="card card-statistics">
                                            <div class="card-body">
                                                <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                <h5 class="card-title">اضافة مرفقات</h5>
                                                <form method="post" action="<?php echo e(url('/InvoiceAttachments')); ?>" enctype="multipart/form-data">
                                                    <?php echo e(csrf_field()); ?>

                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                               name="file" required>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                               value="<?php echo e($invoice->invoice_number); ?>">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                               value="<?php echo e($invoice->id); ?>">
                                                        <label class="custom-file-label" for="customFile">حدد
                                                            المرفق</label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary btn-sm "
                                                            name="uploadedFile">تاكيد</button>
                                                </form>
                                            </div>
                                            <br>

                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table table-hover"
                                                       style="text-align:center">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th scope="col">م</th>
                                                        <th scope="col">اسم الملف</th>
                                                        <th scope="col">قام بالاضافة</th>
                                                        <th scope="col">تاريخ الاضافة</th>
                                                        <th scope="col">العمليات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                    <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $i++; ?>
                                                        <tr>
                                                            <td><?php echo e($i); ?></td>
                                                            <td><?php echo e($attachment->file_name); ?></td>
                                                            <td><?php echo e($attachment->user_name->name); ?></td>
                                                            <td><?php echo e($attachment->created_at); ?></td>
                                                            <td colspan="2">

                                                                <a class="btn btn-outline-success btn-sm" target=”_blank”
                                                                   href="<?php echo e(url('View_file')); ?>/<?php echo e($invoice->invoice_number); ?>/<?php echo e($attachment->file_name); ?>"
                                                                   role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                   href="<?php echo e(url('download')); ?>/<?php echo e($invoice->invoice_number); ?>/<?php echo e($attachment->file_name); ?>"
                                                                   role="button"><i
                                                                        class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>


                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="<?php echo e($attachment->file_name); ?>"
                                                                            data-invoice_number="<?php echo e($attachment->invoice_number); ?>"
                                                                            data-id_file="<?php echo e($attachment->id); ?>"
                                                                            data-target="#delete_file">حذف</button>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('delete_file')); ?>" method="GET">

                                        <?php echo e(csrf_field()); ?>

                                        <div class="modal-body">
                                            <p class="text-center">
                                            <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                                            </p>

                                            <input type="hidden" name="id_file" id="id_file" value="">
                                            <input type="hidden" name="file_name" id="file_name" value="">
                                            <input type="hidden" name="invoice_number" id="invoice_number" value="">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                                            <button type="submit" class="btn btn-danger">تاكيد</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>




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
                            <script>
                                $('#delete_file').on('show.bs.modal', function(event) {
                                    var button = $(event.relatedTarget)
                                    var id_file = button.data('id_file')
                                    var file_name = button.data('file_name')
                                    var invoice_number = button.data('invoice_number')
                                    var modal = $(this)
                                    modal.find('.modal-body #id_file').val(id_file);
                                    modal.find('.modal-body #file_name').val(file_name);
                                    modal.find('.modal-body #invoice_number').val(invoice_number);
                                })
                            </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inovices_proj\resources\views/invoices/details_invoices.blade.php ENDPATH**/ ?>