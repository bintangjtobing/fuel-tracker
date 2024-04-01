<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Track your activities - MileageMaster &copy;2024 - Personal Use</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- inject:css-->
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery-jvectormap-2.0.5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.Default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/star-rating-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/trumbowyg.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/wickedpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style 2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/mileageTrack-icon.png') }}">
</head>

<body>
    <main class="main-content">
        <div class="signUP-admin">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 p-0">
                        <div class="signUP-admin-left position-relative">
                            <div class="signUP-overlay">
                                <img class="svg signupTop" src="img/svg/signuptop.svg" alt="img" />
                                <img class="svg signupBottom" src="img/svg/signupbottom.svg" alt="img" />
                            </div>
                            <div class="signUP-admin-left__content">
                                <div class="text-capitalize mb-3 d-flex align-items-center justify-content-center">
                                    <a class="wh-36 bg-primary text-white radius-md mr-2" href="/">FT</a>
                                    <h1>MileageMaster</h1>
                                </div>
                                <p class="text-center">Fuel your passion, track your journey.</p>
                            </div>
                            <div class="signUP-admin-left__img">
                                <img class="img-fluid png" src="{{ asset('img/mileagemaster-logo.png') }}"
                                    alt="img" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="signUp-admin-right p-md-5 p-2">
                            <div class="edit-profile">
                                <div class="card border-0">
                                    <div class="card-header border-0 pb-3 pt-4">
                                        <h6 class="text-left">Track Activities with <span
                                                class="color-primary">MileageMaster</span></h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('fuel_entries.store') }}" method="POST">
                                            @csrf
                                            <div class="edit-profile__body">
                                                <div class="form-group mb-3">
                                                    <label for="fuel_date">Fuel Date</label>
                                                    <input type="date" name="fuel_date" class="form-control"
                                                        id="fuel_date">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="fuel_type">Fuel Type</label>
                                                    <select name="fuel_type" class="form-control" id="fuel_type">
                                                        <option selected>Select fuel type</option>
                                                        <option value="Pertalite">Pertalite</option>
                                                        <option value="Pertamax">Pertamax</option>
                                                        <option value="Pertamax Green">Pertamax Green</option>
                                                        <option value="Pertamax Turbo">Pertamax Turbo</option>
                                                        <option value="Pertamax Racing">Pertamax Racing</option>
                                                        <option value="Shell Super">Shell Super</option>
                                                        <option value="Shell V-Power">Shell V-Power</option>
                                                        <option value="Shell V-Power Nitro">Shell V-Power Nitro
                                                        </option>
                                                        <option value="Shell V-Power Diesel">Shell V-Power
                                                            Diesel</option>
                                                        <option value="Shell V-Power Diesel Extra">Shell
                                                            V-Power Diesel Extra</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="fuel_price">Fuel Price</label>
                                                    <input type="text" name="fuel_price"
                                                        class="form-control decimal-input" id="fuel_price"
                                                        placeholder="Fuel Price">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="fuel_amount">Fuel Amount</label>
                                                    <input type="text" name="fuel_amount"
                                                        class="form-control decimal-input" id="fuel_amount"
                                                        placeholder="Fuel Amount">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="service_date">Service Date</label>
                                                    <input type="date" name="service_date" class="form-control"
                                                        id="service_date">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="oil_type">Oil Type</label>
                                                    <input type="text" name="oil_type" class="form-control"
                                                        id="oil_type" placeholder="Oil Type">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="oil_name">Oil Name</label>
                                                    <input type="text" name="oil_name" class="form-control"
                                                        id="oil_name" placeholder="Oil Name">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="kilometers_traveled">Kilometers
                                                        Traveled</label>
                                                    <input type="text" name="kilometers_traveled"
                                                        class="form-control decimal-input" id="kilometers_traveled"
                                                        placeholder="Kilometers Traveled">
                                                </div>
                                                <div class="layout-button mt-4">
                                                    <button type="reset"
                                                        class="btn btn-default btn-sm px-4 mr-2">Reset Data</button>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm px-4">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <script>
        $(document).ready(function() {
            // Menggunakan jQuery untuk menangani submit form
            $('form').submit(function(event) {
                // Mencegah form dari pengiriman default
                event.preventDefault();

                // Lakukan AJAX request untuk mengirim data form
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Menampilkan pesan SweetAlert2 ketika data berhasil disimpan
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Data has been saved successfully.',
                        });
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan pesan SweetAlert2 ketika terjadi kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
            });
        });
    </script>

    <!-- inject:js-->
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/autoComplete.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/drawer.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicBadge.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicCheckbox.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/footable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/fullcalendar@5.2.0.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/google-chart.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.star-rating-svg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/message.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/muuri.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/notification.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/popover.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/wickedpicker.min.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/drag-drop.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/footable.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/full-calendar.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/googlemap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/icon-loader.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/jvectormap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/leaflet-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/main.js') }}"></script>
    <!-- endinject-->
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
</body>

</html>
