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
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <a href="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-end mr-3">Add Employee</a>
                </nav> 
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="card shadow">
    <div class="card-header">
        <span classs="float-left">List of all Employees</span>
        <select id="departmentFilter" class="form-select form-select-sm float-end" style="width: 200px; margin-left: 10px;">
            <option value="">All Departments</option>
        </select>
        <select id="statusFilter" class="form-select form-select-sm float-end" style="width: 200px; margin-left: 10px;">
            <option value="">All Status</option>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
        </select>
        <input type="text" class="form-control form-control-sm float-end" id="searchBar" placeholder="Search employees..." style="width: 100%; margin-top: 10px;"/>
    </div>
    <div class="card-body"> 
        <div class="table-responsive" id="tableContainer" style="max-height: 400px; overflow-y: auto; position: relative;">  
            <table class="table table-bordered table-hover nowrap" id="employeesTable" style="width:100%; white-space: nowrap;">
                <thead>
                    <tr style="color: rgb(77, 148, 255);">
                        <th>Count</th>
                        <th>First Name</th>
                        <th>Middle Name</th>                                
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Date Of Birth</th>
                        <th>Status</th>
                        <th>Place Of Birth</th>
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
