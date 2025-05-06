@extends('layouts.app')

@section('title', 'Print Internet Request')

@section('content')

    <section>
        <div class="flex justify-between items-center p-6 print:hidden">
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.requests.internet') }}" class="text-sm py-2 px-4 bg-[#0c6980] text-white rounded hover:bg-[#1486a2] transition duration-300">
                        Back to Internet Requests
                    </a>
                @elseif (Auth::user()->role === 'user')
                    <a href="{{ route('user.request.internet') }}" class="text-sm py-2 px-4 bg-[#0c6980] text-white rounded hover:bg-[#1486a2] transition duration-300">
                        Back to Internet Request
                    </a>
                @endif
            @endauth

            <button onclick="window.print()" class="text-sm py-2 px-4 bg-[#0c6980] text-white rounded hover:bg-[#1486a2] transition duration-300">Print</button>
        </div>

        <div class="w-full max-w-3xl print:max-w-2xl mx-auto my-12 border p-24 print:my-0 print:border-0 print:p-0">
            <div class="flex items-center justify-center gap-x-3.5">
                <img src="{{ asset('images/BGHMC.png') }}" alt="BGHMC Logo" class="h-12 w-12">

                <h3 class="font-bold text-lg">BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h3>

                <img src="{{ asset('images/DOH.png') }}" alt="DOH Logo" class="h-12 w-12">
            </div>

            <div class="text-center text-xs">
                <p>Balanga City, Bataan</p>
                <p>ISO-QMS 9001:2015 Certified</p>
            </div>

            <div>
                <h3 class="text-base font-bold pt-4 text-center">REQUEST FOR INTERNET CONNECTION</h3>
            </div>

            <div class="grid grid-cols-3 gap-8 pt-6">
                <div class="text-sm col-span-2">
                    <div class="flex items-center space-x-4">
                        <p class="font-semibold w-26">Biometric ID:</p>
                        <p class="border-b flex-1">{{ $internetRequest->biometricID }}</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-2">
                        <p class="font-semibold w-26">Name:</p>
                        <p class="border-b flex-1">{{ $internetRequest->first_name }} {{ $internetRequest->last_name }}</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-2">
                        <p class="font-semibold w-26">Department:</p>
                        <p class="border-b flex-1">{{ $internetRequest->department }}</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-2">
                        <p class="font-semibold w-26">Position:</p>
                        <p class="border-b flex-1">{{ $internetRequest->position }}</p>
                    </div>
                </div>

                <div class="text-sm col-span-1">
                    <div class="flex items-center space-x-4">
                        <p class="font-semibold">Date:</p>
                        <p class="text-center border-b flex-1">{{ date('F j, Y', strtotime($internetRequest->created_at)) }}</p>
                    </div>
                </div>
            </div>

            <div class="text-sm flex space-x-4 pt-6">
                <p class="font-semibold w-26">Reason:</p>
                <p class="border flex-1 flex justify-center items-center w-full h-24">{{ $internetRequest->reason }}</p>
            </div>

            <div class="grid grid-cols-2 gap-8 pt-6">
                <div class="text-sm border">
                    <h3 class="text-center py-1 border-b">Device Type</h3>

                    <div class="border-b flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Android Smartphone' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p>Android Smartphone</p>
                    </div>

                    <div class="border-b flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Android Tablet' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p>Android Tablet</p>
                    </div>

                    <div class="border-b flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Windows Laptop' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p>Windows Laptop</p>
                    </div>

                    <div class="border-b flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'iPhone' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p>iPhone</p>
                    </div>

                    <div class="border-b flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'iPad' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p>iPad</p>
                    </div>

                    <div class="flex py-1 pl-20 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'MacBook' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                        <p >MacBook</p>
                    </div>
                </div>

                <div class="text-sm text-center">
                    <div class="py-1 border">
                        <h3 class="border-b">Mac Address</h3>
                        <p>{{ $internetRequest->wifi_mac_address }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <em class="text-xs">Note: Strickly 1 device only.</em>
            </div>

            <div class="grid grid-cols-2 gap-8 pt-6">
                <div>
                    <h3 class="text-sm pb-8">Request by:</h3>

                    <p class="text-sm text-center border-b">{{ $internetRequest->biometricID }} - {{ $internetRequest->first_name }} {{ $internetRequest->last_name }}</p>
                    <p class="text-xs text-center">PRINTED NAME & SIGNATURE</p>
                </div>

                <div>
                    <h3 class="text-sm pb-8">Noted by:</h3>

                    <p class="text-sm text-center uppercase border-b">{{ $adminName->first_name }} {{ $adminName->last_name }}</p>
                    <p class="text-xs text-center">IHOMP System Administrator</p>
                </div>
            </div>

            <div class="grid grid-cols-2 pt-12">
                <div class="col-start-1">
                    <h3 class="text-sm pb-8">Approved by:</h3>

                    <p class="text-sm border-b">GLORY V. BALTARAZ, MD, MPH, MHA, CESe</p>
                    <P class="text-xs">Medical Center Chief II</P>
                </div>
            </div>
        </div>
    </section>

@endsection