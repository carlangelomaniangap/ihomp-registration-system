@extends('layouts.guest')

@section('title', 'IHOMP Registration System')

@section('content')

    <div class="grid grid-cols-2">
        
        <div class="flex flex-col justify-center items-center">

            <div class="w-90 h-90 bg-[#21a1c2] shadow-lg p-4 rounded-lg">
                <div class="text-gray-900 text-center pt-4 pb-6">
                    <h1 class="font-bold text-3xl">IHOMP</h1>
                    <h2 class="font-semibold text-2xl">Registration System</h2>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mt-2">
                        <label for="biometricID" class="text-gray-900 font-semibold">Bio ID <sup class="text-red-500">*</sup></label>
                        <input type="number" id="biometricID" name="biometricID" class="w-full bg-white block rounded px-2 py-2" placeholder="1234" required>
                    </div>

                    <div class="mt-2">
                        <label for="name" class="text-gray-900 font-semibold">Name <sup class="text-red-500">*</sup></label>
                        <input type="text" id="name" name="name" class="w-full bg-white block rounded px-2 py-2" placeholder="Juan Dela Cruz" required>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full font-semibold bg-gray-900 text-white rounded px-2 py-2 hover:bg-gray-700 transition duration-300">Login</button>
                    </div>
                </form>
            </div>
            
        </div>

        <div class="">
            <img src="{{ asset('images/background.png') }}" alt="Background" class="w-full h-screen">
        </div>
    </div>

@endsection