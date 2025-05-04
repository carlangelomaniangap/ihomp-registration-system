@extends('layouts.app')

@section('title', 'Internet Requests')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-4 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-xl md:text-2xl font-semibold">Internet Requests</h1>
    </header>

    <section class="mx-auto p-6">
        <table id="internetRequests" class="row-border stripe hover border border-gray-300">
            <thead>
                <tr>
                    <th>Biometric ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
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
        </table>
    </section>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function(){
            let table = $('#internetRequests').DataTable({
                ajax: '/admin/requests/internet/show',
                columns: [
                    { data: 'biometricID' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'medical_doctor' },
                    { data: 'employment_status' },
                    { data: 'division' },
                    { data: 'department' },
                    { data: 'position' },
                    { data: 'reason' },
                    { data: 'device_type' },
                    { data: 'wifi_mac_address' },
                    { data: 'pin_code' },
                    {
                        render: function (data, type, row) {
                            return `<a href="/request/internet/print/${row.id}" class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</a>`;
                        }
                    }
                ]
            });

            function refresh() {
                $.ajax({
                    url: '/admin/requests/internet/show',
                    method: 'GET',
                    success: function (response) {
                        response.data.forEach(function(row) {
                            let DataExists = false;

                            table.rows().data().each(function(CurrentData) {
                                if (CurrentData.id === row.id) {
                                    DataExists = true;
                                }
                            });

                            if (DataExists != true) {
                                table.row.add(row).draw();
                            }
                        });
                    }
                });
            }

            setInterval(refresh, 1000);
        });
    </script>

@endsection