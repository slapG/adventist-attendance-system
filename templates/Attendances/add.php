<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attendance $attendance
 * @var \Cake\Collection\CollectionInterface|string[] $employees
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Attendances'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="attendances form content">
            <?= $this->Form->create($attendance) ?>
            <fieldset>
                <legend><?= __('Add Attendance') ?></legend>
                <?php
                    echo $this->Form->control('employee_id', ['options' => $employees]);
                    echo $this->Form->control('check_in');
                    echo $this->Form->control('check_out');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
