<?php
date_default_timezone_set("Asia/Jakarta");

$host = 'localhost';
$db   = 'smk_absensi';
$user = 'smk_absensi';
$pass = 'wMXtmw8K7TRAeEne';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
try {
    $con = new \PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$s = $con->prepare("SELECT * FROM setting WHERE id=1");
$s->execute();
$setting = $s->fetch(PDO::FETCH_OBJ);

$wa_url = $setting->wa_api_url;
$wa_key = $setting->wa_api_key;

$walikelas = $con->prepare("SELECT walikelas.*, admin.nama, admin.whatsapp FROM walikelas JOIN admin ON admin.id=walikelas.guru");
$walikelas->execute();
$wk = $walikelas->fetchAll(PDO::FETCH_OBJ);

if(date("l") != "Friday"){
    foreach ($wk as $w){
        $tgl = date("Y-m-d");
        $abs = $con->prepare("SELECT * FROM absensi WHERE tanggal=? AND walikelas=?");
        $abs->execute([$tgl, $w->guru]);
        
        if($abs->rowCount() == 0){
            $msg = "Hai *$w->nama*. Anda belum melakukan rekap absensi hari ini untuk kelas  *$w->kelas*. Segera lakukan rekap absensi ya...!";
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL            => $wa_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST  => 'POST',
                CURLOPT_POSTFIELDS     => '{
                        "recipient_type": "individual",
                        "to": "'.$w->whatsapp.'",
                        "type": "text",
                        "text": {
                            "body": "' . $msg . '"
                        }
                    }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $wa_key,
                    'Content-Type: application/json'
                ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
        }
    }
}


