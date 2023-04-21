<x-layout>
    <div>
        @foreach ($devices as $device)
            <div style="display:flex; justify-content: space-around; background-color: #ccc; margin: 10px; padding: 10px 20px;">
                <div>
                    <h4>{{ $device->device_type->name }}</h4>
                    <h3>Device {{ $device->number }}</h3>
                    <h4>Is Active: {{ $device->is_active }}</h4>
                </div>
                <div>
                    @if (!is_null($device->customer()) && ($device->customer()->remaining_time !== false || $device->is_open_time))
                        @if ($device->customer()->is_open_time)
                            <h4 style="color: #8a1199">{{ $device->customer()->remaining_time }}</h4>
                            <h5>Open time</h5>
                        @else
                            <h4 style="color: #1e1eff;">{{ $device->customer()->remaining_time }}</h4>
                            <h5>Not open time</h5>
                        @endif
                        {{-- Sold servcies --}}
                        <div>
                            @foreach ($device->customer()->sold_services as $sold_service_key => $sold_service)
                                {{ $sold_service->service->name }} - {{ $sold_service->service->price }}$ * {{ $sold_service->number }}
                                {{-- delete sold servcie --}}
                                <form action="{{ route('sold.services.delete', $sold_service->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="delete">
                                </form>
                                <hr>
                            @endforeach
                            <p style="color: #0915ff">Sold services total: {{ $device->customer()->services_cost }}$</p>
                        </div>
                        {{-- Sold taxes --}}
                        <div>
                            @foreach ($device->customer()->sold_taxes as $sold_taxe_key => $sold_taxe)
                                {{ $sold_taxe->taxe->name }} - {{ $sold_taxe->taxe->price }}$
                                {{-- delete sold taxe --}}
                                <form action="{{ route('sold.taxes.delete', $sold_taxe->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="delete">
                                </form>
                                <hr>
                            @endforeach

                            <p style="color: #0915ff">Sold taxes total: {{ $device->customer()->taxes_cost }}$</p>

                        </div>
                        <div>
                            <p style="color: #0915ff">Time: {{ $device->customer()->total_time }} - {{ $device->customer()->reserved_time_cost }}$</p>
                        </div>
                        <div>
                            <p style="color: #ff1511">Total cost: {{ $device->customer()->total_cost }}$</p>
                        </div>
                        {{-- update customer --}}
                        <form action="{{ route('customers.update', $device->customer()->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="is_open_time">Is open time: </label>
                                <input type="checkbox" name="is_open_time" @checked($device->customer()->is_open_time)>
                                @error('is_open_time')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Update">
                        </form>
                        {{-- delete customer --}}
                        <form action="{{ route('customers.delete', $device->customer()->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="delete">
                        </form>
                        {{-- create sold service --}}
                        <form action="{{ route('sold.services.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">
                            <div>
                                <label for="service_id">Service: </label>
                                <select name="service_id" required>
                                    <option value="">------------------</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" @if (old('service_id') == $service->id) selected @endif>{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <input type="number" name="number" min="1" value="{{ old('number') }}" required>
                                @error('number')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Add">
                        </form>
                        {{-- create sold taxe --}}
                        <form action="{{ route('sold.taxes.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">
                            <div>
                                <label for="taxe_id">Taxes: </label>
                                <select name="taxe_id" required>
                                    <option value="">------------------</option>
                                    @foreach ($taxes as $taxe)
                                        <option value="{{ $taxe->id }}" @if (old('taxe_id') == $taxe->id) selected @endif>{{ $taxe->name }}</option>
                                    @endforeach
                                </select>
                                @error('taxe_id')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Add">
                        </form>
                    @elseif (!is_null($device->customer()))
                        <h3>time ended</h3>
                    @else
                        <form action="{{ route('customers.create') }}" method="post">
                            @csrf
                            <input type="hidden" name="device_id" value="{{ $device->number }}">
                            <div>
                                <label for="reserved_time">Reserved time: </label>
                                <input type="time" name="reserved_time" value="{{ old('reserved_time') }}" required>
                                @error('reserved_time')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="is_open_time">Is open time: </label>
                                <input type="checkbox" name="is_open_time" @if(old('is_open_time')) @endif>
                                @error('is_open_time')
                                    <div>{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Create">
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
