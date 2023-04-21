<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\Services;
use App\Models\Taxes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function main(): View
    {
        $devices = Devices::all();
        $services = Services::all();
        $taxes = Taxes::all();

        $context = [
            'devices' => $devices,
            'services' => $services,
            'taxes' => $taxes,
        ];
        return view('bookings.main', $context);
    }
}
