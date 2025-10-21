<?php

namespace App\Console\Commands;

use App\Services\SmsService;
use Illuminate\Console\Command;

class TestSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:sms {phone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test SMS functionality with Twilio';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $phone = $this->argument('phone');
        
        $this->info('=== Test de configuration Twilio ===');
        $this->info('TWILIO_SID: ' . config('services.twilio.sid'));
        $this->info('TWILIO_TOKEN: ' . (config('services.twilio.token') ? 'SET' : 'NOT SET'));
        $this->info('TWILIO_FROM: ' . config('services.twilio.from'));
        
        $this->info('\n=== Test du service SMS ===');
        $smsService = new SmsService();
        
        // Test de formatage de numéro
        $formatted = $smsService->formatPhoneNumber($phone);
        $valid = $smsService->validatePhoneNumber($formatted);
        
        $this->info("Numéro original: $phone");
        $this->info("Numéro formaté: $formatted");
        $this->info("Valide: " . ($valid ? 'OUI' : 'NON'));
        
        if (!$valid) {
            $this->error('Le numéro de téléphone n\'est pas valide !');
            return 1;
        }
        
        $this->info('\n=== Test d\'envoi SMS ===');
        $this->info("Tentative d'envoi vers: $formatted");
        
        try {
            $result = $smsService->sendBookingConfirmation(
                $formatted,
                'Test Green Space',
                'Test Location'
            );
            
            if ($result) {
                $this->info('✅ SMS envoyé avec succès !');
            } else {
                $this->error('❌ Échec de l\'envoi du SMS');
            }
        } catch (\Exception $e) {
            $this->error('❌ Erreur: ' . $e->getMessage());
        }
        
        return 0;
    }
}
