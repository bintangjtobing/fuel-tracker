@extends('welcome')
@section('title', 'Dashboard')
@section('content')
    <div class="col-xxl-12 col-12">
        <div class="row">
            <div class="col-md-3 mb-25">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Distance</h6>
                    <div class="forcast-details">
                        <h1 class="forcast-value">{{ number_format($averageDistance, 2, '.', ',') }} KM</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-success">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeDistance, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-25">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Cheapest Fuel Price</h6>
                    <div class="forcast-details">
                        <p class="forcast-status mb-0">({{ $cheapestFuel->fuel_type }})</h4>
                        <h1 class="forcast-value">Rp. {{ number_format($cheapestFuel->fuel_price, 2, '.', ',') }}</h1>
                        <p class="forcast-status">
                            <span class="percentage color-danger">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeFuel, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-25">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Fuel Usage</h6>
                    <div class="forcast-details">
                        <h1 class="forcast-value">{{ number_format($averageFuelUsage, 2, '.', ',') }} Liters</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-success">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeCost, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-25">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Total Cost</h6>
                    <div class="forcast-details">
                        <h1 class="forcast-value">Rp. {{ number_format($averageTotalCost, 2, '.', ',') }}</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-danger">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeCost, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Since last month</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 mb-25">
        <div class="card border-0">
            <div class="card-header">
                <h6>Fuel & Services Track Activity</h6>
            </div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr class="userDatatable-header">
                            <th>
                                <div class="userDatatable-title">Fuel Type</div>
                            </th>
                            <th>
                                <div class="userDatatable-title">Fuel Amount</div>
                            </th>
                            <th>
                                <div class="userDatatable-title">Number of Liters</div>
                            </th>
                            <th>
                                <div class="userDatatable-title">Service Date</div>
                            </th>
                            <th>
                                <div class="userDatatable-title">Oil Name</div>
                            </th>
                            <th>
                                <div class="userDatatable-title">Kilometers Traveled</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fuelEntriesData as $fuelEntry)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="userDatatable-inline-title">
                                            <a href="#" class="text-dark fw-500">
                                                <h6>{{ $fuelEntry->fuel_type ?? 'N/A' }}</h6>
                                            </a>
                                            <p class="pt-1 d-block mb-0">
                                                Fuels Date: <b>{{ $fuelEntry->fuel_date ?? 'N/A' }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="userDatatable-inline-title">
                                            <a href="#" class="text-dark fw-500">
                                                <h6>Rp. {{ number_format($fuelEntry->fuel_amount, 2, ',', '.') ?? 'N/A' }}
                                                </h6>
                                            </a>
                                            <p class="pt-1 d-block mb-0">
                                                Fuels price /L: <b>Rp.
                                                    {{ number_format($fuelEntry->fuel_price, 2, ',', '.') ?? 'N/A' }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="userDatatable-content">
                                        @if ($fuelEntry->fuel_price != 0)
                                            {{ number_format($fuelEntry->fuel_amount / $fuelEntry->fuel_price, 2, ',', '.') }}
                                            Liters
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="userDatatable-content">{{ $fuelEntry->service_date ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="userDatatable-inline-title">
                                            <a href="#" class="text-dark fw-500">
                                                <h6>{{ $fuelEntry->oil_name ?? 'N/A' }}</h6>
                                            </a>
                                            <p class="pt-1 d-block mb-0">
                                                Oil Type: <b>{{ $fuelEntry->oil_type ?? 'N/A' }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="userDatatable-content">
                                        {{ number_format($fuelEntry->kilometers_traveled, 2, ',', '.') ?? 'N/A' }} KM
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="userDatatable-content">No data available in the database</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
