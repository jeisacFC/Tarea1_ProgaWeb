<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = $this->getServices();
        $stats = $this->getStats();
        return view('services', compact('services', 'stats'));
    }

    private function getServices()
    {
        return [
            [
                'icon' => 'server',
                'title' => 'Web Hosting',
                'description' => 'Reliable and fast web hosting solutions.',
                'badge' => 'Popular',
                'badge_variant' => 'success',
            ],
            [
                'icon' => 'code-bracket',
                'title' => 'Web Development',
                'description' => 'Custom web development services.',
                'badge' => 'New',
                'badge_variant' => 'info',
            ],
            [
                'icon' => 'shield-check',
                'title' => 'Cyber Security',
                'description' => 'Protect your digital assets.',
                'badge' => 'Secure',
                'badge_variant' => 'warning',
            ],
        ];
    }

    private function getStats()
    {
        return [
            [
                'title' => 'Active Clients',
                'value' => '120',
                'icon' => 'users',
                'trend' => '12%',
                'trend_up' => true,
            ],
            [
                'title' => 'Projects Completed',
                'value' => '540',
                'icon' => 'clipboard-document-check',
                'trend' => '5%',
                'trend_up' => true,
            ],
            [
                'title' => 'Support Tickets',
                'value' => '15',
                'icon' => 'ticket',
                'trend' => '2%',
                'trend_up' => false,
            ],
        ];
    }
}
