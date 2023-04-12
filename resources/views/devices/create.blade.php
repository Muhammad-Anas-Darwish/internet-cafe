<x-layout>
    <h3>Create Device</h3>

    <form action="{{ route('devices.create') }}" method="post">
        @csrf
        <div>
            <label for="device_type_id">Device Type Id: </label>
            <select name="device_type_id" required>
                <option value="">------------------</option>
                @foreach ($devices_types as $device_type)
                    <option value="{{ $device_type->id }}" @if (old('device_type_id') == $device_type->id) selected @endif>{{ $device_type->name }}</option>
                @endforeach
            </select>
            @error('device_type_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        {{-- <div>
            <label for="device_type_id">Device Type Id: </label>
            <input type="text" name="device_type_id" value="{{ old('device_type_id') }}" required>
            @error('device_type_id')
                <div>{{ $message }}</div>
            @enderror
        </div> --}}
        <div>
            <label for="number">Number: </label>
            <input type="number" name="number" value="{{ old('number') }}" required>
            @error('number')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="is_active">Is Active: </label>
            <input type="checkbox" name="is_active" @if(old('is_active')) checked @endif>
            @error('is_active')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Save">
    </form>
</x-layout>
