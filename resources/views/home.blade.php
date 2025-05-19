@extends('layouts.guest')

@section('title', 'IHOMP Registration System')

@section('content')

    <section class="relative min-h-screen flex items-center justify-center">

        <div id="particles-js" class="absolute inset-0 z-0"></div>

        <div class="relative z-10">

            <div class="bg-[#0c6980]/30 backdrop-blur-xs shadow-lg p-8 rounded-lg">
                <div class="text-white text-center mb-6">
                    <h1 class="font-bold text-3xl">IHOMP</h1>
                    <h2 class="font-semibold text-2xl">Registration System</h2>
                </div>

                <form id="loginForm">
                    <div>
                        <label for="biometricID" class="text-white font-semibold">Biometric ID <sup class="text-red-500">*</sup></label>
                        <input type="number" id="biometricID" name="biometricID" class="w-full mt-1 text-white bg-[#0c6980]/50 shadow-lg backdrop-blur-xs rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0c6980]" placeholder="1234" required>
                    </div>

                    <div class="mt-2">
                        <label for="first_name" class="text-white font-semibold">First Name <sup class="text-red-500">*</sup></label>
                        <input type="text" id="first_name" name="first_name" class="w-full mt-1 text-white bg-[#0c6980]/50 shadow-lg backdrop-blur-xs rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0c6980]" autocomplete="off" placeholder="Juan" required>
                    </div>

                    <div class="mt-2">
                        <label class="text-white">
                            <input type="checkbox" name="remember" id="remember" class="accent-[#0c6980]"> Remember Me
                        </label>
                    </div>

                    <div class="mt-6 mb-2">
                        <button type="submit" class="w-full font-semibold bg-[#0c6980] text-white rounded px-2 py-2 hover:bg-[#085568] transition duration-300">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 500,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#0c6980"
                },
                "shape": {
                    "type": "circle"
                },
                "opacity": {
                    "value": 0.5
                },
                "size": {
                    "value": 2,
                    "random": true
                },
                "line_linked": {
                    "enable": true,
                    "distance": 100,
                    "color": "#ffffff",
                    "opacity": 0.5,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1.5,
                    "direction": "none",
                    "out_mode": "out"
                }
            },
            "interactivity": {
                "events": {
                    "onhover": {
                        "enable": false,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": false,
                        "mode": "push"
                    }
                },
                "modes": {
                    "repulse": {
                        "distance": 100
                    },
                    "push": {
                        "particles_nb": 4
                    }
                }
            },
            "retina_detect": true
        });
    </script>

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