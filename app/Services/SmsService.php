<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $client;
    protected $fromNumber;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $from = config('services.twilio.from');
        
        // Debug logging
        \Log::info('Twilio Config Debug:', [
            'sid' => $sid,
            'token_set' => !empty($token),
            'from' => $from
        ]);
        
        if (empty($sid) || empty($token)) {
            throw new \Exception('Twilio credentials not configured properly');
        }
        
        $this->client = new Client($sid, $token);
        $this->fromNumber = $from;
    }

    /**
     * Envoyer un SMS de confirmation de réservation
     */
    public function sendBookingConfirmation(string $phoneNumber, string $greenSpaceName, string $location): bool
    {
        try {
            $message = "Your reservation for {$greenSpaceName} has been confirmed.";

            $this->client->messages->create(
                $phoneNumber,
                [
                    'from' => $this->fromNumber,
                    'body' => $message
                ]
            );

            Log::info("SMS de confirmation envoyé à {$phoneNumber} pour la réservation de {$greenSpaceName}");
            return true;

        } catch (\Exception $e) {
            Log::error("Erreur lors de l'envoi du SMS: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Valider le format du numéro de téléphone
     */
    public function validatePhoneNumber(string $phoneNumber): bool
    {
        // Supprimer tous les espaces et caractères spéciaux sauf le +
        $cleaned = preg_replace('/[^\d+]/', '', $phoneNumber);
        
        // Vérifier que le numéro commence par + et a au moins 10 chiffres
        return preg_match('/^\+[1-9]\d{9,14}$/', $cleaned);
    }

    /**
     * Formater le numéro de téléphone pour Twilio
     */
    public function formatPhoneNumber(string $phoneNumber): string
    {
        $cleaned = preg_replace('/[^\d+]/', '', $phoneNumber);
        
        // Si le numéro ne commence pas par +, déterminer le pays
        if (!str_starts_with($cleaned, '+')) {
            // Supprimer le 0 initial s'il existe
            if (str_starts_with($cleaned, '0')) {
                $cleaned = substr($cleaned, 1);
            }
            
            // Déterminer le code pays basé sur la longueur et les premiers chiffres
            if (strlen($cleaned) == 8) {
                // Numéro tunisien (8 chiffres)
                $cleaned = '+216' . $cleaned;
            } elseif (strlen($cleaned) == 9) {
                // Numéro français (9 chiffres)
                $cleaned = '+33' . $cleaned;
            } else {
                // Par défaut, considérer comme tunisien
                $cleaned = '+216' . $cleaned;
            }
        }
        
        return $cleaned;
    }
}
