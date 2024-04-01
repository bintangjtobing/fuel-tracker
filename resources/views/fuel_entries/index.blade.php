@extends('welcome')
@section('title', 'Fuel Track Activities')
@section('addNewData')
    <div class="action-btn">
        <a href="/fuel-track/create" class="btn btn-sm btn-primary btn-add">
            <i class="la la-plus"></i> Add New</a>
    </div>
@endsection
@section('content')
    <div class="col-lg-12 mb-25">
        <div class="social-overview-wrap">

            <div class="card border-0">
                <div class="card-body p-0">

                    <div class="table4 table5 p-25 bg-white">
                        <div class="table-responsive">
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
                                        <th>
                                            <div class="userDatatable-title">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($fuelEntries as $fuelEntry)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6>{{ $fuelEntry->fuel_type ?? 'N/A' }}
                                                            </h6>
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
                                                            <h6>Rp.
                                                                {{ number_format($fuelEntry->fuel_amount, 2, ',', '.') ?? 'N/A' }}
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
                                                <div class="userDatatable-content">{{ $fuelEntry->service_date ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6>{{ $fuelEntry->oil_name ?? 'N/A' }}
                                                            </h6>
                                                        </a>
                                                        <p class="pt-1 d-block mb-0">
                                                            Oil Type: <b>{{ $fuelEntry->oil_type ?? 'N/A' }}</b>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ number_format($fuelEntry->kilometers_traveled, 2, ',', '.') ?? 'N/A' }}
                                                    KM
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    <li>
                                                        <a href="{{ route('fuel_entries.edit', $fuelEntry->id) }}"
                                                            class="edit">
                                                            <span data-feather="edit"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('fuel_entries.destroy', $fuelEntry->id) }}"
                                                            method="POST" class="remove">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                style="height: 40px;border-radius: 50%;color: #F59191 !important;"
                                                                type="submit" class="btn btn-link remove"
                                                                onclick="return confirm('Are you sure you want to delete this entry?')">
                                                                <span data-feather="trash-2"></span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
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
                        <div class="d-flex justify-content-between mt-30">
                            <div class="pagination-info">
                                Showing {{ $fuelEntries->firstItem() }} to {{ $fuelEntries->lastItem() }} of
                                {{ $fuelEntries->total() }} items
                            </div>

                            <nav class="atbd-page">
                                <ul class="atbd-pagination d-flex">
                                    <li class="atbd-pagination__item">
                                        @if ($fuelEntries->onFirstPage())
                                            <span class="disabled" aria-disabled="true" aria-label="Previous">
                                                <span aria-hidden="true">&laquo; Previous</span>
                                            </span>
                                        @else
                                            <a href="{{ $fuelEntries->previousPageUrl() }}" rel="prev"
                                                aria-label="Previous">
                                                &laquo; Previous
                                            </a>
                                        @endif
                                    </li>

                                    <li class="atbd-pagination__item">
                                        @if ($fuelEntries->hasMorePages())
                                            <a href="{{ $fuelEntries->nextPageUrl() }}" rel="next" aria-label="Next">
                                                Next &raquo;
                                            </a>
                                        @else
                                            <span class="disabled" aria-disabled="true" aria-label="Next">
                                                <span aria-hidden="true">Next &raquo;</span>
                                            </span>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
