<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Department> $departments
 */
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Department List</h3>
                <p class="text-subtitle text-muted">For user to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><?= $this->Html->link('Employees', ['controller' => 'Employees', 'action' => 'index']) ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $this->Html->link('List', ['controller' => 'Employees', 'action' => 'index']) ?></li>
                    </ol>
                </nav> 
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="card shadow">
    <div class="card-header">
        <span classs="float-left">List of all Departments</span>
        <a href="<?= $this->Url->build(['controller' => 'Departments', 'action' => 'add']) ?>" class="btn btn-primary btn-sm float-end mr-3">Add Department</a>
    </div>
    <div class="card-body"> 
        <div class="table-responsive">  
        <table class="table table-bordered table-hover nowrap" id="attendancesTable" style="width:100%">
            <thead>
                <tr style="color: rgb(77, 148, 255);">
                    <th>Id</th>
                    <th>department</th>
                    <th>Created</th>
                    <th>Modified</th>                                
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department):?>
                    <tr>
                    <td><?= $this->Number->format($department->id) ?></td>
                    <td><?= h($department->department)?></td>
                    <td><?= h($department->created) ?></td>
                    <td><?= h($department->modified) ?></td>
                    <td class="actions">
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $department->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->id],  ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id), 'class' => 'btn btn-danger btn-sm']) ?>
                    </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>    
        </div>     
    </div>
</div>
</section>