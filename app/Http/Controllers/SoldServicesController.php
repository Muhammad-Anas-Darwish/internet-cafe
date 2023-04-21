<?php

namespace App\Http\Controllers;

use App\Models\SoldServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;


class SoldServicesController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'number' => 'required|min:1'
        ]);

        $sold_service = SoldServices::create([
            'customer_id' => $request['customer_id'],
            'service_id' => $request['service_id'],
            'number' => $request['number']
        ]);

        session()->flash('status', "{$sold_service->service->name} has been added to device {$sold_service->customer->device->number} successfully");

        return redirect(route('bookings.main'));
    }

    public function destroy($id): RedirectResponse
    {
        $sold_service = SoldServices::where('id', $id)->first();
        $name = $sold_service->service->name;

        if ($sold_service->exists()) {
            $sold_service->delete();
            session()->flash('status', $name . ' Deleted Successful!');
        }

        return redirect(route('bookings.main'));
    }
}
