@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-4 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-xl md:text-2xl font-semibold">Dashboard</h1>
    </header>

    <section class="mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 grid-rows-1 gap-4">
            <div >
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100">
                    <div class="p-3 rounded-full bg-blue-600 bg-opacity-75">
                        <img src="{{ asset('icons/wifi.svg') }}" alt="Wifi">
                    </div>

                    <div class="mx-5">
                        <h4 id="internetRequest" class="text-xl md:text-2xl font-semibold text-gray-700">0</h4>
                        <div class="text-sm md:text-base text-gray-500">Internet Requests</div>
                    </div>
                </div>
            </div>

            <div >
                <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-slate-100">
                    <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                        <img src="{{ asset('icons/monitor.svg') }}" alt="Monitor">
                    </div>

                    <div class="mx-5">
                        <h4 id="systemRequest" class="text-xl md:text-2xl font-semibold text-gray-700">0</h4>
                        <div class="text-sm md:text-base text-gray-500">System Requests</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function refresh() {
            fetch('/admin/dashboard/refresh')
            .then(response => {
                return response.json();
            })
            .then(data => {
                document.getElementById('internetRequest').textContent = data.internetRequest;
                document.getElementById('systemRequest').textContent = data.systemRequest;
            });
        }

        setInterval(refresh, 1000);
        refresh();
    </script>

@endsection