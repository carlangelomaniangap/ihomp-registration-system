@extends('layouts.app')

@section('title', 'Print Internet Request')

@section('content')

    <section>
        <div class="flex justify-between items-center p-4 print:hidden">
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

        <div class="w-full max-w-3xl mx-auto py-8">
            <div class="flex justify-center gap-8">
                <img src="" alt="Logo">

                <div class="flex flex-col justify-center items-center">
                    <h1 class="font-bold text-lg">BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h1>
                    <P class="text-sm">Balanga City, Bataan</P>
                    <p class="text-sm">ISO-QMS 9001:2015 Certified</p>
                </div>
                

                <img src="" alt="Logo">
            </div>

            <div>
                <h1 class="font-semibold pt-4 text-center">REQUEST FOR INTERNET CONNECTION</h1>
            </div>

            <div class="grid grid-cols-3 gap-8 pt-6">
                <div class="col-span-2">
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

                <div class="col-span-1">
                    <div class="flex items-center space-x-4">
                        <p class="font-semibold">Date:</p>
                        <p class="text-center border-b flex-1">{{ date('F j, Y', strtotime($internetRequest->created_at)) }}</p>
                    </div>
                </div>
            </div>

            <div class="flex space-x-4 pt-8">
                <p class="font-semibold w-26">Reason:</p>
                <p class="border flex-1 flex justify-center items-center w-full h-24">{{ $internetRequest->reason }}</p>
            </div>

            <div class="grid grid-cols-2 gap-8 pt-8">
                <div class="border">
                    <h3 class="text-center border-b">Device Type</h3>

                    <div class="border-b flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Android Smartphone' ? 'checked' : '' }} disabled>
                        <p>Android Smartphone</p>
                    </div>

                    <div class="border-b flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Android Tablet' ? 'checked' : '' }} disabled>
                        <p>Android Tablet</p>
                    </div>

                    <div class="border-b flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'Windows Laptop' ? 'checked' : '' }} disabled>
                        <p>Windows Laptop</p>
                    </div>

                    <div class="border-b flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'iPhone' ? 'checked' : '' }} disabled>
                        <p>iPhone</p>
                    </div>

                    <div class="border-b flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'iPad' ? 'checked' : '' }} disabled>
                        <p>iPad</p>
                    </div>

                    <div class="flex pl-32 gap-4">
                        <input type="checkbox" name="device_type" {{ $internetRequest->device_type === 'MacBook' ? 'checked' : '' }} disabled>
                        <p >MacBook</p>
                    </div>
                </div>

                <div class="text-center">
                    <div class="border">
                        <h3 class="border-b">Mac Address</h3>
                        <p>{{ $internetRequest->wifi_mac_address }}</p>
                    </div>
                </div>

            </div>

            <div class="pt-2">
                <em class="text-xs">Note: Strickly 1 device only.</em>
            </div>
            

            <div class="grid grid-cols-2 gap-8 pt-4">
                <div>
                    <h3 class="pb-8">Request by:</h3>

                    <p class="text-center border-b">{{ $internetRequest->biometricID }} - {{ $internetRequest->first_name }} {{ $internetRequest->last_name }}</p>
                    <p class="text-sm text-center">PRINTED NAME & SIGNATURE</p>
                </div>

                <div>
                    <h3 class="pb-8">Noted by:</h3>

                    <p class="text-center uppercase border-b">{{ $adminName->first_name }} {{ $adminName->last_name }}</p>
                    <p class="text-sm text-center">IHOMP System Administrator</p>
                </div>
            </div>

            <div class="pt-8">
                <h3 class="pb-12">Approved by:</h3>

                <p class="border-b inline-block">GLORY V. BALTARAZ, MD, MPH, MHA, CESe</p>
                <P class="text-sm">Medical Center Chief II</P>
            </div>
        </div>
    </section>

@endsection