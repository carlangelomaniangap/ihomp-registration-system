<nav class="bg-[#0c6980] text-white font-semibold w-52 h-screen flex flex-col p-4 gap-4">

    <div class="text-center py-4 border-b border-gray-400">
        <h1 class="text-2xl">IHOMP</h1>
        <h2 class="text-lg">Registration System</h2>
    </div>

    <div class="space-y-1">
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.requests.internet') }}" class="flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/wifi.svg') }}" alt="Wifi" class="mr-2">Internet Requests</a>
                <a href="{{ route('admin.requests.system') }}" class="flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/monitor.svg') }}" alt="Monitor" class="mr-2">System Requests</a>
            @elseif (auth()->user()->role === 'user')
                <a href="{{ route('user.request.internet') }}" class="flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/wifi.svg') }}" alt="Wifi" class="mr-2">Internet Request</a>
                <a href="{{ route('user.request.system') }}" class="flex items-center px-2 py-2 rounded hover:bg-[#1486a2] transition duration-300"><img src="{{ asset('icons/monitor.svg') }}" alt="Monitor" class="mr-2">System Request</a>
            @endif
        @endauth
    </div>

    <div class="mt-auto">
        <h1 class="flex justify-center items-center py-2"><img src="{{ asset('icons/user.svg') }}" alt="User" class="mr-2">{{ auth()->user()->name }}</h1>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex justify-center items-center px-2 py-2 rounded hover:bg-red-600 bg-[#1486a2] text-white transition duration-300">
                <img src="{{ asset('icons/exit.svg') }}" alt="Exit" class="mr-2">
                Logout
            </button>
        </form>
    </div>
</nav>