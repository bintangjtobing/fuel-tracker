@extends('welcome')
@section('title', 'Edit Transaction')
@section('content')
    <div class="col-lg-12">
        <div class="card card-Vertical card-default card-md mb-4">
            <div class="card-body pb-md-30">
                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 my-25 card-header">
                            <h6>Edit Transaction</h6>
                        </div>
                        <div class="col-md-12 mb-25 mt-25">
                            <label for="transaction_date" class="color-dark fs-14 fw-500 align-center">Transaction
                                Date</label>
                            <input type="date" name="transaction_date" value="{{ $transaction->transaction_date }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="transaction_date">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="product_name" class="color-dark fs-14 fw-500 align-center">Product Name</label>
                            <input type="text" name="product_name" value="{{ $transaction->product_name }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="product_name"
                                placeholder="Product Name">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="type_of_product" class="color-dark fs-14 fw-500 align-center">Type of
                                Product</label>
                            <select name="type_of_product" id="type_of_product"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15">
                                <option value="oli" {{ $transaction->type_of_product == 'oli' ? 'selected' : '' }}>Oli
                                </option>
                                <option value="servis" {{ $transaction->type_of_product == 'servis' ? 'selected' : '' }}>
                                    Servis</option>
                                <option value="lain-lain"
                                    {{ $transaction->type_of_product == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="quantity" class="color-dark fs-14 fw-500 align-center">Quantity</label>
                            <input type="number" name="quantity" value="{{ $transaction->quantity }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="quantity"
                                placeholder="Quantity" min="1">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="unit_price" class="color-dark fs-14 fw-500 align-center">Unit Price</label>
                            <input type="number" name="unit_price" value="{{ $transaction->unit_price }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15 decimal-input" id="unit_price"
                                placeholder="Unit Price" min="0">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="discount_price" class="color-dark fs-14 fw-500 align-center">Discount Price</label>
                            <input type="number" name="discount_price" value="{{ $transaction->discount_price }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15 decimal-input"
                                id="discount_price" placeholder="Discount Price" min="0">
                        </div>
                        <div class="col-md-6 mb-25">
                            <div class="layout-button mt-25">
                                <button type="reset"
                                    class="btn btn-default btn-squared border-normal bg-normal px-20">Reset Data</button>
                                <button type="submit" class="btn btn-primary btn-default btn-squared px-30">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.decimal-input').on('input', function() {
                // Mendapatkan nilai input
                var value = $(this).val();

                // Menghapus semua karakter selain angka
                var floatValue = parseFloat(value.replace(/[^\d]/g, ''));

                // Memeriksa apakah nilai adalah angka
                if (!isNaN(floatValue)) {
                    // Memformat nilai dengan separator ribuan
                    var formattedValue = floatValue.toLocaleString('id-ID');

                    // Memperbarui nilai input
                    $(this).val(formattedValue);
                }
            });
        });
    </script>
@endsection
