<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $data = [
            'newUsers' => 15000,
            'newUsersIncrease' => 200,
            'activeUsers' => 8000,
            'activeUsersIncrease' => 200,
            'totalSales' => 500000,
            'salesChange' => -10000,
            'conversion' => 25,
            'conversionIncrease' => 5,
            'leads' => 250,
            'leadsIncrease' => 20,
            'totalProfit' => 300700,
            'profitIncrease' => 15000,
            'weeklyRevenue' => 50000,
            'revenueIncrease' => 10000,
            'transactions' => [],  // Add your transaction data
            'topPerformers' => [],  // Add your performer data
        ];

        return view('dashboard.home', $data);
    }
}
