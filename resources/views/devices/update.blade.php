<x-layout>
    <h3>Update Device {{ $device->number }}</h3>

    <form action="{{ route('devices.update', $device->number) }}" method="post">
        @csrf
        @method('PUT')

        <div>
            <label for="device_type_id">Device Type Id: </label>
            <select name="device_type_id" required>
                <option value="">------------------</option>
                @foreach ($devices_types as $device_type)
                    <option value="{{ $device_type->id }}" @if ($device->device_type_id === $device_type->id) selected @endif>{{ $device_type->name }}</option>
                @endforeach
            </select>
            @error('device_type_id')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="is_active">Is Active: </label>
            <input type="checkbox" name="is_active" {{ $device->is_active ? 'checked' : '' }}>
            @error('is_active')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Update">
    </form>
</x-layout>
