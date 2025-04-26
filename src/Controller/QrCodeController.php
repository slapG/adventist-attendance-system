<?php
namespace App\Controller;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeController extends AppController
{
    public function generateQr()
    {
        // Define the folder path
        $folderPath = WWW_ROOT . 'img' . DS . 'qrcodes';
        
        // Check if the folder is writable
        if (!is_writable($folderPath)) {
            echo 'Folder is not writable. Please check the folder permissions.';
            return;
        }

        // Generate the QR code
        $qrCode = new QrCode('https://example.com');
        $writer = new PngWriter();

        // Set the file path to save the QR code
        $filePath = $folderPath . DS . 'example_qr.png';

        try {
            // Write the QR code to a file
            $writer->write($qrCode)->saveToFile($filePath);
            // Pass the image path to the view
            $imagePath = 'img/qrcodes/example_qr.png';
            $this->set('imagePath', $imagePath);
        } catch (\Exception $e) {
            echo 'Error generating QR Code: ' . $e->getMessage();
        }
    }

    public function scan()
    {
        // Just renders the view
    }

    public function process()
    {
        $data = $this->request->getData('qr_data');
        $this->Flash->success("Scanned QR Data: " . h($data));
        return $this->redirect(['action' => 'scan']);
    }


}
