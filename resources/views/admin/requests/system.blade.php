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
                    <th class="hidden">ID</th>
                    <th>Biometric ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Medical Doctor</th>
                    <th>Name</th>
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
                url: "{{ route('admin.requests.system.show') }}",
                type: "GET",
                success: function (response) {
                    console.log(response);

                    let tableBody = '';
                    response.forEach(function (systemRequests) {
                        tableBody += `
                            <tr>
                                <td class="hidden">${systemRequests.id}</td>
                                <td>${systemRequests.biometricID}</td>
                                <td>${systemRequests.username}</td>
                                <td>${systemRequests.password}</td>
                                <td>${systemRequests.medical_doctor}</td>
                                <td>${systemRequests.name}</td>
                                <td>${systemRequests.birthday}</td>
                                <td>${systemRequests.sex}</td>
                                <td>${systemRequests.civil_status}</td>
                                <td>${systemRequests.email}</td>
                                <td>${systemRequests.mobile_number}</td>
                                <td>${systemRequests.telephone_number}</td>
                                <td>${systemRequests.division}</td>
                                <td>${systemRequests.department}</td>
                                <td>${systemRequests.position}</td>
                                <td>${systemRequests.prc_license_number}</td>
                                <td>${systemRequests.expiration_date}</td>
                                <td>${systemRequests.employment_status}</td>
                                <td>${systemRequests.systems_to_be_enrolled}</td>
                                <td>${systemRequests.emr_sdn_user_profile}</td>
                                <td>${systemRequests.pin_code}</td>
                                <td>
                                    <button class="text-white font-semibold bg-[#1486a2] px-2 py-2 rounded hover:bg-[#0c6980] transition duration-300">Print</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#systemRequests tbody').html(tableBody);

                    $('#systemRequests').DataTable();
                }
            });
        });
    </script>

@endsection