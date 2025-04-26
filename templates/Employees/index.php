<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Employee> $employees
 */
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Employee List</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
    <div class="card-header">
        List of all Employee
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
            <table class="table table-bordered table-hover nowrap" id="employeesTable" style="width:100%">
                <thead>
                    <tr style="color: rgb(77, 148, 255);">
                        <th>Id</th>
                        <th>Box</th>
                        <th>First Name</th>
                        <th>Middle Name</th>                                
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Date Of Birth</th>
                        <th>Status</th>
                        <th>Place Of Birth</th>
                        <th>Qr Code Local Path</th>
                        <th>Created</th>
                        <th>Modified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

</section>
<script>
    var employees = <?= json_encode($employees) ?>;
</script>
<?= $this->Html->script('employee.js')?>
