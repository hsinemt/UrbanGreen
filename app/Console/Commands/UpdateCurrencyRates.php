<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates {--force : Force update even if cache is fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency exchange rates from API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating currency exchange rates...');

        try {
            $currencyService = app(CurrencyService::class);

            if ($this->option('force')) {
                $this->info('Forcing cache refresh...');
                $rates = $currencyService->refreshRates();
            } else {
                $rates = $currencyService->getExchangeRates();
            }

            if ($rates && isset($rates['rates'])) {
                $this->info('Currency rates updated successfully!');
                $this->info('Base currency: '.$rates['base']);
                $this->info('Date: '.$rates['date']);
                $this->info('Number of currencies: '.count($rates['rates']));

                // Afficher quelques taux importants
                $importantCurrencies = ['USD', 'EUR', 'GBP', 'CHF'];
                $this->info("\nImportant exchange rates:");
                foreach ($importantCurrencies as $currency) {
                    if (isset($rates['rates'][$currency])) {
                        $this->line("1 {$rates['base']} = {$rates['rates'][$currency]} {$currency}");
                    }
                }

                return Command::SUCCESS;
            } else {
                $this->error('Failed to update currency rates');

                return Command::FAILURE;
            }

        } catch (\Exception $e) {
            $this->error('Error updating currency rates: '.$e->getMessage());
            Log::error('Currency rates update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return Command::FAILURE;
        }
    }
}
