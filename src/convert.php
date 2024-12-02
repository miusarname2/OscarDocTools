<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once './fpdf181/fpdf.php';
require './UltimateClassConverter.php';

use src\UltimateClassConverter;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fileType = $_POST['fileType'];
        $file = $_FILES['file'];

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al cargar el archivo.');
        }

        $filePath = $file['tmp_name'];
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $outputDir =  './output';
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $outputFilePath = "./output/$fileName.pdf";

        $converter = new UltimateClassConverter();

        switch ($fileType) {
            case 'word':
                $converter->wordToPdf($filePath, $fileName);
                break;
            case 'excel':
                $converter->excelToPdf($filePath, $outputFilePath);
                break;
            case 'jpg':
            case 'png':
                $filePath = $file['tmp_name'];
                $fileMime = mime_content_type($filePath);
                switch ($fileMime) {
                    case 'image/jpeg':
                        $extension = '.jpg';
                        break;
                    case 'image/png':
                        $extension = '.png';
                        break;
                    default:
                        throw new Exception('Tipo de imagen no soportado.');
                }

                $newFilePath = $filePath . $extension;
                rename($filePath, $newFilePath);

                $converter->advanceConvertImgToPdf($newFilePath, $outputFilePath);
                break;
            default:
                throw new Exception('Tipo de archivo no soportado.');
        }

        echo json_encode([
            'success' => true,
            'fileUrl' => "output/$fileName.pdf",
        ]);
    } else {
        throw new Exception('Método no soportado.');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
    ]);
}
