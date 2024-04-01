@extends('welcome')
@section('title', 'Edit Track Activities')
@section('content')
    <div class="col-lg-8">
        <div class="card card-Vertical card-default card-md mb-4">
            <div class="card-body pb-md-30">
                <form action="{{ route('fuel_entries.update', $fuelEntry->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="card-header">
                            <h6>Edit Track Fuel</h6>
                        </div>
                        <div class="col-md-12 mb-25 mt-25">
                            <label for="fuel_date" class="color-dark fs-14 fw-500 align-center">Fuel Date</label>
                            <input type="date" name="fuel_date" value="{{ $fuelEntry->fuel_date }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="fuel_date">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="fuel_type" class="color-dark fs-14 fw-500 align-center">Fuel Type</label>
                            <select name="fuel_type" id="fuel_type"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15">
                                <option value="Pertalite" {{ $fuelEntry->fuel_type == 'Pertalite' ? 'selected' : '' }}>
                                    Pertalite</option>
                                <option value="Pertamax" {{ $fuelEntry->fuel_type == 'Pertamax' ? 'selected' : '' }}>
                                    Pertamax</option>
                                <option value="Pertamax Green"
                                    {{ $fuelEntry->fuel_type == 'Pertamax Green' ? 'selected' : '' }}>Pertamax Green
                                </option>
                                <option value="Pertamax Turbo"
                                    {{ $fuelEntry->fuel_type == 'Pertamax Turbo' ? 'selected' : '' }}>Pertamax Turbo
                                </option>
                                <option value="Pertamax Racing"
                                    {{ $fuelEntry->fuel_type == 'Pertamax Racing' ? 'selected' : '' }}>Pertamax Racing
                                </option>
                                <option value="Shell Super" {{ $fuelEntry->fuel_type == 'Shell Super' ? 'selected' : '' }}>
                                    Shell Super</option>
                                <option value="Shell V-Power"
                                    {{ $fuelEntry->fuel_type == 'Shell V-Power' ? 'selected' : '' }}>Shell V-Power</option>
                                <option value="Shell V-Power Nitro"
                                    {{ $fuelEntry->fuel_type == 'Shell V-Power Nitro' ? 'selected' : '' }}>Shell V-Power
                                    Nitro</option>
                                <option value="Shell V-Power Diesel"
                                    {{ $fuelEntry->fuel_type == 'Shell V-Power Diesel' ? 'selected' : '' }}>Shell V-Power
                                    Diesel</option>
                                <option value="Shell V-Power Diesel Extra"
                                    {{ $fuelEntry->fuel_type == 'Shell V-Power Diesel Extra' ? 'selected' : '' }}>Shell
                                    V-Power Diesel Extra</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="fuel_price" class="color-dark fs-14 fw-500 align-center">Fuel Price</label>
                            <input type="text" name="fuel_price" value="{{ $fuelEntry->fuel_price }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15 decimal-input" id="fuel_price"
                                placeholder="Fuel Price">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="fuel_amount" class="color-dark fs-14 fw-500 align-center">Fuel Amount</label>
                            <input type="text" name="fuel_amount" value="{{ $fuelEntry->fuel_amount }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15 decimal-input"
                                id="fuel_amount" placeholder="Fuel Amount">
                        </div>
                        <div class="col-md-12 my-25 card-header">
                            <h6>Edit Track Services</h6>
                        </div>
                        <div class="col-md-12 mb-25">
                            <label for="service_date" class="color-dark fs-14 fw-500 align-center">Service Date</label>
                            <input type="date" name="service_date" value="{{ $fuelEntry->service_date }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="service_date">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="oil_type" class="color-dark fs-14 fw-500 align-center">Oil Type</label>
                            <input type="text" name="oil_type" value="{{ $fuelEntry->oil_type }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="oil_type"
                                placeholder="Oil Type">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="oil_name" class="color-dark fs-14 fw-500 align-center">Oil Name</label>
                            <input type="text" name="oil_name" value="{{ $fuelEntry->oil_name }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15" id="oil_name"
                                placeholder="Oil Name">
                        </div>
                        <div class="col-md-6 mb-25">
                            <label for="kilometers_traveled" class="color-dark fs-14 fw-500 align-center">Kilometers
                                Traveled</label>
                            <input type="text" name="kilometers_traveled" value="{{ $fuelEntry->kilometers_traveled }}"
                                class="form-control ih-medium ip-gray radius-xs b-light px-15 decimal-input"
                                id="kilometers_traveled" placeholder="Kilometers Traveled">
                        </div>
                        <div class="col-md-6 mb-25">
                            <div class="layout-button mt-25">
                                <button type="button" class="btn btn-default btn-squared border-normal bg-normal px-20"
                                    onclick="window.history.back();">Cancel</button>
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
