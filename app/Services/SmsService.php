<?php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;
use Illuminate\Support\Facades\Log;
use Twilio\Http\CurlClient;

class SmsService
{
    protected Client $client;
    protected string $fromNumber;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');

        Log::info('Twilio Config Debug:', [
            'sid_set' => !empty($sid),
            'token_set' => !empty($token),
            'from' => $from
        ]);

        if (empty($sid) || empty($token)) {
            throw new \Exception('Twilio credentials not configured properly');
        }

        // Create a custom HTTP client with SSL verification disabled for local development
        // WARNING: Only use this in development. In production, use proper SSL certificates.
        $httpClient = new CurlClient([
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $this->client = new Client($sid, $token, null, null, $httpClient);
        $this->fromNumber = $from;
    }

    /**
     * Envoyer un SMS de confirmation de réservation
     * Retourne ['ok' => bool, 'error' => string|null]
     */
    public function sendBookingConfirmation(string $phoneNumber, string $greenSpaceName, string $location): array
    {
        try {
            $message = "Your reservation for {$greenSpaceName} at {$location} has been confirmed.";

            $twilioMessage = $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->fromNumber,
                    'body' => $message,
                ]
            );

            Log::info('SMS envoyé', [
                'to' => $phoneNumber,
                'sid' => $twilioMessage->sid ?? null,
                'status' => $twilioMessage->status ?? null,
            ]);

            return ['ok' => true, 'error' => null];
        } catch (RestException $e) {
            Log::error('Twilio RestException: ' . $e->getMessage(), [
                'code' => $e->getCode(),
                'http_status' => method_exists($e, 'getStatusCode') ? $e->getStatusCode() : null,
            ]);
            return ['ok' => false, 'error' => 'Twilio error: ' . $e->getMessage()];
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du SMS: ' . $e->getMessage());
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Valider le format du numéro de téléphone (E.164 approximatif)
     */
    public function validatePhoneNumber(string $phoneNumber): bool
    {
        $cleaned = preg_replace('/[^\d+]/', '', $phoneNumber);
        return preg_match('/^\+[1-9]\d{9,14}$/', $cleaned) === 1;
    }

    /**
     * Formater le numéro de téléphone pour Twilio
     */
    public function formatPhoneNumber(string $phoneNumber): string
    {
        $cleaned = preg_replace('/[^\d+]/', '', $phoneNumber);

        if (!str_starts_with($cleaned, '+')) {
            if (str_starts_with($cleaned, '0')) {
                $cleaned = substr($cleaned, 1);
            }

            if (strlen($cleaned) === 8) {
                $cleaned = '+216' . $cleaned; // Tunisie
            } elseif (strlen($cleaned) === 9) {
                $cleaned = '+33' . $cleaned; // France (approx.)
            } else {
                $cleaned = '+216' . $cleaned; // Par défaut Tunisie
            }
        }

        return $cleaned;
    }
}
