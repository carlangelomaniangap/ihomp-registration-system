<nav class="bg-[#0c6980] text-white font-semibold w-64 h-screen flex flex-col p-4 gap-4 print:hidden">

    <div class="text-center pb-4 border-b border-gray-400">
        <h1 class="text-2xl">IHOMP</h1>
        <h2 class="text-xl">Registration System</h2>
    </div>

    <div class="space-y-1">
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard.index') ? 'bg-[#1486a2]' : '' }} flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/home.svg') }}" alt="Home" class="mr-2">Dashboard</a>
                <h4 class="pt-4 pb-2 font-semibold">Requests Tables</h4>
                <a href="{{ route('admin.requests.internet') }}" class="{{ request()->routeIs('admin.requests.internet') ? 'bg-[#1486a2]' : '' }} flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/wifi.svg') }}" alt="Wifi" class="mr-2">Internet Requests</a>
                <a href="{{ route('admin.requests.system') }}" class="{{ request()->routeIs('admin.requests.system') ? 'bg-[#1486a2]' : '' }} flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/monitor.svg') }}" alt="Monitor" class="mr-2">System Requests</a>
            @elseif (auth()->user()->role === 'user')
                <h4 class="pt-4 pb-2 font-semibold">Request Forms</h4>
                <a href="{{ route('user.request.internet') }}" class="{{ request()->routeIs('user.request.internet') ? 'bg-[#1486a2]' : '' }} flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/wifi.svg') }}" alt="Wifi" class="mr-2">Internet Request</a>
                <a href="{{ route('user.request.system') }}" class="{{ request()->routeIs('user.request.system') ? 'bg-[#1486a2]' : '' }} flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/monitor.svg') }}" alt="Monitor" class="mr-2">System Request</a>
            @endif
        @endauth
    </div>

    <div class="mt-auto">
        <h1 class="flex justify-center items-center py-2"><img src="{{ asset('icons/user.svg') }}" alt="User" class="mr-2">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>

        <form id="logout">
            <button type="submit" class="w-full flex justify-center items-center px-2 py-2 rounded hover:bg-red-600 bg-[#1486a2] text-white transition duration-300">
                <img src="{{ asset('icons/exit.svg') }}" alt="Exit" class="mr-2">
                Logout
            </button>
        </form>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#logout').submit(function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Logout Confirmation',
                text: 'Are you sure you want to log out?',
                showCancelButton: true,
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, Logout',
            }).then((result) => {
                if (result.isConfirmed) {
                    let data = {
                        _token: "{{ csrf_token() }}",
                    };

                    $.ajax({
                        url: "{{ route('logout') }}",
                        type: "POST",
                        data: data,
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.message,
                                    text: 'See you next time' + ' ' + response.first_name + '!',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(() => {
                                    window.location.href = response.redirect;
                                });
                            }
                        }
                    });
                } else {
                    return;
                }
            });
        });
    });
</script>