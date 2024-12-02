<?php

namespace src;

require_once '../vendor/autoload.php';
// Esto es por culpa de php, que no quiso a la buena, que era con el composer >:o 
require_once './fpdf181/fpdf.php';

use CURLFile;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf as PdfMpdf;
use Exception;
use FPDF as GlobalFPDF;

class UltimateClassConverter
{
    private $writer;
    private $fpdf;
    private $serviceUrl;

    public function __construct() {
        $this->fpdf = new GlobalFPDF();
        $this->serviceUrl = 'http://192.168.0.51:3000/convert';
    }

    public function convertImgToPdf($imgRoute){

        if (!file_exists($imgRoute)) {
            throw new Exception("El archivo de imagen no existe: $imgRoute");
        }

        list($ancho,$alto) = getimagesize($imgRoute);
        $ancho_mm = $ancho * 0.264583;
        $alto_mm = $alto * 0.264583;

        $this->fpdf->AddPage('P',[$ancho_mm,$alto_mm]);
        $this->fpdf->Image($imgRoute, 0, 0, $ancho_mm, $alto_mm);

        $this->fpdf->Output('image.pdf', 'F');
        sleep(1);
        $this->fpdf = new FPDF();
    }

    public function advanceConvertImgToPdf($imgPath,$outPath) {
        
        if (!file_exists($imgPath)) {
            throw new Exception("El archivo de imagen no existe: $imgPath");
        }

        list($ancho,$alto) = getimagesize($imgPath);
        $ancho_mm = $ancho * 0.264583;
        $alto_mm = $alto * 0.264583;

        // Determinar la orientación: 'P' (vertical) o 'L' (horizontal)
        $orientacion = $ancho_mm > $alto_mm ? 'L' : 'P';

        $this->fpdf->AddPage($orientacion, [$ancho_mm, $alto_mm]);

        $this->fpdf->Image($imgPath, 0, 0, $ancho_mm, $alto_mm, strtoupper(pathinfo($imgPath, PATHINFO_EXTENSION)));

        $this->fpdf->Output($outPath, 'F');

        sleep(1);
        $this->fpdf = new GlobalFPDF();
    }

    public function excelToPdf($excelRoute,$outputRoutePdf)
    {
        if (!file_exists($excelRoute)) {
            die("Could not find");
        }

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($excelRoute);
        $spreadsheet = $reader->load($excelRoute);

        $this->writer = new PdfMpdf($spreadsheet);

        $this->writer->save($outputRoutePdf);
    }

    public function wordToPdf($wordFilePath,$wordFileName)
    {
        $curl = curl_init();
        $data = ['file' => new CURLFile($wordFilePath)];
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->serviceUrl,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: multipart/form-data"
            ],
            CURLOPT_POSTFIELDS => $data,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            print_r(json_encode([
                'Success' => false,
                'message' => "Error en la API: $err",
                'status' => 500,
                'data'=> []
            ]));
            exit;
        }

        $pdfFileName = "$wordFileName.pdf";
        $pdfFilePath = __DIR__ . "/$pdfFileName";
        file_put_contents($pdfFilePath, $response);
        print_r(
            json_encode(
                [
                    'success'=> true,
                    'fileUrl'=> $pdfFileName,
                    'status'=>200,
                ]
            )
        );
        exit;
    }
}