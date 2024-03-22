<?php

use App\Models\Prize;

$current_probability = floatval(Prize::sum('probability'));
$remaining_probability = 100 - $current_probability;
?>


<?php if(Session::has('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(Session::get('error')); ?>

    </div>
<?php endif; ?>


<?php if(Session::has('success')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>


<div>
    <p>Remaining Probability: <?php echo e($remaining_probability); ?>%</p>
    <p>Total Probability Utilized: <?php echo e($current_probability); ?>%</p>
</div><?php /**PATH C:\xampp\htdocs\laravel-interview-master\resources\views/prob-notice.blade.php ENDPATH**/ ?>