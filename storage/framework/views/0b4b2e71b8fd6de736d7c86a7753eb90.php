<?php $__env->startSection('content'); ?>


    <?php echo $__env->make('prob-notice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-3">
                    <a href="<?php echo e(route('prizes.create')); ?>" class="btn btn-info">Create</a>
                </div>
                <h1>Prizes</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Probability</th>
                            <th>Awarded</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $prizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($prize->id); ?></td>
                                <td><?php echo e($prize->title); ?></td>
                                <td><?php echo e($prize->probability); ?></td>
                                <td> 
                                <?php if(!empty($percentageArray)): ?>  
                                <?php echo e($percentageArray[$prize->title]); ?>

                                <?php endif; ?>  </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo e(route('prizes.edit', [$prize->id])); ?>" class="btn btn-primary">Edit</a>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['prizes.destroy', $prize->id]]); ?>

                                        <?php echo Form::submit('Delete', ['class' => 'btn btn-danger']); ?>

                                        <?php echo Form::close(); ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Simulate</h3>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(['method' => 'POST', 'route' => ['simulate']]); ?>

                        <div class="form-group">
                            <?php echo Form::label('number_of_prizes', 'Number of Prizes'); ?>

                            <?php echo Form::number('number_of_prizes', $number_of_prizes, ['class' => 'form-control']); ?>

                        </div>
                        <?php echo Form::submit('Simulate', ['class' => 'btn btn-primary']); ?>

                        <?php echo Form::close(); ?>

                    </div>

                    <br>

                    <div class="card-body">
                        <?php echo Form::open(['method' => 'POST', 'route' => ['reset']]); ?>

                        <?php echo Form::submit('Reset', ['class' => 'btn btn-primary']); ?>

                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="container  mb-4">
        <div class="row">
            <div class="col-md-6">
                <h2>Probability Settings</h2>
                <canvas id="probabilityChart"></canvas>
                <div id="chart_div"></div>
            </div>
            <div class="col-md-6">
                <h2>Actual Rewards</h2>
                <canvas id="awardedChart"></canvas>
                <div id="actual_chart_div"></div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Product');
            data.addColumn('number', 'Probability');
            // Replace the sample data with the data from your controller
            var dynamicData = [
                <?php $__currentLoopData = $prizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    ['<?php echo e($prize->title); ?>', <?php echo e($prize->probability); ?>],
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];
            data.addRows(dynamicData);
            // Set chart options
            var options = {
                'title': '',
                'width': 800,
                'height': 600
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);
        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Product');
            data.addColumn('number', 'Probability');
            // Replace the sample data with the data from your controller
            var dynamicData = [
                <?php if(isset($percentageArray)): ?>
                    <?php $__currentLoopData = $percentageArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product => $percentage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        ['<?php echo e($product); ?>', <?php echo e($percentage); ?>],
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            ];
            data.addRows(dynamicData);
            // Set chart options
            var options = {
                'title': '',
                'width': 800,
                'height': 600
            };
            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('actual_chart_div'));
            chart.draw(data, options);
        }
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-interview-master\resources\views/prizes/index.blade.php ENDPATH**/ ?>