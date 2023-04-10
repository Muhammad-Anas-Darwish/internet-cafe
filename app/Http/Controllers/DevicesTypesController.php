<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevicesTypesController extends Controller
{
    // show all devices_types
    public function devices_types(): View
    {
        $types = DB::table('devices_types')->get();

        $context = [
            'devices_types' => $types,
        ];
        return view('devices_types.devices_types', $context);
    }

    // show one devices_types
    public function device_type($id): View
    {
        $type = DB::table('devices_types')->where('id', $id)->first();

        $context = [
            'device_type' => $type,
        ];
        return view('devices_types.device_type', $context);
    }

    // create devices_types
    public function create(): View
    {
        return view('devices_types.create');
    }

    // store device_type
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        if ($validated) {
            DB::table('devices_types')->insert([
                'name' => $request['name'],
                'price' => $request['price']
            ]);
            session()->flash('status', 'Device type save successful!');
        }
        else {
            session()->flash('status', 'Device Type Data not valid!');
        }
        return redirect(route('devices_types.list'));
    }

    // update devices_types
    public function update($id)
    {
        $type = DB::table('devices_types')->where('id', $id)->first();

        $context = [
            'device_type' => $type,
        ];
        return view('devices_types.update', $context);
    }

    // update store devices_types
    public function update_store(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        if ($validated) {
            $type = DB::table('devices_types')->where('id', $id)->update([
                'name' => $request['name'],
                'price' => $request['price']
            ]);
            if ($type) {
                session()->flash('status', 'Device type save successful!');
            }
        }
        else {
            session()->flash('status', 'Device Type Data not valid!');
            return redirect(route('devices_types.update'));
        }

        return redirect(route('devices_types.one', $id));
    }

    // delete devices_types
    public function destroy($id)
    {
        $device_type = DB::table('devices_types')->where('id', $id);
        if ($device_type->exists()) {
            $name = $device_type->first()->name;
            $device_type->delete();
            session()->flash('status', $name . ' Deleted Successful!');
        }
        else {
            session()->flash('status', 'Device Type is already not exsist!');
        }

        return redirect(route('devices_types.list'));
    }
}
