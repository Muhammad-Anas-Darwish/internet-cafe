<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\DevicesTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DevicesController extends Controller
{
    // show all devices
    public function index(): View
    {
        $devices = Devices::all();

        $context = [
            'devices' => $devices,
        ];
        return view('devices.devices', $context);
    }

    // show one devices
    public function show($number): View
    {
        $device = Devices::where('number', $number)->first();

        $context = [
            'device' => $device,
        ];
        return view('devices.device', $context);
    }

    // create devices
    public function create(): View
    {
        $types = DevicesTypes::all('id','name');

        return view('devices.create')->with('devices_types', $types);
    }

    // store device
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'device_type_id' => 'required|exists:devices_types,id',
            'number' => 'required|unique:devices'
        ]);

        Devices::create([
            'device_type_id' => $request['device_type_id'],
            'number' => $request['number'],
            'is_active' => $request['is_active'] ? 1 : 0
        ]);

        session()->flash('status', 'Device ' . $request['number'] . ' created successful!');

        return redirect(route('devices.list'));
    }

    // edit devices
    public function edit($number): View
    {
        $types = DevicesTypes::all('id','name');
        $device = Devices::where('number', $number)->first();

        $context = [
            'device' => $device,
            'devices_types' => $types
        ];
        return view('devices.update', $context);
    }

    // update devices
    public function update(Request $request, $number): RedirectResponse
    {
        $validated = $request->validate([
            'device_type_id' => 'required',
        ]);

        $device = Devices::where('number', $number)->update([
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
        $device = Devices::where('number', $number);
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
