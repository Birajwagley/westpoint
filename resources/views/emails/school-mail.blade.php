<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Application</title>
</head>

{{-- @dd($admission); --}}

<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:20px;">
        <tr>
            <td align="center">

                <!-- Container -->
                <table width="900" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:6px;overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background:#044335;padding:20px;">
                            <img src="{{ asset('assets/frontend/images/homepage/main_logo.png') }}" alt="School Logo"
                                style="max-width:200px;height:auto;display:block;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px;">
                            <!-- Student Photo -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="background:#f9f9f9;border-radius:6px;margin-bottom:20px;">
                                <tr>
                                    <td align="center" style="padding:15px;">
                                        <h3 style="margin:0 0 10px;color:#044335;">Student Photo</h3>

                                        @if ($admission->photo)
                                            <a href="{{ asset($admission->photo) }}">
                                                <img src="{{ asset($admission->photo) }}" width="150"
                                                    style="border:1px solid #ddd;border-radius:6px;"
                                                    alt="Student Photo">
                                            </a>
                                        @else
                                            <span>No photo uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            <!-- Personal Information -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>

                                    <!-- Left -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Personal Details
                                                    </h3>

                                                    <p><strong>First Name:</strong> {{ $admission->first_name ?? '' }}
                                                    </p>
                                                    <p><strong>Middle Name:</strong> {{ $admission->middle_name ?? '' }}
                                                    </p>
                                                    <p><strong>Last Name:</strong> {{ $admission->last_name ?? '' }}</p>
                                                    <p><strong>Email:</strong> {{ $admission->email ?? '' }}</p>
                                                    <p><strong>DOB (AD):</strong> {{ $admission->dob_ad ?? '' }}
                                                    </p>
                                                    <p><strong>DOB (BS):</strong> {{ $admission->dob_bs ?? '' }}
                                                    </p>
                                                    <p><strong>Age:</strong> {{ $admission->age ?? '' }}</p>
                                                    <p><strong>Gender:</strong> {{ $admission->gender ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Right -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Contact Details
                                                    </h3>

                                                    <p><strong>Permanent Address:</strong>
                                                        {{ $admission->permanent_address ?? '' }}</p>
                                                    <p><strong>Current Address:</strong>
                                                        {{ $admission->current_address ?? '' }}</p>
                                                    <p><strong>Nationality:</strong>
                                                        {{ $admission->nationality ?? '' }}
                                                    </p>
                                                    <p><strong>Contact Number:</strong>
                                                        {{ $admission->contact_no ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>

                            <!-- Academic Information -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                                <tr>

                                    <td width="100%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Academic Details
                                                    </h3>

                                                    <p><strong>Academic Year:</strong>
                                                        {{ $admission->academic_year ?? '' }}</p>
                                                    <p><strong>Previous School Name:</strong>
                                                        {{ $admission->previous_school ?? '' }}</p>
                                                    <p><strong>Previous School Address:</strong>
                                                        {{ $admission->previous_school_address ?? '' }}</p>
                                                    <p><strong>Academic Level:</strong>
                                                        {{ $admission->academicLevel->name_en ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:20px;">
                            <a href="{{ route('admission.show', $admission->id) }}"
                                style="background-color:#044335;color:#ffffff;padding:10px 20px;text-decoration:none;border-radius:4px;font-weight:bold;display:inline-block;">
                                View More
                            </a>
                        </td>
                    </tr>


                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#044335" style="padding:10px;text-align:center;color:#ffffff;font-size:12px;">
                            &copy; {{ date('Y') }} Gyanodaya. All rights reserved.
                        </td>
                    </tr>

                </table>
                <!-- End Container -->

            </td>
        </tr>
    </table>

</body>

</html>
