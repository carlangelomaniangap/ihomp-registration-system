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
            <input type="hidden" name="name" id="name" value="{{ auth()->user()->name }}">
            <input type="hidden" name="medical_doctor" id="medical_doctor" value="{{ auth()->user()->medical_doctor }}">
            <input type="hidden" name="employment_status" id="employment_status" value="{{ auth()->user()->employment_status }}">
            <input type="hidden" name="division" id="division" value="{{ auth()->user()->division }}">
            <input type="hidden" name="department" id="department" value="{{ auth()->user()->department }}">
            <input type="hidden" name="position" id="position" value="{{ auth()->user()->position }}">

            <div class="mt-4">
                <label for="request_number" class="block font-semibold text-gray-700">Request Number <sup class="text-red-500">*</sup></label>
                <select name="request_number" id="request_number" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option selected disabled value="">Select Here</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="mt-4">
                <label for="reason" class="block font-semibold text-gray-700">Reason <sup class="text-red-500">*</sup></label>
                <textarea name="reason" id="reason" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Type here..." required></textarea>
            </div>

            <div class="mt-4">
                <label for="device_type" class="block font-semibold text-gray-700">Device Type <sup class="text-red-500">*</sup></label>
                <em class="block text-gray-500 text-sm mb-2">Please select the correct device for validation.</em>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <input type="radio" name="device_type" id="AndroidSmartphone" value="AndroidSmartphone" required>
                        <label for="AndroidSmartphone" class="">Android Smartphone</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="AndroidTablet" value="AndroidTablet" required>
                        <label for="AndroidTablet" class="">Android Tablet</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="WindowsLaptop" value="WindowsLaptop" required>
                        <label for="WindowsLaptop" class="">Windows Laptop</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="iPhone" value="iPhone" required>
                        <label for="iPhone" class="">iPhone</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="iPad" value="iPad" required>
                        <label for="iPad" class="">iPad</label>
                    </div>

                    <div>
                        <input type="radio" name="device_type" id="MacBook" value="MacBook" required>
                        <label for="MacBook" class="">MacBook</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label for="wifi_mac_address" class="block font-semibold text-gray-700">Wi-Fi MAC Address <sup class="text-red-500">*</sup></label>
                <em class="block text-gray-500 text-sm">Example: AA:BB:CC:DD:EE:11</em>
                <input type="text" name="wifi_mac_address" id="wifi_mac_address" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mt-4">
                <label for="pin_code" class="block font-semibold text-gray-700">Confirmed by IHOMP Technical on Duty <sup class="text-red-500">*</sup></label>
                <em class="block text-gray-500 text-sm">Please enter PIN code</em>
                <input type="number" name="pin_code" id="pin_code" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mt-6 flex justify-center">
                <button type="submit" class="w-30 text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Submit</button>
            </div>

        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#internetRequestForm').submit(function (e) {
                e.preventDefault();

                let data = {
                    _token: "{{ csrf_token() }}",
                    role: $('#role').val(),
                    biometricID: $('#biometricID').val(),
                    name: $('#name').val(),
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
                                title: 'Submitted successfully!',
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                window.location.href = response.redirect
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Submitted Failed',
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection