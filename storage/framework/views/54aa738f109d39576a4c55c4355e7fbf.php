<?php $__env->startSection('content'); ?>

<?php echo $__env->make('prob-notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php if($errors->any()): ?>
		<div class="alert alert-danger">
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php echo e($error); ?> <br>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endif; ?>

	<?php echo e(Form::model($prize, array('route' => array('prizes.update', $prize->id), 'method' => 'PUT'))); ?>


		<div class="mb-3">
			<?php echo e(Form::label('title', 'Title', ['class'=>'form-label'])); ?>

			<?php echo e(Form::text('title', null, array('class' => 'form-control'))); ?>

		</div>
		<div class="mb-3">
			<?php echo e(Form::label('probability', 'Probability', ['class'=>'form-label'])); ?>

			<?php echo e(Form::number('probability', null, array('class' => 'form-control','min' => '0','max' => '100', 'placeholder' => '0 - 100','step' => '0.01'))); ?>

		</div>

		<?php echo e(Form::submit('Edit', array('class' => 'btn btn-primary'))); ?>


	<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-interview-master\resources\views/prizes/edit.blade.php ENDPATH**/ ?>