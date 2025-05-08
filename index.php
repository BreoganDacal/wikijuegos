<?php
// get_users.php
// Exemplo de como facer unha petición GET sinxela usando file_get_contents()

// Facemos a petición GET ao endpoint e gardamos a resposta JSON nunha variable
$json = file_get_contents('https://jsonplaceholder.typicode.com/users');

// Convertimos a resposta JSON nun array asociativo de PHP
$users = json_decode($json, true);

foreach ($users as $u) {
  echo $u['name'] . "<br>";
}


// Exemplo con curl
// Inicializamos curl
$ch = curl_init();

// Configuramos a URL do endpoint
curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/users');

// Indicamos que queremos que a resposta sexa retornada como un string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executamos a petición GET e gardamos a resposta
$response = curl_exec($ch);

// Comprobamos se ocorreu un erro na petición
if(curl_errno($ch)) {
    echo 'Erro de Curl: ' . curl_error($ch);
    exit;
}

// Pechamos a sesión de curl
curl_close($ch);

// Convertimos a resposta JSON nun array asociativo de PHP
$users = json_decode($response, true);

// Recorremos cada usuario 
foreach ($users as $u) {
    echo $u['name'] . "<br>"; 
} 
?>