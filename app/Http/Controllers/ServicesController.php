<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    // show all services
    public function services(): View
    {
        $types = DB::table('services')->get();

        $context = [
            'services' => $types,
        ];
        return view('services.services', $context);
    }

    // show one service
    public function service($id): View
    {
        $type = DB::table('services')->where('id', $id)->first();

        $context = [
            'service' => $type,
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

        if ($validated) {
            DB::table('services')->insert([
                'name' => $request['name'],
                'price' => $request['price']
            ]);
            session()->flash('status', 'Service save successful!');
        }
        else {
            session()->flash('status', 'Service not valid!');
        }
        return redirect(route('services.list'));
    }

    // update services
    public function update($id)
    {
        $type = DB::table('services')->where('id', $id)->first();

        $context = [
            'service' => $type,
        ];
        return view('services.update', $context);
    }

    // update store services
    public function update_store(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        if ($validated) {
            $type = DB::table('services')->where('id', $id)->update([
                'name' => $request['name'],
                'price' => $request['price']
            ]);
            if ($type) {
                session()->flash('status', 'Service save successful!');
            }
        }
        else {
            session()->flash('status', 'Service Data not valid!');
            return redirect(route('services.update'));
        }

        return redirect(route('services.one', $id));
    }

    // delete services
    public function destroy($id)
    {
        $service = DB::table('services')->where('id', $id);
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
