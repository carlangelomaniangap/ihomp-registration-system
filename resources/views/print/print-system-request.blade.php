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

        <div class="w-full max-w-3xl print:max-w-2xl mx-auto my-6 border p-24 print:my-0 print:border-0 print:p-0">
            <div class="flex items-center justify-center gap-x-3.5">
                <img src="{{ asset('images/BGHMC.png') }}" alt="BGHMC Logo" class="h-12 w-12">

                <h3 class="font-bold text-lg">BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h3>

                <img src="{{ asset('images/DOH.png') }}" alt="DOH Logo" class="h-12 w-12">
            </div>

            <div class="text-center text-xs">
                <p>Balanga City, Bataan</p>
                <p>ISO-QMS 9001:2015 Certified</p>
            </div>

            <div>
                <h3 class="text-base font-bold pt-4 text-center">IHOMP SYSTEMS REGISTRATION FORM</h3>
            </div>

            <div class="flex justify-between pt-4">
                <h5 class="px-4 text-xs text-white bg-gray-700 print:bg-gray-700 print:text-white">IHOMP SYSTEMS REGISTRATION FORM</h5>

                <div class="text-xs flex items-center">
                    <p class="font-semibold">Date:</p>
                    <p class="text-center px-4 border-b">{{ date('F j, Y', strtotime($systemRequest->created_at)) }}</p>
                </div>
            </div>

            <div class="text-xs">
                <p>Kindly fill out all the informaton needed and do not leave any box unmarked.</p>
                <p>Write N/A in items not applicable to you.</p>
            </div>

            <div class="grid grid-cols-2 grid-rows-17 text-xs text-center border">
                <div class="pt-0.5 font-semibold border-r border-b">Biometrics ID #</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->biometricID }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Username</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->username }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Password</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->password }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Last Name</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->last_name }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">First Name</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->first_name }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Middle Name</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->middle_name }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Birthday (mm/dd/yy)</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->birthday }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Sex</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->sex }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Civil Status</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->civil_status }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Email</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->email }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Mobile Number</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->mobile_number }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Telephone Number</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->telephone_number }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Position</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->position }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Department</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->department }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">Division</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->division }}</div>
                <div class="pt-0.5 font-semibold border-r border-b">PRC License Number</div>
                <div class="pt-0.5 border-b">{{ $systemRequest->prc_license_number }}</div>
                <div class="pt-0.5 font-semibold border-r">Expiration Date</div>
                <div class="py-0.5">{{ date('F j, Y', strtotime($systemRequest->expiration_date)) }}</div>
            </div>

            <div class="grid grid-cols-5 grid-rows-4 text-xs pt-4">
                <div class="col-span-2 text-xs border font-semibold text-center px-2">Use the same username and password for:</div>
                <div class="col-start-3 text-xs border-t border-r border-b font-semibold text-center px-2">(_) if YES, check below.</div>
                <div class="col-span-2 text-xs col-start-4 border-t border-r border-b font-semibold flex items-center justify-center">(_) if YES, check below.</div>
                <div class="col-span-2 row-start-2 font-semibold border-l border-r border-b flex items-center justify-center">EMR-SDN (bghmc-sdn.net)</div>
                <div class="col-start-3 row-start-2 border-r border-b flex items-center justify-center">
                    <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-2 border-r border-b py-1 px-2">
                    <p>Username: <span class="border-b {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                    <p>Password: <span class="border-b {{ in_array('EMR-SDN', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                </div>
                <div class="col-span-2 row-start-3 font-semibold border-l border-r border-b flex items-center justify-center">HIMS</div>
                <div class="col-start-3 row-start-3 border-r border-b flex items-center justify-center">
                    <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 border-r border-b row-start-3 py-1 px-2">
                    <p>Username: <span class="border-b {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                    <p>Password: <span class="border-b {{ in_array('HIMS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                </div>
                <div class="col-span-2 row-start-4 font-semibold border-l border-r border-b flex items-center justify-center">PACS-RIS</div>
                <div class="col-start-3 row-start-4 border-b border-r flex items-center justify-center">
                    <input type="checkbox" name="systems_to_be_enrolled" {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 border-r border-b row-start-4 py-1 px-2">
                    <p>Username: <span class="border-b {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->username }}</span></p>
                    <p>Password: <span class="border-b {{ in_array('PACS-RIS', explode(',', $systemRequest->systems_to_be_enrolled)) ? '' : 'hidden' }}">{{ $systemRequest->password }}</span></p>
                </div>
            </div>

            <div class="grid grid-cols-6 grid-rows-9 text-xs pt-4">
                <div class="col-span-2 text-center font-semibold text-white bg-gray-700 print:bg-gray-700 print:text-white">Additional informaton:</div>
                <div class="col-start-3 font-semibold text-center">Type</div>
                <div class="col-start-3 row-start-2 font-semibold text-center">EMR (SDN)</div>
                <div class="col-start-6 row-start-2 font-semibold text-center">HIMS</div>
                <div class="col-span-2 row-start-3 font-semibold text-right pr-2">User</div>
                <div class="col-start-3 row-start-3 border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'User' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-3 font-semibold text-right pr-2">Station/Ward</div>
                <div class="col-start-6 row-start-3 border-b"></div>
                <div class="col-span-2 row-start-4 font-semibold text-right pr-2">Pharmacy</div>
                <div class="col-start-3 row-start-4  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Pharmacy' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 row-start-5 font-semibold text-right pr-2">Admitting</div>
                <div class="col-start-3 row-start-5  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Admitting' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-5 font-semibold text-white bg-gray-700 text-right pr-2 print:bg-gray-700 print:text-white">Employment Status:</div>
                <div class="col-span-2 row-start-6 font-semibold text-right pr-2">Social Service</div>
                <div class="col-start-3 row-start-6  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Social Service' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-6 font-semibold text-right pr-2">Regular/Permanent</div>
                <div class="col-start-6 row-start-6  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Regular/Permanent' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 row-start-7 font-semibold text-right pr-2">Cashier</div>
                <div class="col-start-3 row-start-7  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Cashier' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-7 font-semibold text-right pr-2">Job Order</div>
                <div class="col-start-6 row-start-7  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Job Order' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 row-start-8 font-semibold text-right pr-2">Nurse</div>
                <div class="col-start-3 row-start-8  border-l border-r border-t flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Nurse' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-span-2 col-start-4 row-start-8 font-semibold text-right pr-2">Temporary/COS</div>
                <div class="col-start-6 row-start-8  border flex items-center justify-center">
                    <input type="checkbox" name="employment_status" {{ $systemRequest->employment_status === 'Temporary/COS' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
                <div class="col-start-2 row-start-9 font-semibold text-right pr-2">Doctor</div>
                <div class="col-start-3 row-start-9 border flex items-center justify-center">
                    <input type="checkbox" name="emr_sdn_user_profile" {{ $systemRequest->emr_sdn_user_profile === 'Doctor' ? 'checked' : '' }} class="accent-gray-500 pointer-events-none">
                </div>
            </div>

            <div class="grid grid-cols-2 grid-rows-3 text-xs">
                <div class="col-start-2 text-center">
                    <div class="inline px-4 text-center border-b">{{ $systemRequest->biometricID }} - {{ $systemRequest->first_name }} {{ $systemRequest->last_name }}</div>
                </div>
                <div class="col-start-2 text-center">Signature Over Printed Name</div>
                <div class="row-start-3 uppercase pt-0.5">{{ $adminName->first_name }}</div>
                <div class="row-start-3 text-center pt-0.5">Employee</div>
            </div>
        </div>
    </section>

@endsection