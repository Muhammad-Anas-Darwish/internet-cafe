{{--
    null
--}}

<x-layout>
    <div class="full-container">
        <div class="sidebar">
            @foreach ($devices as $device)
            <div color="{{$device->status['bg-trans']}}" id="device-{{$device->number}}" class="device">
                <h3 class="title">{{$device->device_type->name}} <span class="{{$device->status['bg']}}">{{$device->number}}</span></h3>
                {{-- <h3 status="{{$device->status['status']}}" class="time">@if (!is_null($device->customer()->remaining_time)) {{ substr($device->customer()->remaining_time, 0, 5) }} @endif </h3> --}}
                <h3 status="{{$device->status['status']}}" class="time">{{$device->customer()->remaining_time ?? ''}}</h3>
            </div>
            @endforeach
        </div>

        <div class="container content-container">
            @foreach ($devices as $device)
            <div color="{{$device->status['bg-trans']}}" id="device-{{$device->number}}" class="device"><span class="{{$device->status['bg']}}">{{$device->number}}</span>
                <img src="images/ps-4.png">
            </div>
            @endforeach
        </div>
    </div>

    <!-- Start Popups -->
    <div class="popup-background bg-trans-red hidden">
        @foreach ($devices as $device)
        @switch($device->status['status'])
            @case('end-time')
                <div id="popup-device-{{$device->number}}" class="popup three-sections end-time hidden">
                    <button class="exit"><i class="fas fa-times"></i></button>
                    <div class="up">
                        <div class="left">
                            <h4>Time: {{substr($device->customer()->total_time, 0, 5)}}</h4>
                            <h4>Hour price: ${{$device->device_type->price}}</h4>
                            <h4>Total time price: ${{$device->customer()->reserved_time_cost}}</h4>
                        </div>
                        <div class="right">
                            <h4>Services: ${{$device->customer()->services_cost}}</h4>
                            <h4>Taxes: ${{$device->customer()->taxes_cost}}</h4>
                            <h4 class="text-red">Total: ${{$device->customer()->total_cost}}
                                <form class="block-form" action="{{ route('customers.delete', $device->customer()->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            </h4>
                        </div>
                    </div>
                    <div class="down">
                        <div class="left">
                            <h3 class="text-blue">Services</h3>
                            @foreach ($device->customer()->sold_services as $sold_service_key => $sold_service)
                                <h4>{{ $sold_service->service->name }} {{ $sold_service->number }} * ${{ $sold_service->service->price }} = ${{ $sold_service->number * $sold_service->service->price }}</h4>
                                {{-- delete sold servcie --}}
                                <form class="block-form" action="{{ route('sold.services.delete', $sold_service->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach
                            <h4 class="text-orange">Total ${{$device->customer()->services_cost}}</h4>
                        </div>
                        <div class="right">
                            <h3 class="text-blue">Taxes</h3>
                            @foreach ($device->customer()->sold_taxes as $sold_taxe_key => $sold_taxe)
                                <h4>{{ $sold_taxe->taxe->name }} ${{ $sold_taxe->taxe->price }}</h4>
                                {{-- delete sold taxe --}}
                                <form class="block-form" action="{{ route('sold.taxes.delete', $sold_taxe->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach

                            <h4 class="text-orange">Total ${{$device->customer()->taxes_cost}}</h4>
                        </div>
                    </div>
                </div>
                @break
            @case('open-time')
                <div id="popup-device-{{$device->number}}" class="popup three-sections open-time hidden">
                    <button class="exit"><i class="fas fa-times"></i></button>
                    <div class="up">
                        <div class="left">
                            <h4>Time: {{substr($device->customer()->total_time, 0, 5)}}</h4>
                            <h4>Hour price: ${{$device->device_type->price}}</h4>
                            <h4>Total time price: ${{$device->customer()->reserved_time_cost}}</h4>
                        </div>
                        <div class="right">
                            <h4>Services: ${{$device->customer()->services_cost}}</h4>
                            <h4>Taxes: ${{$device->customer()->taxes_cost}}</h4>
                            <h4 class="text-red">Total: ${{$device->customer()->total_cost}}
                                <form class="block-form" action="{{ route('customers.delete', $device->customer()->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            </h4>
                        </div>
                    </div>
                    <div class="down">
                        <div class="left">
                            <h3 class="text-blue">Services</h3>
                            <form action="{{ route('sold.services.create') }}" method="post" class="one-line-form">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">

                                <select class="simple-input" name="service_id" required>
                                    <option value="">--------</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>

                                <input name="number" class="simple-input" type="number" min="1" name="" value="1" required>

                                <input type="submit" value=">">
                            </form>
                            @foreach ($device->customer()->sold_services as $sold_service_key => $sold_service)
                                <h4>{{ $sold_service->service->name }} {{ $sold_service->number }} * ${{ $sold_service->service->price }} = ${{ $sold_service->number * $sold_service->service->price }}</h4>
                                {{-- delete sold servcie --}}
                                <form class="block-form" action="{{ route('sold.services.delete', $sold_service->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach
                            <h4 class="text-orange">Total ${{$device->customer()->services_cost}}</h4>
                        </div>
                        <div class="right">
                            <h3 class="text-blue">Taxes</h3>
                            <form action="{{ route('sold.taxes.create') }}" method="post" class="one-line-form">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">
                                <select class="simple-input" name="taxe_id" required>
                                    <option value="">--------</option>

                                    @foreach ($taxes as $taxe)
                                        <option value="{{ $taxe->id }}">{{ $taxe->name }}</option>
                                    @endforeach
                                </select>

                                <input type="submit" value=">">
                            </form>

                            @foreach ($device->customer()->sold_taxes as $sold_taxe_key => $sold_taxe)
                                <h4>{{ $sold_taxe->taxe->name }} ${{ $sold_taxe->taxe->price }}</h4>
                                {{-- delete sold taxe --}}
                                <form class="block-form" action="{{ route('sold.taxes.delete', $sold_taxe->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach
                            <h4 class="text-orange">Total ${{$device->customer()->taxes_cost}}</h4>
                        </div>
                    </div>
                </div>
                @break
            @case('specific-time')
                <div id="popup-device-{{$device->number}}" class="popup three-sections specific-time hidden">
                    <button class="exit"><i class="fas fa-times"></i></button>
                    <div class="up">
                        <div class="left">
                            <h4>Time: {{substr($device->customer()->total_time, 0, 5)}}</h4>
                            <h4>Hour price: ${{$device->device_type->price}}</h4>
                            <h4>Total time price: ${{$device->customer()->reserved_time_cost}}</h4>
                            <h4 class="text-blue">Remaining Time: {{ substr($device->customer()->remaining_time, 0, 5) }}</h4>
                        </div>
                        <div class="right">
                            <h4>Services: ${{$device->customer()->services_cost}}</h4>
                            <h4>Taxes: ${{$device->customer()->taxes_cost}}</h4>
                            <h4>&ThinSpace;</h4>
                            <h4 class="text-red">Total: ${{$device->customer()->total_cost}}</h4>
                        </div>
                    </div>
                    <div class="down">
                        <div class="left">
                            <h3 class="text-blue">Services</h3>
                            <form action="{{ route('sold.services.create') }}" method="post" class="one-line-form">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">

                                <select class="simple-input" name="service_id" required>
                                    <option value="">--------</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>

                                <input name="number" class="simple-input" type="number" min="1" name="" value="1" required>

                                <input type="submit" value=">">
                            </form>
                            @foreach ($device->customer()->sold_services as $sold_service_key => $sold_service)
                                <h4>{{ $sold_service->service->name }} {{ $sold_service->number }} * ${{ $sold_service->service->price }} = ${{ $sold_service->number * $sold_service->service->price }}</h4>
                                {{-- delete sold servcie --}}
                                <form class="block-form" action="{{ route('sold.services.delete', $sold_service->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach
                            <h4 class="text-orange">Total ${{$device->customer()->services_cost}}</h4>
                        </div>
                        <div class="right">
                            <h3 class="text-blue">Taxes</h3>
                            <form action="{{ route('sold.taxes.create') }}" method="post" class="one-line-form">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{ $device->customer()->id }}">
                                <select class="simple-input" name="taxe_id" required>
                                    <option value="">--------</option>

                                    @foreach ($taxes as $taxe)
                                        <option value="{{ $taxe->id }}">{{ $taxe->name }}</option>
                                    @endforeach
                                </select>

                                <input type="submit" value=">">
                            </form>

                            @foreach ($device->customer()->sold_taxes as $sold_taxe_key => $sold_taxe)
                                <h4>{{ $sold_taxe->taxe->name }} ${{ $sold_taxe->taxe->price }}</h4>
                                {{-- delete sold taxe --}}
                                <form class="block-form" action="{{ route('sold.taxes.delete', $sold_taxe->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn bg-red">
                                </form>
                            @endforeach
                            <h4 class="text-orange">Total ${{$device->customer()->taxes_cost}}</h4>
                        </div>
                    </div>
                </div>
                @break
            @case('time')
                <div id="popup-device-{{$device->number}}" class="popup three-sections specific-time hidden">
                    <button class="exit"><i class="fas fa-times"></i></button>
                    <div class="up">
                        <div>
                            <h3>{{$device->device_type->name}} device $device->number</h3>
                            <form action="{{ route('customers.create') }}" method="post" class="one-line-form">
                                @csrf
                                <input type="hidden" name="device_id" value="{{ $device->number }}">

                                <label for="time">Time: </label>
                                <input name="reserved_time" pattern="(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]" id="time" class="simple-input" type="text" required>
                                <label for="is-open-time">Is open time: </label>
                                <input id="is-open-time" class="simple-input" type="checkbox" name="is_open_time">
                                <input type="submit" value=">">
                            </form>
                        </div>
                    </div>
                </div>
                @break
        @endswitch
        @endforeach
    </div>
    <!-- End Popups -->
</x-layout>
