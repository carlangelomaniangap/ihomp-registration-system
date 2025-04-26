@extends('layouts.app')

@section('title', 'System Request')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-6 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-3xl font-semibold">System Request</h1>
    </header>

    <section class="max-w-sm md:max-w-md mx-auto bg-white shadow-md rounded-xl p-6 my-6">
        <form id="systemRequestForm">
            <input type="hidden" name="role" id="role" value="{{ auth()->user()->role }}">
            <input type="hidden" name="biometricID" id="biometricID" value="{{ auth()->user()->biometricID }}">
            <input type="hidden" name="medical_doctor" id="medical_doctor" value="{{ auth()->user()->medical_doctor }}">
            <input type="hidden" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}">
            <input type="hidden" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}">
            <input type="hidden" name="birthday" id="birthday" value="{{ auth()->user()->birthday }}">
            <input type="hidden" name="sex" id="sex" value="{{ auth()->user()->sex }}">
            <input type="hidden" name="civil_status" id="civil_status" value="{{ auth()->user()->civil_status }}">
            <input type="hidden" name="telephone_number" id="telephone_number" value="{{ auth()->user()->telephone_number }}">
            <input type="hidden" name="division" id="division" value="{{ auth()->user()->division }}">
            <input type="hidden" name="department" id="department" value="{{ auth()->user()->department }}">
            <input type="hidden" name="position" id="position" value="{{ auth()->user()->position }}">
            <input type="hidden" name="prc_license_number" id="prc_license_number" value="{{ auth()->user()->prc_license_number }}">
            <input type="hidden" name="expiration_date" id="expiration_date" value="{{ auth()->user()->expiration_date }}">
            <input type="hidden" name="employment_status" id="employment_status" value="{{ auth()->user()->employment_status }}">
            <input type="hidden" name="emr_sdn_user_profile" id="emr_sdn_user_profile" value="{{ auth()->user()->emr_sdn_user_profile }}">

            <div class="mt-4">
                <label for="username" class="block font-semibold text-gray-700">Username <sup class="text-red-500">*</sup></label>
                <input type="text" name="username" id="username" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" autocomplete="off" required>
            </div>

            <div class="mt-4">
                <label for="password" class="block font-semibold text-gray-700">Password <sup class="text-red-500">*</sup></label>
                <input type="password" name="password" id="password" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div class="mt-4">
                <label for="email" class="block font-semibold text-gray-700">Email <sup class="text-red-500">*</label>
                <input type="email" name="email" id="email" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" autocomplete="off" required>
            </div>

            <div class="mt-4">
                <label for="mobile_number" class="block font-semibold text-gray-700">Mobile Number <sup class="text-red-500">*</label>
                <input type="tel" name="mobile_number" id="mobile_number" maxlength="11" class="w-full mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" autocomplete="off" required>
            </div>

            <div class="mt-4">
                <p class="block font-semibold text-gray-700">Systems to be Enrolled <sup class="text-red-500">*</sup></p>

                <div class="grid grid-cols-1 gap-2 mt-2">
                    <div>
                        <input type="checkbox" name="systems_to_be_enrolled[]" id="EMR-SDN" value="EMR-SDN">
                        <label for="EMR-SDN" class="text-gray-700">EMR-SDN</label>
                    </div>

                    <div>
                        <input type="checkbox" name="systems_to_be_enrolled[]" id="HIMS" value="HIMS">
                        <label for="HIMS" class="text-gray-700">HIMS</label>
                    </div>

                    <div>
                        <input type="checkbox" name="systems_to_be_enrolled[]" id="PACS-RIS" value="PACS-RIS">
                        <label for="PACS-RIS" class="text-gray-700">PACS-RIS</label>
                    </div>
                </div>
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
        document.getElementById('mobile_number').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        document.getElementById('pin_code').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(document).ready(function () {
            $('#systemRequestForm').submit(function (e) {
                e.preventDefault();

                let selectedSystems = $('input[name="systems_to_be_enrolled[]"]:checked');

                if (selectedSystems.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Required Field',
                        text: 'Please select at least one under Systems to be Enrolled.'
                    });
                    return;
                }

                let data = {
                    _token: "{{ csrf_token() }}",
                    role: $('#role').val(),
                    biometricID: $('#biometricID').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    medical_doctor: $('#medical_doctor').val(),
                    first_name: $('#first_name').val(),
                    last_name: $('#last_name').val(),
                    birthday: $('#birthday').val(),
                    sex: $('#sex').val(),
                    civil_status: $('#civil_status').val(),
                    email: $('#email').val(),
                    mobile_number: $('#mobile_number').val(),
                    telephone_number: $('#telephone_number').val(),
                    division: $('#division').val(),
                    department: $('#department').val(),
                    position: $('#position').val(),
                    prc_license_number: $('#prc_license_number').val(),
                    expiration_date: $('#expiration_date').val(),
                    employment_status: $('#employment_status').val(),
                    systems_to_be_enrolled: $('input[name="systems_to_be_enrolled[]"]:checked').map(function() {
                        return this.value;
                    }).get(),
                    emr_sdn_user_profile: $('#emr_sdn_user_profile').val(),
                    pin_code: $('#pin_code').val(),
                };

                $.ajax({
                    url: "{{ route('user.request.system.store') }}",
                    type: "POST",
                    data: data,
                    success: function (response) {
                        console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                text: 'System Request for ' + response.first_name + ' ' + response.last_name,
                                showCancelButton: true,
                                confirmButtonText: 'Preview',
                                cancelButtonText: 'Close',
                            }).then((result) => {
                                window.location.href = response.redirect
                            });
                        }else if (response.error) {
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