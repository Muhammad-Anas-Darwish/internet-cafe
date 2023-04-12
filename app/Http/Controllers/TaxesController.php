<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxesController extends Controller
{
    // show all taxes
    public function taxes(): View
    {
        $taxes = DB::table('taxes')->get();

        $context = [
            'taxes' => $taxes,
        ];
        return view('taxes.taxes', $context);
    }

    // show one taxe
    public function taxe($id): View
    {
        $taxe = DB::table('taxes')->where('id', $id)->first();

        $context = [
            'taxe' => $taxe,
        ];
        return view('taxes.taxe', $context);
    }

    // create taxe
    public function create(): View
    {
        return view('taxes.create');
    }

    // store taxe
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        DB::table('taxes')->insert([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        session()->flash('status', 'Taxe save successful!');

        return redirect(route('taxes.list'));
    }

    // update taxes
    public function update($id): View
    {
        $taxe = DB::table('taxes')->where('id', $id)->first();

        $context = [
            'taxe' => $taxe,
        ];
        return view('taxes.update', $context);
    }

    // update store taxes
    public function update_store(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        $taxe = DB::table('taxes')->where('id', $id)->update([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        if ($taxe) {
            session()->flash('status', 'Taxe save successful!');
        }

        return redirect(route('taxes.one', $id));
    }

    // delete taxes
    public function destroy($id): RedirectResponse
    {
        $taxe = DB::table('taxes')->where('id', $id);
        if ($taxe->exists()) {
            $name = $taxe->first()->name;
            $taxe->delete();
            session()->flash('status', $name . ' Deleted Successful!');
        }
        else {
            session()->flash('status', 'Taxe is already not exsist!');
        }

        return redirect(route('taxes.list'));
    }
}
