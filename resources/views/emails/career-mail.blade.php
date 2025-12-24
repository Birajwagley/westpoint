<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Job Application</title>
</head>

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
                            <img src="{{ asset('assets/frontend/images/homepage/main_logo.png') }}" alt="Gyanodaya Logo"
                                style="max-width:200px;height:auto;display:block;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px;">

                            <h3 style="color:#044335;border-bottom:1px solid #ddd;padding-bottom:6px;">
                                Job Application Information
                            </h3>

                            <table width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;">
                                <tr>
                                    <td width="35%"><strong>Career:</strong></td>
                                    <td>{{ strip_tags($jobApplication->career->name) ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Full Name:</strong></td>
                                    <td>{{ $jobApplication->full_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Gender:</strong></td>
                                    <td>{{ $jobApplication->gender ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Birth (AD):</strong></td>
                                    <td>{{ $jobApplication->date_of_birth_ad ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Birth (BS):</strong></td>
                                    <td>{{ $jobApplication->date_of_birth_bs ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Age:</strong></td>
                                    <td>{{ $jobApplication->age ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Current Address:</strong></td>
                                    <td>{{ $jobApplication->current_address ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile Number:</strong></td>
                                    <td>{{ $jobApplication->mobile_number ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $jobApplication->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone Number:</strong></td>
                                    <td>{{ $jobApplication->phone_no ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Highest Qualification:</strong></td>
                                    <td>{{ $jobApplication->highest_education_qualification ?? '' }}</td>
                                </tr>
                            </table>

                            <!-- CV -->
                            <p style="margin-top:15px;">
                                <strong>CV:</strong><br>
                                @if ($jobApplication->cv)
                                    <a href="{{ asset($jobApplication->cv) }}" target="_blank"
                                        style="color:#044335;font-weight:bold;text-decoration:none;">
                                        View CV
                                    </a>
                                @else
                                    No CV uploaded
                                @endif
                            </p>

                            <!-- Cover Letter -->
                            <p style="margin-top:15px;">
                                <strong>Cover Letter:</strong><br>
                                {{ strip_tags($jobApplication->cover_letter) ?? '' }}
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#044335" style="padding:10px; text-align:center; color:#ffffff; font-size:12px;">
                            &copy; {{ date('Y') }} Gyanodaya. All rights reserved.
                        </td>
                    </tr>

                </table>
                <!-- End container -->

            </td>
        </tr>
    </table>

</body>

</html>
