@extends('layouts.app')

@section('title', 'Internet Requests')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-4 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-xl md:text-2xl font-semibold">Internet Requests</h1>
    </header>

    <section class="mx-auto p-6">
        <table id="internetRequests" class="border border-gray-300 cell-border stripe hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="px-2 py-1">Biometric ID</th>
                    <th class="px-2 py-1">First Name</th>
                    <th class="px-2 py-1">Last Name</th>
                    <th class="px-2 py-1">Medical Doctor</th>
                    <th class="px-2 py-1">Employment Status</th>
                    <th class="px-2 py-1">Division</th>
                    <th class="px-2 py-1">Department</th>
                    <th class="px-2 py-1">Position</th>
                    <th class="px-2 py-1">Reason</th>
                    <th class="px-2 py-1">Device Type</th>
                    <th class="px-2 py-1">Wi-Fi MAC Address</th>
                    <th class="px-2 py-1">Pin Code</th>
                    <th class="px-2 py-1">Action</th>
                </tr>
            </thead>
        </table>
    </section>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            let table = $('#internetRequests').DataTable({
                ajax: '/admin/requests/internet/show',
                columns: [
                    { data: 'id'},
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
                            return `<a href="/admin/requests/internet/print/${row.id}" class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</a>`;
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        visible: false,
                        searchable: false
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