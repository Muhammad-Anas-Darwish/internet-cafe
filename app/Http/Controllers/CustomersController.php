<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class CustomersController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,number',
            'reserved_time' => 'required|date_format:H:i',
        ]);

        Customers::insert([
            'device_id' => $request['device_id'],
            'from_time' => Carbon::now(),
            'reserved_time' => $request['reserved_time'],
            'is_open_time' => $request['is_open_time'] ? 1 : 0
        ]);
        session()->flash('status', 'Customer created successful!');

        return redirect(route('bookings.main'));
    }

    public function update_store(Request $request, $id): RedirectResponse
    {
        $customer = DB::table('customers')
            ->where('id', $id)
            ->update([
                'is_open_time' => $request['is_open_time'] ? 1 : 0
            ]);

        if ($customer) {
            session()->flash('status', 'device updated successful!');
        }

        return redirect(route('bookings.main'));
    }

    public function destroy($id)
    {
        $taxe = DB::table('customers')->where('id', $id);

        if ($taxe->exists()) {
            $taxe->delete();
            session()->flash('status', 'Customer Deleted Successful!');
        }

        return redirect(route('bookings.main'));
    }
}
