<?php $__env->startSection('css'); ?>
    <!-- Internal Data table css -->
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(URL::asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="<?php echo e(URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')); ?>" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="<?php echo e(URL::asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet">

    <?php $__env->startSection('title'); ?>
        تقرير الفواتير - Invoices Report
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تقرير
                الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">


                <div class="card-header pb-0">

                    <form action="<?php echo e(route('Search_invoices')); ?>" method="POST" role="search" autocomplete="off">
                        <?php echo e(csrf_field()); ?>



                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input checked name="rdio" type="radio" value="1" id="type_div"> <span>بحث بنوع
                                الفاتورة</span></label>
                        </div>


                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input name="rdio" value="2" type="radio">
                                <span>بحث برقم الفاتورة</span>
                            </label>
                        </div>
                        <br><br>

                        <div class="row">

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">تحديد نوع الفواتير</p>
                                <select class="form-control select" name="type" required>
                                    <option value="
                                        <?php if(isset( $type)): ?>
                                            $type
                                            <?php else: ?>
                                           '' <?php endif; ?> " selected>

                                        <?php if(isset( $type)): ?>
                                            كل الفواتير
                                        <?php else: ?>
                                            حدد نوع الفواتير
                                        <?php endif; ?>
                                    </option>
                                    <option value="1">كل الفواتير</option>
                                    <option value="مدفوعة">الفواتير المدفوعة</option>
                                    <option value="غير مدفوعة">الفواتير الغير مدفوعة</option>
                                    <option value="مدفوعة جزئيا">الفواتير المدفوعة جزئيا</option>

                                </select>
                            </div><!-- col-4 -->


                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                <p class="mg-b-10">البحث برقم الفاتورة</p>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">من تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" value="<?php echo e($start_at ?? ''); ?>"
                                                 name="start_at" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">الي تاريخ</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" name="end_at"
                                                 value="<?php echo e($end_at ?? ''); ?>" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-1">
                                <button class="btn btn-primary btn-block">بحث</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body col-xl-12">
                    <div class="table-responsive">
                        <?php if(isset($details)): ?>
                            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">القسم</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحظات</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i++; ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($invoice->invoice_number); ?> </td>
                                        <td><?php echo e($invoice->invoice_Date); ?></td>
                                        <td><?php echo e($invoice->Due_date); ?></td>
                                        <td><?php echo e($invoice->product); ?></td>
                                        <td><a
                                                href="<?php echo e(url('InvoicesDetails')); ?>/<?php echo e($invoice->id); ?>"><?php echo e($invoice->section->section_name); ?></a>
                                        </td>
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
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        <?php endif; ?>
                    </div>
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
    <!-- Internal Data tables -->
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

    <!--Internal  Datepicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')); ?>"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')); ?>"></script>
    <!-- Internal Select2.min js -->
    <script src="<?php echo e(URL::asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="<?php echo e(URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')); ?>"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')); ?>"></script>
    <!-- Ionicons js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')); ?>"></script>
    <!--Internal  pickerjs js -->
    <script src="<?php echo e(URL::asset('assets/plugins/pickerjs/picker.min.js')); ?>"></script>
    <!-- Internal form-elements js -->
    <script src="<?php echo e(URL::asset('assets/js/form-elements.js')); ?>"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {

            $('#invoice_number').hide();

            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#type').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#type').hide();
                    $('#start_at').hide();
                    $('#end_at').hide();
                }
            });
        });

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inovices_proj\resources\views/reports/invoices_report.blade.php ENDPATH**/ ?>