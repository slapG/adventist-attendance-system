<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attendance> $attendances
 */
?>

<section class="section">
    <div class="section col-md-12">
    <div class="row g-3">
    <div class="col-md-4">
        <?= $this->Html->script('html5-qrcode.min.js') ?>
    <div id="reader" style="width:380px; height: 400px;"></div>
    <div id="scan-result"></div>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('scan-result').innerText = "Scanned ID: " + decodedText;

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
            Swal.fire({
            position: "center",
            icon: "success",
            title: data.message,
            showConfirmButton: false,
            timer: 5000
            });
            window.location.reload();
        })
        .catch(err => {
            alert('Failed to record attendance.');
            console.error(err);
        });

        html5QrcodeScanner.clear();
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 30, qrbox: 300 }
    );
    html5QrcodeScanner.render(onScanSuccess);
</script>
<div class="card" style="width: 380px; margin-top: 10px; height: 200px;">
    <div class="card-header">
        <h4>Todays Attendance Count</h4>
    </div>
    <div class="card-body">
        <div id="attendanceCount" class="text-center" style="font-size: 30px; font-weight: bold;">
        </div>
    </div>
</div>
</div>
<div class="col-md-8">
    <div class="card 3"> 
    <div class="card-header">
        <span classs="float-left">List of all Employees</span>
        <select id="departmentFilter" class="form-select form-select-sm float-end" style="width: 200px; margin-left: 5px;">
            <option value="">All Departments</option>
        </select>
        <input type="date" class="form-control form-control-sm float-end" id="dateFilter" style="width: 200px; margin-left: 5px;">
        <button class="btn btn-danger btn-sm float-end" id="pfdBtn" style="margin-left: 5px;">PDF</button>
        <button class="btn btn-success btn-sm float-end" id="exelBtn" style="">EXEL</button>
    </div>
    <div class="card-body" style="height: 531px;">
    <div class="table-responsive" id="tableContainer" style="max-height: 508px; overflow-y: auto; position: relative;">
        <table class="table table-bordered table-hover nowrap" id="attendancesTable" style="width:100%; white-space: nowrap;">
            <thead>
                <tr style="color: rgb(77, 148, 255);">
                    <th>Id</th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Time in</th>
                    <th>Time out</th>    
                    <th>Attendance Date</th>                            
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>        
    </div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script>
    var attendances = <?= json_encode($attendances)?>
</script>
<?= $this->Html->script('attendance.js')?>
