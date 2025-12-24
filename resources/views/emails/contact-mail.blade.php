<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
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
                            <img src="{{ asset('assets/frontend/images/homepage/main_logo.png') }}" alt="School Logo"
                                style="max-width:200px;height:auto;display:block;">
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:20px;">

                            <h3 style="color:#044335;border-bottom:1px solid #ddd;padding-bottom:6px;">
                                Contact Us Details
                            </h3>

                            <table width="100%" cellpadding="6" cellspacing="0" style="font-size:14px;">
                                <tr>
                                    <td><strong>Full Name:</strong></td>
                                    <td>{{ $contact->full_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contact No:</strong></td>
                                    <td>{{ $contact->contact_no ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $contact->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Message:</strong></td>
                                    <td>{{ $contact->message ?? '' }}</td>
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
