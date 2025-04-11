@extends('layouts.guest')

@section('title', 'IHOMP Registration System')

@section('content')

    <div class="grid grid-cols-2">
        
        <div class="flex flex-col justify-center items-center">

            <div class="w-100 h-100 bg-[#21a1c2] shadow-lg py-4 px-12 rounded-lg">
                <div class="text-gray-900 text-center py-4">
                    <h1 class="font-bold text-3xl">IHOMP</h1>
                    <h2 class="font-semibold text-2xl">Registration System</h2>
                </div>

                <form id="loginForm">

                    <div class="mt-2">
                        <label for="biometricID" class="text-gray-900 font-semibold">Biometric ID <sup class="text-red-500">*</sup></label>
                        <input type="number" id="biometricID" name="biometricID" class="w-full bg-white mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0c6980]" required>
                    </div>

                    <div class="mt-2">
                        <label for="first_name" class="text-gray-900 font-semibold">First Name <sup class="text-red-500">*</sup></label>
                        <input type="text" id="first_name" name="first_name" class="w-full bg-white mt-1 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0c6980]" autocomplete="off" required>
                    </div>

                    <div class="mt-2">
                        <label>
                            <input type="checkbox" name="remember" id="remember"> Remember Me
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full font-semibold bg-gray-900 text-white rounded px-2 py-2 hover:bg-gray-700 transition duration-300">Login</button>
                    </div>
                </form>
            </div>
            
        </div>

        <div>
            <img src="{{ asset('images/background.png') }}" alt="Background" class="w-full h-screen">
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (e) {
                e.preventDefault();

                let data = {
                    _token: "{{ csrf_token() }}",
                    biometricID: $('#biometricID').val(),
                    first_name: $('#first_name').val(),
                    remember: $('#remember').prop('checked')
                };

                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    data: data,
                    success: function (response) {
                        console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Successfully!',
                                text: 'Welcome' + ' ' + response.first_name + '!',
                                showConfirmButton: false,
                                timer: 1000
                            }).then((result) => {
                                window.location.href = response.redirect
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: 'Incorrect Biometric ID and Name.'
                            });
                        }
                    }
                });
            });
        });
    </script>

@endsection