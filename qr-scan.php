<?php
/* Template Name: QR Code Scanner */

use Zxing\QrReader;

require __DIR__ . "/inc/QR-CODE/vendor/autoload.php";
$qrcode = new QrReader('path/to_image');
$text = $qrcode->text();