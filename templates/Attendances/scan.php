<!-- templates/Attendances/scan.php -->
<?= $this->Html->css('https://unpkg.com/html5-qrcode@2.3.7/minified/html5-qrcode.min.css') ?>
<?= $this->Html->script('https://unpkg.com/html5-qrcode') ?>

<div id="reader" style="width:300px;"></div>
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
