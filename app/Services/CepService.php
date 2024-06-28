<?php

namespace App\Services;

class CepService
{
    public function getCepData(string $cep)
    {
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if (isset($error_msg)) {
            var_dump("cURL Error: " . $error_msg);
        }

        if ($httpCode == 200) {
            return json_decode($response, true);
        } else {
            return ['erro' => 'Unable to fetch data.'];
        }
    }
}
