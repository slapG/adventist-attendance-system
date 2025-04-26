<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="departments view content">
            <h3><?= h($department->department) ?></h3>
            <table>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= h($department->department) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($department->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($department->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($department->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Employees') ?></h4>
                <?php if (!empty($department->employees)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Middle Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Department Id') ?></th>
                            <th><?= __('Date Of Birth') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Place Of Birth') ?></th>
                            <th><?= __('Qr Code') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($department->employees as $employees) : ?>
                        <tr>
                            <td><?= h($employees->id) ?></td>
                            <td><?= h($employees->first_name) ?></td>
                            <td><?= h($employees->middle_name) ?></td>
                            <td><?= h($employees->last_name) ?></td>
                            <td><?= h($employees->department_id) ?></td>
                            <td><?= h($employees->date_of_birth) ?></td>
                            <td><?= h($employees->status) ?></td>
                            <td><?= h($employees->place_of_birth) ?></td>
                            <td><?= h($employees->qr_code) ?></td>
                            <td><?= h($employees->created) ?></td>
                            <td><?= h($employees->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
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
