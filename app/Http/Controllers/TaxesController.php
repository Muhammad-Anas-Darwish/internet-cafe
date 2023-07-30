<?php

namespace App\Http\Controllers;

use App\Models\Taxes;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaxesController extends Controller
{
    // show all taxes
    public function index(): View
    {
        $taxes = Taxes::all();

        $context = [
            'taxes' => $taxes,
        ];
        return view('taxes.taxes', $context);
    }

    // show one taxe
    public function show($id): View
    {
        $taxe = Taxes::find($id);

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

        Taxes::create([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        session()->flash('status', 'Taxe save successful!');

        return redirect(route('taxes.list'));
    }

    // edit taxes
    public function edit($id): View
    {
        $taxe = Taxes::find($id);

        $context = [
            'taxe' => $taxe,
        ];
        return view('taxes.update', $context);
    }

    // update taxes
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        $taxe = Taxes::find($id)->update([
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
        $taxe = Taxes::find($id);
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
