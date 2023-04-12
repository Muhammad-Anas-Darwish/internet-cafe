<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\DevicesTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DevicesController extends Controller
{
    // show all devices
    public function devices(): View
    {
        $devices = DB::table('devices')->get();

        $context = [
            'devices' => $devices,
        ];
        return view('devices.devices', $context);
    }

    // show one devices
    public function device($number): View
    {
        $device = DB::table('devices')->where('number', $number)->first();

        $context = [
            'device' => $device,
        ];
        return view('devices.device', $context);
    }

    // create devices
    public function create(): View
    {
        $types = DB::table('devices_types')->select('id','name')->get();

        return view('devices.create')->with('devices_types', $types);
    }

    // store device
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'device_type_id' => 'required|exists:devices_types,id',
            'number' => 'required|unique:devices'
        ]);

        DB::table('devices')->insert([
            'device_type_id' => $request['device_type_id'],
            'number' => $request['number'],
            'is_active' => $request['is_active'] ? 1 : 0
        ]);
        session()->flash('status', 'Device ' . $request['number'] . ' created successful!');

        return redirect(route('devices.list'));
    }

    // update devices
    public function update($number): View
    {
        $types = DB::table('devices_types')->select('id','name')->get();
        $device = DB::table('devices')->where('number', $number)->first();

        $context = [
            'device' => $device,
            'devices_types' => $types
        ];
        return view('devices.update', $context);
    }

    // update store devices
    public function update_store(Request $request, $number): RedirectResponse
    {
        $validated = $request->validate([
            'device_type_id' => 'required',
        ]);

        $device = DB::table('devices')->where('number', $number)->update([
            'device_type_id' => $request['device_type_id'],
            'is_active' => $request['is_active'] ? 1 : 0
        ]);

        if ($device) {
            session()->flash('status', 'Device updated successful!');
        }

        return redirect(route('devices.one', $request['number']));
    }

    // delete devices
    public function destroy($number): RedirectResponse
    {
        $device = DB::table('devices')->where('number', $number);
        if ($device->exists()) {
            $device->delete();
            session()->flash('status', 'Device ' . $number . ' Deleted Successful!');
        }
        else {
            session()->flash('status', 'Device is already not exsist!');
        }

        return redirect(route('devices.list'));
    }
}
