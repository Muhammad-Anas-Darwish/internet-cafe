<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServicesController extends Controller
{
    // show all services
    public function index(): View
    {
        $services = Services::all();

        $context = [
            'services' => $services,
        ];
        return view('services.services', $context);
    }

    // show one service
    public function show($id): View
    {
        $service = Services::find($id);

        $context = [
            'service' => $service,
        ];
        return view('services.service', $context);
    }

    // create service
    public function create(): View
    {
        return view('services.create');
    }

    // store service
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        Services::create([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        session()->flash('status', 'Service save successful!');

        return redirect(route('services.list'));
    }

    // edit services
    public function edit($id)
    {
        $service = Services::find($id);

        $context = [
            'service' => $service,
        ];
        return view('services.update', $context);
    }

    // update services
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        $service = Services::find($id)->update([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        if ($service) {
            session()->flash('status', 'Service save successful!');
        }

        return redirect(route('services.one', $id));
    }

    // delete services
    public function destroy($id)
    {
        $service = Services::fin($id);
        if ($service->exists()) {
            $name = $service->first()->name;
            $service->delete();
            session()->flash('status', $name . ' Deleted Successful!');
        }
        else {
            session()->flash('status', 'Service is already not exsist!');
        }

        return redirect(route('services.list'));
    }
}
