<?php
if (!function_exists('send_telegram_notification')) {
    function send_telegram_notification($chat_id, $message)
    {
        $token = '7630893159:AAEXS3UY7OE3MAIgs9og8SxkmB1HD5SGNf4'; // Token bot Anda
        $url = 'https://api.telegram.org/bot' . $token . '/sendMessage';

        $data = [
            'chat_id' => $chat_id,
            'text' => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        // Periksa jika curl_exec gagal
        if ($response === false) {
            $error = curl_error($ch);
            log_message('error', 'Gagal mengirim notifikasi ke Telegram: ' . $error);
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        // Log response untuk debugging
        log_message('debug', 'Telegram response: ' . $response);

        return json_decode($response, true);
    }
}
