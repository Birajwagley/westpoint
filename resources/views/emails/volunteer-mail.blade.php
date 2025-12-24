<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Volunteer Application</title>
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
                            <a href="{{ asset('assets/frontend/images/homepage/main_logo.png') }}">
                                <img src="{{ asset('assets/frontend/images/homepage/main_logo.png') }}"
                                    alt="Gyanodaya Logo" style="max-width:200px;height:auto;display:block;">
                            </a>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px;">

                            <!-- Two Columns -->
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>

                                    <!-- Personal Info -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Personal Information</h3>

                                                    <p><strong>DOB (AD):</strong>
                                                        {{ $volunteerForm->date_of_birth_ad ?? '' }}</p>
                                                    <p><strong>DOB (BS):</strong>
                                                        {{ $volunteerForm->date_of_birth_bs ?? '' }}</p>
                                                    <p><strong>Age:</strong> {{ $volunteerForm->age ?? '' }}</p>
                                                    <p><strong>Gender:</strong> {{ $volunteerForm->gender ?? '' }}</p>
                                                    <p><strong>Nationality:</strong>
                                                        {{ $volunteerForm->nationality ?? '' }}</p>
                                                    <p><strong>Passport No:</strong>
                                                        {{ $volunteerForm->passport_number ?? '' }}</p>
                                                    <p><strong>Email:</strong> {{ $volunteerForm->email ?? '' }}</p>
                                                    <p><strong>Contact:</strong> {{ $volunteerForm->contact_no ?? '' }}
                                                    </p>
                                                    <p><strong>Address:</strong>
                                                        {{ $volunteerForm->current_address ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Emergency Contact -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Emergency Contact</h3>

                                                    <p><strong>Name:</strong>
                                                        {{ $volunteerForm->emergency_full_name ?? '' }}</p>
                                                    <p><strong>Relationship:</strong>
                                                        {{ $volunteerForm->emergency_relationship ?? '' }}</p>
                                                    <p><strong>Contact:</strong>
                                                        {{ $volunteerForm->emergency_contact_number ?? '' }}</p>
                                                    <p><strong>Email:</strong>
                                                        {{ $volunteerForm->emergency_email ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>

                            <!-- Volunteer Details -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                                <tr>

                                    <!-- Volunteer Details -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Volunteer Details
                                                    </h3>

                                                    <p><strong>Start Date:</strong>
                                                        {{ $volunteerForm->start_date ?? '' }}</p>
                                                    <p><strong>End Date:</strong> {{ $volunteerForm->end_date ?? '' }}
                                                    </p>
                                                    <p><strong>Daily Availability:</strong>
                                                        {{ $volunteerForm->daily_availability ?? '' }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                    <!-- Additional Info -->
                                    <td width="50%" valign="top" style="padding:10px;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="background:#f9f9f9;border-radius:6px;">
                                            <tr>
                                                <td style="padding:15px;">
                                                    <h3
                                                        style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                                        Additional Info
                                                    </h3>

                                                    <p><strong>Accommodation Required:</strong>
                                                        {{ $volunteerForm->accomodation_required ? 'Yes' : 'No' }}
                                                    </p>

                                                    <p><strong>Criminal Record:</strong>
                                                        {{ $volunteerForm->criminal_record ? 'Yes' : 'No' }}
                                                    </p>

                                                    <p><strong>Travel Insurance:</strong>
                                                        {{ $volunteerForm->travel_insurance ? 'Yes' : 'No' }}
                                                    </p>

                                                    <p><strong>Medical Condition:</strong>
                                                        {{ $volunteerForm->medical_condition ? 'Yes' : 'No' }}
                                                    </p>

                                                    <p><strong>Agreement Signed:</strong>
                                                        {{ $volunteerForm->aggrement ? 'Yes' : 'No' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                            </table>

                            <!-- Attachments -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-top:20px;background:#f9f9f9;border-radius:6px;">
                                <tr>
                                    <td style="padding:15px;">
                                        <h3 style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                            Attachments</h3>

                                        <p>
                                            <strong>Insurance Proof:</strong>
                                            @if ($volunteerForm->insurance_proof)
                                                <a href="{{ asset($volunteerForm->insurance_proof) }}"
                                                    style="color:#044335;font-weight:bold;text-decoration:none;">View
                                                    Insurance Proof</a>
                                            @else
                                                Not uploaded
                                            @endif
                                        </p>

                                        <p>
                                            <strong>CV:</strong>
                                            @if ($volunteerForm->cv)
                                                <a href="{{ asset($volunteerForm->cv) }}"
                                                    style="color:#044335;font-weight:bold;text-decoration:none;">View
                                                    CV</a>
                                            @else
                                                Not uploaded
                                            @endif
                                        </p>

                                        <p><strong>Passport Copy:</strong><br>
                                            @if ($volunteerForm->passport_copy)
                                                <a href="{{ asset($volunteerForm->passport_copy) }}">
                                                    <img src="{{ asset($volunteerForm->passport_copy) }}"
                                                        width="120" style="border:1px solid #ddd;border-radius:4px;"
                                                        alt="PassportCopy">
                                                </a>
                                            @else
                                                <span>No Passport Copy uploaded</span>
                                            @endif
                                        </p>

                                        <p><strong>Visa Copy:</strong><br>
                                            @if ($volunteerForm->visa_copy)
                                                <a href="{{ asset($volunteerForm->visa_copy) }}">
                                                    <img src="{{ asset($volunteerForm->visa_copy) }}" width="120"
                                                        style="border:1px solid #ddd;border-radius:4px;"
                                                        alt="Visa Copy">
                                                </a>
                                            @else
                                                <span>No Visa Copy uploaded</span>
                                            @endif
                                        </p>

                                        <p><strong>Digital Signature:</strong><br>
                                            @if ($volunteerForm->digital_signature)
                                                <a href="{{ asset($volunteerForm->digital_signature) }}">
                                                    <img src="{{ asset($volunteerForm->digital_signature) }}"
                                                        width="120" style="border:1px solid #ddd;border-radius:4px;"
                                                        alt="Digital Signature">
                                                </a>
                                            @else
                                                <span>No Digital Signature uploaded</span>
                                            @endif
                                        </p>

                                    </td>
                                </tr>
                            </table>

                            <!-- Descriptions -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-top:20px;background:#f9f9f9;border-radius:6px;">
                                <tr>
                                    <td style="padding:15px;">
                                        <h3 style="margin:0 0 10px;color:#044335;border-bottom:1px solid #ddd;">
                                            Volunteer Descriptions</h3>

                                        <p><strong>Area of
                                                Interest:</strong><br>{{ strip_tags($volunteerForm->area_of_interest) }}
                                        </p>
                                        <p><strong>Skills:</strong><br>{{ strip_tags($volunteerForm->skill_experties) }}
                                        </p>
                                        <p><strong>Motivation:</strong><br>{{ strip_tags($volunteerForm->motivation) }}
                                        </p>
                                        <p><strong>Experience:</strong><br>{{ strip_tags($volunteerForm->previous_volunteer_experience) }}
                                        </p>
                                        <p><strong>Medical
                                                Description:</strong><br>{{ strip_tags($volunteerForm->medical_description) }}
                                        </p>
                                        <p><strong>Dietary
                                                Restrictions:</strong><br>{{ strip_tags($volunteerForm->dietary_restriction) }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

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
