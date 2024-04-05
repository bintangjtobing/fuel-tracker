@extends('welcome')
@section('title', 'Transaction List')
@section('addNewData')
    <div class="action-btn">
        <a href="/transactions/create" class="btn btn-sm btn-primary btn-add">
            <i class="la la-plus"></i> Add New</a>
    </div>
@endsection
@section('content')
    <div class="col-lg-12 mb-25">
        <div class="social-overview-wrap">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="table4 table5 p-25 bg-white"></div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr class="userDatatable-header">
                                    <th>
                                        <div class="userDatatable-title">No</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Transaction Date</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Product Name</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Type of Product</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Quantity</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Unit Price (Rp)</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Discount Price (Rp)</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Total Price (Rp)</div>
                                    </th>
                                    <th>
                                        <div class="userDatatable-title">Action</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $key => $transaction)
                                    <tr class="userDatatable-header">
                                        <td>
                                            <div class="userDatatable-content">{{ $transactions->firstItem() + $key }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">{{ $transaction->transaction_date }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">{{ $transaction->product_name }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">{{ ucfirst($transaction->type_of_product) }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">{{ $transaction->quantity }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{ number_format($transaction->unit_price, 2, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{ number_format($transaction->discount_price, 2, ',', '.') }}</div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                {{ number_format($transaction->quantity * $transaction->unit_price - $transaction->discount_price, 2, ',', '.') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="userDatatable-content">
                                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <div class="userDatatable-content">No data available in the database</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between mt-30">
                        <div class="pagination-info">
                            Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of
                            {{ $transactions->total() }} items
                        </div>

                        <nav class="atbd-page">
                            <ul class="atbd-pagination d-flex">
                                <li class="atbd-pagination__item">
                                    @if ($transactions->onFirstPage())
                                        <span class="disabled" aria-disabled="true" aria-label="Previous">
                                            <span aria-hidden="true">&laquo; Previous</span>
                                        </span>
                                    @else
                                        <a href="{{ $transactions->previousPageUrl() }}" rel="prev"
                                            aria-label="Previous">
                                            &laquo; Previous
                                        </a>
                                    @endif
                                </li>

                                <li class="atbd-pagination__item">
                                    @if ($transactions->hasMorePages())
                                        <a href="{{ $transactions->nextPageUrl() }}" rel="next" aria-label="Next">
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
@endsection
