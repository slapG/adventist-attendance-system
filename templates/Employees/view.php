<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="employees view content">
    <h3><?= h($employee->first_name) ?></h3>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Employees'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Employee'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employees view content">
            <h3><?= h( ucwords($employee->first_name. ' '.$employee->middle_name.' '. $employee->last_name)) ?></h3>
            <?php if (!empty($employee->qr_code)): ?>
                <h4>Employee QR Code:</h4>
                <img src="<?= $this->Url->assetUrl('/img/'.$employee->qr_code.'')?>" width="200" alt="QR Code">
            <?php endif; ?>
            <table>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($employee->first_name) ?></td>
                </tr>   
                <tr>
                    <th><?= __('Middle Name') ?></th>
                    <td><?= h($employee->middle_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($employee->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $employee->has('department') ? $this->Html->link($employee->department->department, ['controller' => 'Departments', 'action' => 'view', $employee->department->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($employee->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Place Of Birth') ?></th>
                    <td><?= h($employee->place_of_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qr Code') ?></th>
                    <td><?= h($employee->qr_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($employee->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Of Birth') ?></th>
                    <td><?= h($employee->date_of_birth) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($employee->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($employee->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Attendances') ?></h4>
                <?php if (!empty($employee->attendances)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Employee Id') ?></th>
                            <th><?= __('Check In') ?></th>
                            <th><?= __('Check Out') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($employee->attendances as $attendances) : ?>
                        <tr>
                            <td><?= h($attendances->id) ?></td>
                            <td><?= h($attendances->employee_id) ?></td>
                            <td><?= h($attendances->check_in) ?></td>
                            <td><?= h($attendances->check_out) ?></td>
                            <td><?= h($attendances->created) ?></td>
                            <td><?= h($attendances->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Attendances', 'action' => 'view', $attendances->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Attendances', 'action' => 'edit', $attendances->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Attendances', 'action' => 'delete', $attendances->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendances->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>