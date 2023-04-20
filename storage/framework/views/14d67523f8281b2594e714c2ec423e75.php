
<?php $__env->startSection('css'); ?>
<!--- Internal Fontawesome css-->
<link href="<?php echo e(URL::asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
<!---Ionicons css-->
<link href="<?php echo e(URL::asset('assets/plugins/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">
<!---Internal Typicons css-->
<link href="<?php echo e(URL::asset('assets/plugins/typicons.font/typicons.css')); ?>" rel="stylesheet">
<!---Internal Feather css-->
<link href="<?php echo e(URL::asset('assets/plugins/feather/feather.css')); ?>" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="<?php echo e(URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="<?php echo e(URL::asset('assets/img/media/404.png')); ?>" class="error-page" alt="error">
			<h2>Oopps. The page you were looking for doesn't exist.</h2>
			<h6>You may have mistyped the address or the page may have moved.</h6><a class="btn btn-outline-danger" href="<?php echo e(url('/' . $page='index')); ?>">Back to Home</a>
		</div>
		<!-- /Main-error-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inovices_proj\resources\views/404.blade.php ENDPATH**/ ?>
