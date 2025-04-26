<!-- templates/QrCode/generate_qr.php -->

<h1>QR Code Generation</h1>

<?php if (isset($imagePath)): ?>
    <p>QR Code generated successfully!</p>
    <img src="<?= $this->Url->build($imagePath); ?>" alt="Generated QR Code">
<?php else: ?>
    <p>Error generating QR code.</p>
<?php endif; ?>
