<!-- templates/QrCode/scan.php -->
<h2>Scan QR Code</h2>

<div id="preview" style="width: 100%; max-width: 400px; height: 300px; border: 1px solid #ccc;"></div>

<?= $this->Form->create(null, ['url' => ['controller' => 'QrCode', 'action' => 'process']]) ?>
<?= $this->Form->control('qr_data', ['id' => 'qrInput', 'readonly' => true]) ?>
<?= $this->Form->button('Submit QR Data', ['id' => 'submitBtn', 'disabled' => true]) ?>
<?= $this->Form->end() ?>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    const inputField = document.getElementById('qrInput');
    const submitBtn = document.getElementById('submitBtn');

    const qrScanner = new Html5Qrcode("preview");
    Html5Qrcode.getCameras().then(cameras => {
        if (cameras && cameras.length) {
            const cameraId = cameras[0].id;
            qrScanner.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: 250
                },
                qrCodeMessage => {
                    inputField.value = qrCodeMessage;
                    submitBtn.disabled = false;
                    qrScanner.stop();
                },
                errorMessage => {}
            );
        }
    }).catch(err => {
        alert('Camera not accessible: ' + err);
    });
</script>
