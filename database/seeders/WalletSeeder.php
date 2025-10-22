<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Wallet;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer quelques événements si ils n'existent pas
        $events = [
            [
                'name' => 'Plantation d\'arbres urbains',
                'date' => now()->addDays(30),
                'location' => 'Parc de Belvédère, Tunis',
                'description' => 'Plantation de 100 arbres dans le parc de Belvédère pour améliorer la qualité de l\'air urbain.',
                'image' => 'tree-planting.jpg'
            ],
            [
                'name' => 'Nettoyage des plages',
                'date' => now()->addDays(45),
                'location' => 'Plage de Sidi Bou Said',
                'description' => 'Opération de nettoyage des plages pour protéger l\'écosystème marin.',
                'image' => 'beach-cleanup.jpg'
            ],
            [
                'name' => 'Installation panneaux solaires',
                'date' => now()->addDays(60),
                'location' => 'École primaire de Carthage',
                'description' => 'Installation de panneaux solaires pour alimenter l\'école en énergie renouvelable.',
                'image' => 'solar-panels.jpg'
            ]
        ];

        foreach ($events as $eventData) {
            Event::firstOrCreate(
                ['name' => $eventData['name']],
                $eventData
            );
        }

        // Créer des wallets pour chaque événement
        $wallets = [
            [
                'name' => 'Fonds Reboisement Urbain',
                'event_id' => Event::where('name', 'Plantation d\'arbres urbains')->first()->id,
                'target_amount' => 5000.00,
                'donation_count' => 0,
                'total_amount' => 0.00
            ],
            [
                'name' => 'Fonds Protection Marine',
                'event_id' => Event::where('name', 'Nettoyage des plages')->first()->id,
                'target_amount' => 3000.00,
                'donation_count' => 0,
                'total_amount' => 0.00
            ],
            [
                'name' => 'Fonds Énergie Verte',
                'event_id' => Event::where('name', 'Installation panneaux solaires')->first()->id,
                'target_amount' => 10000.00,
                'donation_count' => 0,
                'total_amount' => 0.00
            ],
            [
                'name' => 'Fonds Éducation Environnementale',
                'event_id' => Event::where('name', 'Installation panneaux solaires')->first()->id,
                'target_amount' => 2000.00,
                'donation_count' => 0,
                'total_amount' => 0.00
            ]
        ];

        foreach ($wallets as $walletData) {
            Wallet::firstOrCreate(
                ['name' => $walletData['name']],
                $walletData
            );
        }
    }
}