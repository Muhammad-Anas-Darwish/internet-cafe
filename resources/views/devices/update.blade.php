<x-layout>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-1.jpg') }});</x-slot:body_style>

    <div class="form-box center">
        <div class="box">
            <h2>Device</h2>
            <form action="{{ route('devices.update', $device->number) }}" method="POST">
                @csrf
                @method('PUT')

                <select class="field" name="device_type_id" required>
                    <option value="">------</option>
                    @foreach ($devices_types as $device_type)
                        <option value="{{ $device_type->id }}" @if ($device->device_type_id === $device_type->id) selected @endif>{{ $device_type->name }}</option>
                    @endforeach
                </select>
                @error('device_type_id')
                    <div class="error"> - {{ $message }}</div>
                @enderror

                <input class="field" placeholder="Number" type="number" name="number" value="{{ old('number') }}" required>
                @error('number')
                    <div class="error"> - {{ $message }}</div>
                @enderror

                <label for="is_active"><p>Is Active:</p> </label>
                <input id="is_active" class="field check-box" type="checkbox" name="is_active" {{ $device->is_active ? 'checked' : '' }}>
                @error('is_active')
                    <div class="error"> - {{ $message }}</div>
                @enderror
                
                <input type="submit" value="Create">
            </form>
        </div>
    </div>
</x-layout>
