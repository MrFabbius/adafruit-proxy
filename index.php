 <?php
// ✅ Configura le tue credenziali Adafruit IO
$io_username = "Miauz";            // il tuo username Adafruit IO
$io_key = "aio_uVeN68jRUrevuXcQRwVn8ok6ZVzI"; // la tua AIO Key personale

// ✅ Recupera i parametri dal SIM900
$feed = $_GET['feed'] ?? $_POST['feed'] ?? '';
$value = $_GET['value'] ?? $_POST['value'] ?? '';

if ($feed && $value) {
    $url = "https://io.adafruit.com/api/v2/$io_username/feeds/default.$feed/data";

    $data = ['value' => $value];
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => [
                "Content-Type: application/x-www-form-urlencoded",
                "X-AIO-Key: $io_key"
            ],
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

    if ($result === FALSE) {
        http_response_code(500);
        echo "Errore nell'invio ad Adafruit.";
    } else {
        echo "OK: $result";
    }
} else {
    http_response_code(400);
    echo "Parametri mancanti.";
}
?>
