@extends('layouts.app')

@section('title', 'Internet Request')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-6 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-3xl font-semibold">Internet Request</h1>
    </header>

    <section class="max-w-sm md:max-w-md mx-auto bg-white shadow-md rounded-xl p-6 my-6">
        <form id="internetRequestForm">
            <input type="hidden" name="role" id="role" value="{{ auth()->user()->role }}">
            <input type="hidden" name="biometricID" id="biometricID" value="{{ auth()->user()->biometricID }}">
            <input type="hidden" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}">
            <input type="hidden" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}">
            <input type="hidden" name="medical_doctor" id="medical_doctor" value="{{ auth()->user()->medical_doctor }}">
            <input type="hidden" name="employment_status" id="employment_status" value="{{ auth()->user()->employment_status }}">
            <input type="hidden" name="division" id="division" value="{{ auth()->user()->division }}">
            <input type="hidden" name="department" id="department" value="{{ auth()->user()->department }}">
            <input type="hidden" name="position" id="position" value="{{ auth()->user()->position }}">

            <div class="mt-4">
                <label for="reason" class="block font-semibold text-gray-700">Reason <sup class="text-red-500">*</sup></label>
                <textarea name="reason" id="reason" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Type here..." required></textarea>
            </div>

            <div class="mt-4">
                <p class="block font-semibold text-gray-700">Device Type <sup class="text-red-500">*</sup></p>
                <em class="block text-gray-500 text-sm mb-2">Please select the correct device for validation.</em>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <input type="radio" name="device_type" id="AndroidSmartphone" value="Android Smartphone" required>
                        <label for="AndroidSmartphone" class="text-gray-700">Android Smartphone</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="AndroidTablet" value="Android Tablet" required>
                        <label for="AndroidTablet" class="text-gray-700">Android Tablet</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="WindowsLaptop" value="Windows Laptop" required>
                        <label for="WindowsLaptop" class="text-gray-700">Windows Laptop</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="iPhone" value="iPhone" required>
                        <label for="iPhone" class="text-gray-700">iPhone</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="iPad" value="iPad" required>
                        <label for="iPad" class="text-gray-700">iPad</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="MacBook" value="MacBook" required>
                        <label for="MacBook" class="text-gray-700">MacBook</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="wifi_mac_address" class="block font-semibold text-gray-700">Wi-Fi MAC Address <sup class="text-red-500">*</sup></label>
                <em class="block text-gray-500 text-sm">Example: AA:BB:CC:DD:EE:11</em>
                <input type="text" name="wifi_mac_address" id="wifi_mac_address" maxlength="17" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" autocomplete="off" required>
            </div>

            <div class="mt-4 p-2 border border-gray-300 rounded">
                <h1 class="font-semibold text-gray-700">How to get Wi-Fi MAC Address?</h1>
                <em class="mt-4 text-sm text-gray-700">Please connect your device to <b>BGHMC Wi-Fi</b> with a password <b>123456789</b> then switch to <u>Device MAC Address</u> for android and switch OFF to <u>Private Wi-Fi MAC Address</u> for iPhones.</em>

                <ul class="mt-4 text-sm text-gray-700">
                    <li><b>iPhone/iPad</b> Settings > General > About > Wi-Fi MAC Address</li>
                    <li><b>Android/Table</b> Settings > About Phone > Status Information > Phone Wi-Fi MAC Address</li>
                    <li><b>MAC O</b> Click the Wi-Fi icon (Upper Right) > Network Perefences > Advanced > Wi-Fi MAC Address</li>
                    <li><b>Windows OS</b> Search bar (Lower Left) > cmd > get mac -v > look for Wi-Fi > Physical Address column</li>
                </ul>
            </div>

            <div class="mt-4">
                <label for="pin_code" class="block font-semibold text-gray-700">Confirmed by IHOMP Technical on Duty <sup class="text-red-500">*</sup></label>
                <em class="block text-gray-500 text-sm">Please enter PIN code</em>
                <input type="password" name="pin_code" id="pin_code" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mt-6 flex justify-center">
                <button type="submit" class="w-30 text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Submit</button>
            </div>

        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.all.min.js"></script>

    <script>
        document.getElementById('wifi_mac_address').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^A-Fa-f0-9]/g, '');

            e.target.value = value.replace(/(.{2})(?=.)/g, '$1:');
        });

        document.getElementById('pin_code').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(document).ready(function () {
            $('#internetRequestForm').submit(function (e) {
                e.preventDefault();

                let selectedDeviceType = $('input[name="device_type"]:checked');

                if (selectedDeviceType.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required Field',
                        text: 'Please select Device Type.'
                    });
                    return;
                }

                let data = {
                    _token: "{{ csrf_token() }}",
                    role: $('#role').val(),
                    biometricID: $('#biometricID').val(),
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    medical_doctor: $('#medical_doctor').val(),
                    employment_status: $('#employment_status').val(),
                    division: $('#division').val(),
                    department: $('#department').val(),
                    position: $('#position').val(),
                    request_number: $('#request_number').val(),
                    reason: $('#reason').val(),
                    device_type: $('input[name="device_type"]:checked').val(),
                    wifi_mac_address: $('#wifi_mac_address').val(),
                    pin_code: $('#pin_code').val()
                };

                $.ajax({
                    url: "{{ route('user.request.internet.store') }}",
                    type: "POST",
                    data: data,
                    success: function (response) {
                        console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: 'Internet Request for ' + response.first_name + ' ' + response.last_name,
                                showCancelButton: true,
                                confirmButtonText: 'Preview',
                                cancelButtonText: 'Close',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = `/request/internet/print/${response.id}`;
                                } else {
                                    window.location.href = response.redirect
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                text: 'Your Pin Code is invalid. Please try again.'
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection