<?php


require 'Namazvaqtlari/Aladham.php';

$bot = new Aladham();

$bot = new Aladham();
$content = file_get_contents('php://input');
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

if ($message == "/start") {
    $bot->makeRequest("sendMessage", [
        "chat_id" => $chatID,
        'text' => 'Assalomu laykum Namoz vaqtini bilish uchun /namoz burugunu bering iltimos',
        "parse_mode" => "HTML"
    ]);
}
elseif ($message == "/namoz") {
    $timings = $bot->getPrayerTimes();
    if ($timings) {
        $reply = "🕌 Namoz Vaqtlari:\n";
        $reply .= "Fajr: " . $timings['Fajr'] . "\n";
        $reply .= "Sunrise: " . $timings['Sunrise'] . "\n";
        $reply .= "Dhuhr: " . $timings['Dhuhr'] . "\n";
        $reply .= "Asr: " . $timings['Asr'] . "\n";
        $reply .= "Maghrib: " . $timings['Maghrib'] . "\n";
        $reply .= "Isha: " . $timings['Isha'] . "\n";
        $bot->makeRequest('sendMessage', [
            'chat_id' => $chatID,
            'text' => $reply
        ]);

    } else {
        $bot->makeRequest("sendMessage", [
            'chat_id' => $chatID,
            'text'=>"🕌 Namoz vaqtlaini olishda xatolik yuz berdi "
        ]);
    }
}

