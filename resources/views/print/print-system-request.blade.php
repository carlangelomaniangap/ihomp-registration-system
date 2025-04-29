@extends('layouts.app')

@section('title', 'Print System Request')

@section('content')

    <section>
        <div class="flex justify-between items-center p-4 print:hidden">
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.requests.system') }}" class="text-sm py-2 px-4 bg-[#0c6980] text-white rounded hover:bg-[#1486a2] transition duration-300">
                        Back to System Requests
                    </a>
                @elseif (Auth::user()->role === 'user')
                    <a href="{{ route('user.request.system') }}" class="text-sm py-2 px-4 bg-[#0c6980] text-white rounded hover:bg-[#1486a2] transition duration-300">
                        Back to System Request
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
                <h1 class="font-semibold pt-4 text-center">IHOMP SYSTEMS REGISTRATION FORM</h1>
            </div>

            <div class="flex justify-between pt-4">
                <h3 class="px-4 text-white bg-gray-700 print:bg-gray-700 print:text-white">IHOMP SYSTEMS REGISTRATION FORM</h3>

                <div class="flex items-center space-x-4">
                    <p class="font-semibold">Date:</p>
                    <p class="text-center border-b flex-1">{{ date('F j, Y', strtotime($systemRequest->created_at)) }}</p>
                </div>
            </div>

            <div class="text-xs pl-20">
                <p>Kindly fill out all the informaton needed and do not leave any box unmarked.</p>
                <p>Write N/A in items not applicable to you.</p>
            </div>

            <div class="w-full max-w-xl mx-auto">
                <table class="border-collapse border w-full">
                    <tbody>
                        <tr class="text-sm">
                            <td class="px-2 border">Biometrics ID #</td>
                            <td class="px-2 border">{{ $systemRequest->biometricID }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Username</td>
                            <td class="px-2 border">{{ $systemRequest->username }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Password</td>
                            <td class="px-2 border">{{ $systemRequest->password }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Last Name</td>
                            <td class="px-2 border">{{ $systemRequest->last_name }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">First Name</td>
                            <td class="px-2 border">{{ $systemRequest->first_name }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Middle Name</td>
                            <td class="px-2 border">{{ $systemRequest->middle_name }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Birthday (mm/dd/yy)</td>
                            <td class="px-2 border">{{ $systemRequest->birthday }}</td>
                        </tr class="text-sm">

                        <tr class="text-sm">
                            <td class="px-2 border">Sex</td>
                            <td class="px-2 border">{{ $systemRequest->sex }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Civil Status</td>
                            <td class="px-2 border">{{ $systemRequest->civil_status }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Email</td>
                            <td class="px-2 border">{{ $systemRequest->email }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Mobile Number</td>
                            <td class="px-2 border">{{ $systemRequest->mobile_number }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Telephone Number</td>
                            <td class="px-2 border">{{ $systemRequest->telephone_number }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Position</td>
                            <td class="px-2 border">{{ $systemRequest->position }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Department</td>
                            <td class="px-2 border">{{ $systemRequest->department }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Division</td>
                            <td class="px-2 border">{{ $systemRequest->division }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">PRC License No.</td>
                            <td class="px-2 border">{{ $systemRequest->prc_lecense_number }}</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 border">Expiration Date</td>
                            <td class="px-2 border">{{ $systemRequest->expiration_date }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="w-full max-w-xl mx-auto pt-4">
                <table class="border-collapse border">
                    <thead>
                        <tr class="text-sm">
                            <th class="font-semibold border w-2/5">Use the same username and password for:</th>
                            <th class="font-semibold border w-1/5">(_) if YES, Check below.</th>
                            <th class="font-semibold border w-2/5">(_) if YES, Check below.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-sm px-2 border">EMR-SDN (bghmc-sdn.net)</td>
                            <td class="text-sm border text-center">
                                <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 border text-xs">
                                <p>Username: <span class="underline {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                                <p>Password: <span class="underline {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-sm px-2 border">HIMS</td>
                            <td class="text-sm border text-center">
                                <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 border text-xs">
                                <p>Username: <span class="underline {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                                <p>Password: <span class="underline {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-sm px-2 border">PACS-RIS</td>
                            <td class="text-sm border text-center">
                                <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 border text-xs">
                                <p>Username: <span class="underline {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                                <p>Password: <span class="underline {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="w-full max-w-xl mx-auto pt-4">
                <table>
                    <thead>
                        <tr class="text-sm">
                            <th class="font-semibold text-white bg-gray-700 w-1/3 print:bg-gray-700 print:text-white">Additional Information:</th>
                            <th class="font-semibold w-1/6">Type</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th class="text-sm">EMR (SDN)</th>
                            <th></th>
                            <th class="text-sm w-1/6">HIMS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-sm">
                            <td class="px-2 text-right">User</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'User' ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 text-right w-1/4">Station/Ward</td>
                            <td class="border-b"></td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Pharmacy</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Pharmacy' ? 'checked' : '' }} disabled>
                            </td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Admitting</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Admitting' ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 text-white bg-gray-700 text-right print:bg-gray-700 print:text-white">Employment Status:</td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Social Service</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Social Service' ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 text-right">Regular/Permanent</td>
                            <td class="border text-center">
                                <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Regular/Permanent' ? 'checked' : '' }} disabled>
                            </td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Cashier</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Cashier' ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 text-right">Job Order</td>
                            <td class="border text-center">
                                <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Job Order' ? 'checked' : '' }} disabled>
                            </td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Nurse</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Nurse' ? 'checked' : '' }} disabled>
                            </td>
                            <td class="px-2 text-right">Temporary</td>
                            <td class="border text-center">
                                <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Temporary' ? 'checked' : '' }} disabled>
                            </td>
                        </tr>

                        <tr class="text-sm">
                            <td class="px-2 text-right">Doctor</td>
                            <td class="border text-center">
                                <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Doctor' ? 'checked' : '' }} disabled>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div  class="w-full max-w-xl mx-auto pt-2">
                <table>
                    <tbody>
                        <tr class="text-sm">
                            <td class="w-1/3"></td>
                            <td class="w-1/3"></td>
                            <td class="w-1/3">
                                <p class="text-center border-b">{{ $systemRequest->biometricID }} - {{ $systemRequest->first_name }} {{ $systemRequest->last_name }}</p>
                                <p>Signature Over Printed Name</p>
                                <p class="pt-2 text-center">Employee</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection