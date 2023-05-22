<?php
// Trendyol API için kullanıcı adı ve şifre
$username = 'BNomMTz1WJfy2e7t2LuK';
$password = 'r9v0FbZx3sgkGMLJCI6Z';

// Trendyol API'nin ana URL'si ve POST verileri
$url = 'https://api.trendyol.com/sapigw/suppliers/566693/supplier-invoice-links';
$data = array(
    'invoiceLink' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
    'shipmentPackageId'=> '1453726452'
      
);

// cURL isteği oluşturma
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Basic Authorization başlığı oluşturma
$authorization = base64_encode($username . ':' . $password);
$headers = array(
    'Authorization: Basic ' . $authorization,
    'Content-Type: application/json',
    'Accept: application/json'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// İsteği gönder ve sonucu al
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'cURL Hata: ' . curl_error($ch);
} else {
    echo $result;
}

// cURL isteğini kapat
curl_close($ch);
?>

