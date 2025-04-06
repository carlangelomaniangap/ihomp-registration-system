@extends('layouts.app')

@section('title', 'Internet Requests')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-6 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-3xl font-semibold">Internet Requests</h1>
    </header>

    <section class="mx-auto p-6 my-6">
        <table id="internetRequests" class="row-border stripe hover border border-gray-300">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Biometric ID</th>
                    <th>Name</th>
                    <th>Medical Doctor</th>
                    <th>Employment Status</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Reason</th>
                    <th>Device Type</th>
                    <th>Wi-Fi MAC Address</th>
                    <th>Pin Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready( function () {

            $.ajax({
                url: "{{ route('admin.requests.internet.show') }}",
                type: "GET",
                success: function (response) {
                    console.log(response);

                    let tableBody = '';
                    response.forEach(function (internetRequests) {
                        tableBody += `
                            <tr>
                                <td class="hidden">${internetRequests.id}</td>
                                <td>${internetRequests.biometricID}</td>
                                <td>${internetRequests.name}</td>
                                <td>${internetRequests.medical_doctor}</td>
                                <td>${internetRequests.employment_status}</td>
                                <td>${internetRequests.division}</td>
                                <td>${internetRequests.department}</td>
                                <td>${internetRequests.position}</td>
                                <td>${internetRequests.reason}</td>
                                <td>${internetRequests.device_type}</td>
                                <td>${internetRequests.wifi_mac_address}</td>
                                <td>${internetRequests.pin_code}</td>
                                <td>
                                    <button class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#internetRequests tbody').html(tableBody);

                    $('#internetRequests').DataTable();
                }
            });
        });
    </script>

@endsection