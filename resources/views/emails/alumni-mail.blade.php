<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Alumni Application</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f4f4">
        <tr>
            <td align="center">
                <!-- Main container -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff"
                    style="border-radius:8px; overflow:hidden;">
                    <!-- Header -->
                    <tr>
                        <td align="center" bgcolor="#044335" style="padding:20px;">
                            <img src="{{ asset('assets/frontend/images/homepage/main_logo.png') }}" alt="Gyanodaya Logo"
                                width="120" style="display:block; max-width:100%; height:auto;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px;">
                            <!-- Alumni Information -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td colspan="2"
                                        style="font-size:20px; font-weight:bold; color:#044335; border-bottom:1px solid #ddd; padding-bottom:5px; padding-bottom:10px;">
                                        Alumni Information
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">Full
                                        Name:</td>
                                    <td style="padding:5px;">{{ $alumniForm->full_name ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">Email:
                                    </td>
                                    <td style="padding:5px;">{{ $alumniForm->email ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">Mobile
                                        Number:</td>
                                    <td style="padding:5px;">{{ $alumniForm->mobile_number ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">
                                        Occupation:</td>
                                    <td style="padding:5px;">{{ $alumniForm->occupation ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">
                                        Designation:</td>
                                    <td style="padding:5px;">{{ $alumniForm->designation ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">Batch:
                                    </td>
                                    <td style="padding:5px;">{{ $alumniForm->batch ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">Country:
                                    </td>
                                    <td style="padding:5px;">{{ countries()[$alumniForm->country]['name'] ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; width:200px; vertical-align:top; padding:5px;">
                                        Testimonial:</td>
                                    <td style="padding:5px;">
                                        {{ strip_tags($alumniForm->testimonial->testimonial_text) ?? '' }}</td>
                                </tr>
                            </table>

                            <!-- Files Section -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin-top:20px;">
                                <tr>
                                    <td align="center">
                                        <!-- Company Logo -->
                                        <table cellpadding="0" cellspacing="0" border="0"
                                            style="display:inline-block; margin-right:10px; background:#e9f5ff; padding:10px; border-radius:8px;">
                                            <tr>
                                                <td align="center" style="font-weight:bold; padding-bottom:5px;">Company
                                                    Logo</td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    @if ($alumniForm->company_logo)
                                                        <a href="{{ asset($alumniForm->company_logo) }}"
                                                            target="_blank">
                                                            <img src="{{ asset($alumniForm->company_logo) }}"
                                                                alt="Company Logo" width="128" height="128"
                                                                style="border:1px solid #ddd; border-radius:8px; display:block;">
                                                        </a>
                                                    @else
                                                        <span>No company logo uploaded</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Testimonial Image -->
                                        <table cellpadding="0" cellspacing="0" border="0"
                                            style="display:inline-block; margin-left:10px; background:#e9f5ff; padding:10px; border-radius:8px;">
                                            <tr>
                                                <td align="center" style="font-weight:bold; padding-bottom:5px;">Image
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    @if ($alumniForm->testimonial->image)
                                                        <a href="{{ asset($alumniForm->testimonial->image) }}"
                                                            target="_blank">
                                                            <img src="{{ asset($alumniForm->testimonial->image) }}"
                                                                alt="Image" width="128" height="128"
                                                                style="border:1px solid #ddd; border-radius:8px; display:block;">
                                                        </a>
                                                    @else
                                                        <span>No image uploaded</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
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
            </td>
        </tr>
    </table>
</body>

</html>
