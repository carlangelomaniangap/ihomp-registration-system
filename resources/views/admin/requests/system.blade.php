@extends('layouts.app')

@section('title', 'System Requests')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-4 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-xl md:text-2xl font-semibold">System Requests</h1>
    </header>

    <section class="mx-auto p-6">
        <table id="systemRequests" class="border border-gray-300 cell-border stripe hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="px-2 py-1">Biometric ID</th>
                    <th class="px-2 py-1">Username</th>
                    <th class="px-2 py-1">Password</th>
                    <th class="px-2 py-1">Medical Doctor</th>
                    <th class="px-2 py-1">First Name</th>
                    <th class="px-2 py-1">Last Name</th>
                    <th class="px-2 py-1">Birthday</th>
                    <th class="px-2 py-1">Sex</th>
                    <th class="px-2 py-1">Civil Status</th>
                    <th class="px-2 py-1">Email</th>
                    <th class="px-2 py-1">Mobile Number</th>
                    <th class="px-2 py-1">Telephone Number</th>
                    <th class="px-2 py-1">Division</th>
                    <th class="px-2 py-1">Department</th>
                    <th class="px-2 py-1">Position</th>
                    <th class="px-2 py-1">PRC License Number</th>
                    <th class="px-2 py-1">Expiration Date</th>
                    <th class="px-2 py-1">Employment Status</th>
                    <th class="px-2 py-1">Systems to be Enrolled</th>
                    <th class="px-2 py-1">EMR(SDN) User Profile</th>
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
        $(document).ready( function () {
            let table = $('#systemRequests').DataTable({
                ajax: '/admin/requests/system/show',
                columns: [
                    { data: 'id'},
                    { data: 'biometricID' },
                    { data: 'username' },
                    { data: 'password' },
                    { data: 'medical_doctor' },
                    { data: 'first_name' },
                    { data: 'last_name' },
                    { data: 'birthday' },
                    { data: 'sex' },
                    { data: 'civil_status' },
                    { data: 'email' },
                    { data: 'mobile_number' },
                    { data: 'telephone_number' },
                    { data: 'division' },
                    { data: 'department' },
                    { data: 'position' },
                    { data: 'prc_license_number' },
                    { data: 'expiration_date' },
                    { data: 'employment_status' },
                    { data: 'systems_to_be_enrolled' },
                    { data: 'emr_sdn_user_profile' },
                    { data: 'pin_code' },
                    {
                        render:function(data, type, row){
                            return `<a href="/admin/requests/system/print/${row.id}" class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</a>`;
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
                    url: '/admin/requests/system/show',
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