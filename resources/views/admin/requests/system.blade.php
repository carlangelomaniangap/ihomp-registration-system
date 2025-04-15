@extends('layouts.app')

@section('title', 'System Requests')

@section('content')

    <header class="bg-white text-[#0c6980] sticky top-0 text-center p-6 border-b border-gray-300 w-full z-10 shadow-md">
        <h1 class="text-3xl font-semibold">System Requests</h1>
    </header>

    <section class="mx-auto p-6 my-6">
        <table id="systemRequests" class="row-border stripe hover border border-gray-300">
            <thead>
                <tr>
                    <th>Biometric ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Medical Doctor</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>Civil Status</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Telephone Number</th>
                    <th>Division</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>PRC License Number</th>
                    <th>Expiration Date</th>
                    <th>Employment Status</th>
                    <th>Systems to be Enrolled</th>
                    <th>EMR(SDN) User Profile</th>
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
        $(document).ready( function () {
            let table = $('#systemRequests').DataTable({
                ajax: '/admin/requests/system/show',
                columns: [
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
                            return `<button class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</button>`;
                        }
                    }
                ]
            });

            function refresh() {
                table.ajax.reload(null, false);
            }

            setInterval(refresh, 1000);
        });
    </script>

@endsection