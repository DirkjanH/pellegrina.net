<?php

function laadAdresRecaptchaSecret(string $configFile): string
{
    if (file_exists($configFile)) {
        if (!is_file($configFile) || !is_readable($configFile)) {
            throw new RuntimeException('Het privébestand voor reCAPTCHA is niet leesbaar.');
        }
        try {
            $config = require $configFile;
        } catch (Throwable $exception) {
            throw new RuntimeException('Het privébestand voor reCAPTCHA kon niet worden ingelezen.');
        }
        if (!is_array($config) || !isset($config['secret']) || !is_string($config['secret']) || $config['secret'] === '') {
            throw new RuntimeException('Het privébestand voor reCAPTCHA bevat geen geldige sleutel.');
        }
        return $config['secret'];
    }

    $secret = getenv('RECAPTCHA_SECRET') ?: ($_SERVER['RECAPTCHA_SECRET'] ?? '');
    if (!is_string($secret) || $secret === '') {
        throw new RuntimeException('De geheime reCAPTCHA-sleutel is niet ingesteld.');
    }
    return $secret;
}

function controleerAdresRecaptcha($token): bool
{
    if (!is_string($token) || $token === '' || strlen($token) > 8192) {
        return false;
    }

    $secret = laadAdresRecaptchaSecret('/var/www/vhosts/horringa.net/private/recaptcha.php');
    if (!function_exists('curl_init')) {
        throw new RuntimeException('De cURL-extensie ontbreekt.');
    }

    $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
    if ($curl === false) {
        throw new RuntimeException('reCAPTCHA-verificatie kon niet worden gestart.');
    }
    try {
        if (!curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(['secret' => $secret, 'response' => $token]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => false,
        ])) {
            throw new RuntimeException('reCAPTCHA-verificatie kon niet worden geconfigureerd.');
        }
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($response === false || $status !== 200) {
            throw new RuntimeException('reCAPTCHA-verificatie is niet beschikbaar.');
        }
    } finally {
        curl_close($curl);
    }

    $result = json_decode($response, true);
    if (!is_array($result) || !isset($result['success']) || !is_bool($result['success'])) {
        throw new RuntimeException('reCAPTCHA gaf een ongeldig antwoord.');
    }
    if (!$result['success']) {
        $codes = $result['error-codes'] ?? [];
        if (is_array($codes) && (in_array('missing-input-secret', $codes, true) || in_array('invalid-input-secret', $codes, true))) {
            throw new RuntimeException('De geheime reCAPTCHA-sleutel is ongeldig.');
        }
        return false;
    }
    if (!in_array($result['hostname'] ?? null, ['pellegrina.net', 'www.pellegrina.net'], true)) {
        return false;
    }
    if (array_key_exists('score', $result) || array_key_exists('action', $result)) {
        $score = $result['score'] ?? null;
        return ($result['action'] ?? null) === 'submit'
            && (is_float($score) || is_int($score))
            && $score >= 0.5 && $score <= 1;
    }
    return true;
}
