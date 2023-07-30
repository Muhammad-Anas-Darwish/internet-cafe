<?php

namespace App\Http\Controllers;

use App\Models\DevicesTypes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DevicesTypesController extends Controller
{
    // show all devices_types
    public function index(): View
    {
        $types = DevicesTypes::all();

        $context = [
            'devices_types' => $types,
        ];
        return view('devices_types.devices_types', $context);
    }

    // show one devices_types
    public function show($id): View
    {
        $type = DevicesTypes::find($id);

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
            'price' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('images'), $imageName);

        DevicesTypes::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $imageName,
        ]);
        session()->flash('status', 'Device type save successful!');

        return redirect(route('devices_types.list'));
    }

    // edit devices_types
    public function edit($id)
    {
        $type = DevicesTypes::find($id);

        $context = [
            'device_type' => $type,
        ];
        return view('devices_types.update', $context);
    }

    // update devices_types
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required'
        ]);

        $type = DevicesTypes::find($id)->update([
            'name' => $request['name'],
            'price' => $request['price']
        ]);
        if ($type) {
            session()->flash('status', 'Device type save successful!');
        }

        return redirect(route('devices_types.one', $id));
    }

    // delete devices_types
    public function destroy($id)
    {
        $device_type = DevicesTypes::find($id);

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
