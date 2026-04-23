<?php
namespace App\Services;

class KKiapayService
{
    public function verifyWebhookSignature(array $payload, string $signature): bool
    {
        $secret = config('kkiapay.webhook_secret');
        if (empty($secret)) return true; // Skip in dev
        $computed = hash_hmac('sha256', json_encode($payload), $secret);
        return hash_equals($computed, $signature);
    }

    public function isEnabled(): bool
    {
        return !empty(config('kkiapay.public_key'));
    }

    public function isSandbox(): bool
    {
        return (bool) config('kkiapay.sandbox', true);
    }

    public function getPublicKey(): string
    {
        return config('kkiapay.public_key', '');
    }
}
