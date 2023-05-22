<?php
defined('YUOG') or exit('No direct script access allowed / Yetkisiz Giriş ');

ob_start();
session_start();
require 'vendor/autoload.php';
date_default_timezone_set('Europe/Istanbul');

$mysqli = new mysqli("localhost", "yuog_db", "t3g9_uU46", "yuog_db");
$mysqli->query("SET NAMES 'utf8'  ");
$mysqli->query("SET CHARACTER SET utf8");
$mysqli->query("SET COLLATION_CONNECTION = 'utf8_general_ci' ");

$genelbak     = $mysqli->query("select * from ayarlar ")->fetch_array();
if ($genelbak['hata'] == "on") {
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
}

$canli = $mysqli->query("select * from analytic ")->fetch_array();

require_once(dirname(__FILE__) . '/security.php');
$gelenurl = $_SERVER['REQUEST_URI'];

function seocuk($seoID)
{
  global $mysqli;

  $idd = (int) $seoID;
  $seobcc = $mysqli->query("select * from seo where id='$idd' ");
  $seobul = $seobcc->fetch_array();
  $seo   = @$seobul['seo'];

  return $seo;
}

function turkcetarih_formati($format, $datetime = 'now')
{
  $z = date("$format", strtotime($datetime));
  $gun_dizi = array(
    'Monday' => 'Pazartesi',
    'Tuesday' => 'Salı',
    'Wednesday' => 'Çarşamba',
    'Thursday' => 'Perşembe',
    'Friday' => 'Cuma',
    'Saturday' => 'Cumartesi',
    'Sunday' => 'Pazar',
    'January' => 'Ocak',
    'February' => 'Şubat',
    'March' => 'Mart',
    'April' => 'Nisan',
    'May' => 'Mayıs',
    'June' => 'Haziran',
    'July' => 'Temmuz',
    'August' => 'Ağustos',
    'September' => 'Eylül',
    'October' => 'Ekim',
    'November' => 'Kasım',
    'December' => 'Aralık',
    'Mon' => 'Pts',
    'Tue' => 'Sal',
    'Wed' => 'Çar',
    'Thu' => 'Per',
    'Fri' => 'Cum',
    'Sat' => 'Cts',
    'Sun' => 'Paz',
    'Jan' => 'Oca',
    'Feb' => 'Şub',
    'Mar' => 'Mar',
    'Apr' => 'Nis',
    'Jun' => 'Haz',
    'Jul' => 'Tem',
    'Aug' => 'Ağu',
    'Sep' => 'Eyl',
    'Oct' => 'Eki',
    'Nov' => 'Kas',
    'Dec' => 'Ara',
  );
  foreach ($gun_dizi as $en => $tr) {
    $z = str_replace($en, $tr, $z);
  }
  if (strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false)
    $z = str_replace('Mayıs', 'May', $z);
  return $z;
}


// function onyazi ($icerik, $sayi){
// 	$parcala = explode(" ", $icerik);
// 	$sayyy = count($parcala);
// 	for($x=0; $x<=$sayi; $x++){
// 		@$yazi.= $parcala[$x].' ';

// 	}
// 	if($sayyy>$sayi){
// 		$noktaa = ' ...';
// 	} else {
// 		$noktaa = '';
// 	}
// 	return $yazi.$noktaa;
// }
function convertImageToWebP($source, $destination, $quality = 80)
{
  $extension = pathinfo($source, PATHINFO_EXTENSION);
  if ($extension == 'jpeg' || $extension == 'jpg')
    $image = imagecreatefromjpeg($source);
  elseif ($extension == 'gif')
    $image = imagecreatefromgif($source);
  elseif ($extension == 'png')
    $image = imagecreatefrompng($source);
  return imagewebp($image, $destination, $quality);
}

function mailgonder($gidecekmail, $mesaj, $konu, $baslik)
{
  global $mysqli;
  $genelbak = $mysqli->query("SELECT * FROM ayarlar WHERE id=1 ")->fetch_assoc();

  $eposta_mesaji = $mesaj;

  $eposta_konusu = $konu;
  // Create the Transport
  //$transport = new Swift_SmtpTransport('smtp.example.org', 587, 'tls');
  $transport = (new Swift_SmtpTransport(gethostbyname('mail.' . $genelbak['web']), 25))
    ->setUsername($genelbak['mail2'])
    ->setPassword($genelbak['mailsifre']);

  // Create the Mailer using your created Transport
  $mailer = new Swift_Mailer($transport);
  // Create a message
  $sendmessage = (new Swift_Message($eposta_konusu))
    ->setFrom([$genelbak['mail2'] => $genelbak['firma']])
    ->setTo($gidecekmail)
    ->setBody('
                                <body style=" width:100%;">
                                  <table role="presentation" style="width:100%; margin:auto; border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
                                    <tr>
                                      <td align="center" style="padding:0;">
                                        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                                          <tr>
                                            <td align="center" style="padding:40px 0 30px 0;background:#fafafa; ">
                                              <img src="https://yuogsoftware.com/uploads/logo.png" alt="Yuog Software" width="300" style="height:auto;display:block;" />
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding:36px 30px 42px 30px;">
                                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                  <td style="padding:0 0 36px 0;color:#153643;">
                                                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">' . $baslik . '</h1>
                                                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;  width:100%;">
                                                    ' . $eposta_mesaji . '</a></p>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td style="padding:0;">
                                                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                                      <tr>
                                                  
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="padding:30px;background:#7d79eb;">
                                              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                                <tr>
                                                  <td style="padding:0;width:50%;" align="left">
                                                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                                                      &reg; ' . $genelbak['slogan'] . '<br/>
                                                    </p>
                                                  </td>
                                                  <td style="padding:0;width:50%;" align="right">
                                                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                                      <tr>
                                                        <td style="padding:0 0 0 10px;width:38px;">
                                                          <a href="' . $genelbak['instagram'] . '" style="color:#ffffff;"><img src="https://yuogsoftware.com/uploads/instagram.png" alt="instagram" width="38" style="height:auto;display:block;border:0;" /></a>
                                                        </td>
                                                        <td style="padding:0 0 0 10px;width:38px;">
                                                          <a href="' . $genelbak['linkedin'] . '" style="color:#ffffff;"><img src="https://yuogsoftware.com/uploads/linkedin.png" alt="linkedin" width="38" style="height:auto;display:block;border:0;" /></a>
                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </table>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table></body>
                                ', 'text/html');

  // Send the message
  $result = $mailer->send($sendmessage);
}
