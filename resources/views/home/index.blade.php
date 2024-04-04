@extends('welcome')
@section('title', 'Dashboard')
@section('content')
    <div class="col-xxl-12 col-12">
        <div class="row">
            <div class="col-md-3">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Distance</h6>
                    <div class="forcast-details" style="margin-bottom:0;">
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
            <div class="col-md-3">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Cheapest Fuel Price</h6>
                    <div class="forcast-details" style="margin-bottom:0;">
                        <p class="forcast-status mb-0">({{ $cheapestFuel->fuel_type }})</h4>
                        <h1 class="forcast-value">Rp. {{ number_format($cheapestFuel->fuel_price, 2, '.', ',') }}</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-danger">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeFuel, 2, '.', ',') }}%</span>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Fuel Usage</h6>
                    <div class="forcast-details" style="margin-bottom:0;">
                        <h1 class="forcast-value">{{ number_format($averageFuelUsage, 2, '.', ',') }} Liters</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-success">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeFuel, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Over
                                {{ number_format($averageWeeksBetweenRefueling, 2, '.', ',') }} weeks</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Total Cost</h6>
                    <div class="forcast-details" style="margin-bottom:0;">
                        <h1 class="forcast-value">Rp. {{ number_format($averageTotalCost, 2, '.', ',') }}</h1>
                        <p class="forcast-status pb-20">
                            <span class="percentage color-danger">
                                <span data-feather="arrow-up"></span>
                                <span>{{ number_format($percentageChangeCost, 2, '.', ',') }}%</span>
                            </span>
                            <span class="forcast-text">Over
                                {{ number_format($averageWeeksBetweenRefueling, 2, '.', ',') }} weeks</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="forcast-cardbox">
                    <h6 class="forcast-title">Average Fuel Usage per Day</h6>
                    <div class="forcast-details pb-20">
                        <h1 class="forcast-value">{{ number_format($averageFuelUsagePerDay, 2, '.', ',') }} L
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 mb-25">
        <div class="card border-0">
            <div class="card-header">
                <h3><strong>Fuel & Services Track Activity</strong></h3>
                <div class="action-btn">
                    <a href="/fuel-track/create" class="btn btn-sm btn-primary d-none d-md-block">
                        <i class="la la-plus"></i> Add Transactions</a>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-xl mb-0">
                        <thead>
                            <tr class="userDatatable-header" style="font-size: .8rem;">
                                <th class="py-3 px-0" style="vertical-align:middle;">Fuel Type</th>
                                <th class="py-3 px-2" style="text-align:right; vertical-align:middle;">Fuel Amount (IDR)
                                </th>
                                <th class="py-3 px-0" style="vertical-align:middle;">Service</th>
                                <th class="py-3 px-0" style="vertical-align:middle; text-align:right;">Odometer (Km)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fuelEntriesData as $fuelEntry)
                                <tr style="font-size: .8rem;">
                                    <td style="vertical-align: middle;">
                                        {{ $fuelEntry->fuel_type ?? 'N/A' }} <br>
                                        <div class="text-muted fs-12">Fuels Date:
                                            <span class="text-muted">{{ $fuelEntry->fuel_date ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; text-align:right;" class="pr-2">
                                        {{ number_format($fuelEntry->fuel_amount, 2, ',', '.') ?? 'N/A' }} <br>
                                        <span class="text-muted">
                                            @if ($fuelEntry->fuel_price != 0)
                                                {{ number_format($fuelEntry->fuel_amount / $fuelEntry->fuel_price, 2, ',', '.') }}
                                                Liters
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </td>
                                    <td style="vertical-align: middle;">{{ $fuelEntry->service_date ?? 'N/A' }}
                                        <br>
                                        <span class="text-muted">Oil name: {{ $fuelEntry->oil_name ?? 'N/A' }}</span> <br>
                                        <span class="text-muted">Oil type:{{ $fuelEntry->oil_type ?? 'N/A' }}</span>
                                    </td>
                                    <td style="vertical-align: middle; text-align:right;" class="pr-0">
                                        {{ number_format($fuelEntry->kilometers_traveled, 2, ',', '.') ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <div class="text-muted fs-13">No data available in the database</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3 d-md-none">
                    <a href="/fuel-track/create" class="btn btn-sm btn-primary btn-add btn-block">
                        <i class="la la-plus"></i> Add Transactions</a>
                </div>
            </div>
        </div>
    </div>





@endsection
