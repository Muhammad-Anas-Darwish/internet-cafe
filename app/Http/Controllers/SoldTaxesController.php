<?php

namespace App\Http\Controllers;

use App\Models\SoldTaxes;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SoldTaxesController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'taxe_id' => 'required|exists:taxes,id'
        ]);

        $sold_taxe = SoldTaxes::create([
            'customer_id' => $request['customer_id'],
            'taxe_id' => $request['taxe_id']
        ]);

        session()->flash('status', "{$sold_taxe->taxe->name} has been added to device {$sold_taxe->customer->device->number} successfully");

        return redirect(route('bookings.main'));
    }

    public function destroy($id): RedirectResponse
    {
        $sold_taxe = SoldTaxes::find($id);

        if ($sold_taxe->exists()) {
            $name = $sold_taxe->taxe->name;
            $sold_taxe->delete();
            session()->flash('status', $name . ' Deleted Successful!');
        }

        return redirect(route('bookings.main'));
    }
}
