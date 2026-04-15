<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Price List</title>
</head>
<body style="margin:0; padding:0; background:#f1f5f9; font-family:Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 0;">
        <tr>
            <td align="center">

                <!-- CARD -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 25px rgba(0,0,0,0.05);">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#0f172a; padding:20px; text-align:center;">
                            <h1 style="color:#ffffff; margin:0; font-size:20px;">
                                Nextbee
                            </h1>
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:30px; color:#334155;">

                            <h2 style="margin-top:0; font-size:18px;">
                                Hello {{ $customer->name }},
                            </h2>

                            <p style="font-size:14px; line-height:1.6;">
                                We’re excited to share our latest <strong>price list</strong> with you.
                                Please find the attached document for detailed product pricing.
                            </p>

                            <!-- CTA -->
                            <div style="margin:25px 0; text-align:center;">
                                <span style="display:inline-block; background:#2563eb; color:#fff; padding:12px 20px; border-radius:8px; font-size:14px;">
                                    📎 Price List Attached
                                </span>
                            </div>

                            <p style="font-size:14px;">
                                If you have any questions or need assistance, feel free to reach out to your sales representative.
                            </p>

                            <p style="margin-top:30px; font-size:14px;">
                                Regards,<br>
                                <strong>Nextbee Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f8fafc; padding:20px; text-align:center; font-size:12px; color:#64748b;">
                            © {{ date('Y') }} Nextbee. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>