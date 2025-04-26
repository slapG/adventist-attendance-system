<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendance> $attendances
 */
?>

<!-- templates/Attendances/scan.php -->
<?= $this->Html->css('https://unpkg.com/html5-qrcode@2.3.7/minified/html5-qrcode.min.css') ?>
<?= $this->Html->script('https://unpkg.com/html5-qrcode') ?>

<div id="reader" style="width:500px;"></div>
<div id="scan-result"></div>

<script>
function onScanSuccess(decodedText, decodedResult) {
    // Display result
    document.getElementById('scan-result').innerText = "Scanned ID: " + decodedText;

    // Send to CakePHP controller via AJAX
    fetch("<?= $this->Url->build(['controller' => 'Attendances', 'action' => 'addAttendance']) ?>", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': <?= json_encode($this->request->getAttribute('csrfToken')) ?>
        },
        body: JSON.stringify({ employee_id: decodedText })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    })
    .catch(err => {
        alert('Failed to record attendance.');
        console.error(err);
    });

    // Stop scanner after success
    html5QrcodeScanner.clear();
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
);
html5QrcodeScanner.render(onScanSuccess);
</script>

<div class="attendances index content">
    <?= $this->Html->link(__('New Attendance'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Attendances') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('employee_id') ?></th>
                    <th><?= $this->Paginator->sort('check_in') ?></th>
                    <th><?= $this->Paginator->sort('check_out') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendances as $attendance): ?>
                <tr>
                    <td><?= $this->Number->format($attendance->id) ?></td>
                    <td><?= $attendance->has('employee') ? $this->Html->link($attendance->employee->first_name, ['controller' => 'Employees', 'action' => 'view', $attendance->employee->id]) : '' ?></td>
                    <td><?= h($attendance->check_in) ?></td>
                    <td><?= h($attendance->check_out) ?></td>
                    <td><?= h($attendance->created) ?></td>
                    <td><?= h($attendance->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $attendance->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attendance->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $attendance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $attendance->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
