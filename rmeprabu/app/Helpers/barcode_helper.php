<?php

use CodeItNow\BarcodeBundle\Utils\QrCode;

if (! function_exists('barcode_helper')) {
    function barcode_helper($text)
    {
        $qrCode = new QrCode();
        $qrCode->setText($text)
            ->setSize(75)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        return '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
    }
}