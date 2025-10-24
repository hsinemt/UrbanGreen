<?php

namespace App\Console\Commands;

use App\Services\FreepikImageService;
use Illuminate\Console\Command;

class TestFreepikAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:freepik-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Freepik API integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Freepik API integration...');

        $freepikService = new FreepikImageService;

        $result = $freepikService->generateEventImage(
            'Test Event',
            'This is a test event for API testing',
            'Test Location'
        );

        if ($result) {
            $this->info('✅ Image generated successfully: '.$result);
        } else {
            $this->error('❌ Image generation failed. Check logs for details.');
        }

        return 0;
    }
}
