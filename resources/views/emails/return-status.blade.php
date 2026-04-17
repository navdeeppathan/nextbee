<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Return Update</title>
</head>
<body style="margin:0; padding:0; background:#f4f6f9; font-family: Arial, sans-serif;">

    <div style="max-width:600px; margin:30px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">

        <!-- HEADER -->
        <div style="background:#1e40af; padding:20px; color:white;">
            <h2 style="margin:0;">Return {{ ucfirst($status) }}</h2>
            <p style="margin:5px 0 0; font-size:13px;">
                Return ID: {{ $returnNumber }}
            </p>
        </div>

        <!-- BODY -->
        <div style="padding:20px;">

            <!-- CUSTOMER -->
            <div style="margin-bottom:20px;">
                <p style="margin:0; font-size:14px; color:#555;">Customer</p>
                <p style="margin:4px 0 0; font-weight:bold; font-size:16px;">
                    {{ $items->first()->user->name ?? '' }}
                </p>
                <p style="margin:2px 0; font-size:13px; color:#777;">
                    {{ $items->first()->user->email ?? '' }}
                </p>
            </div>

            <!-- MESSAGE -->
            <p style="font-size:14px; color:#444;">
                Your return request has been 
                <strong style="color:{{ $status == 'approved' ? '#16a34a' : '#dc2626' }}">
                    {{ ucfirst($status) }}
                </strong>.
            </p>

            <!-- ITEMS TABLE -->
            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse; margin-top:15px;">
                <thead>
                    <tr style="background:#f1f5f9; text-align:left;">
                        <th style="font-size:12px; color:#555;">Product</th>
                        <th style="font-size:12px; color:#555;">Qty</th>
                        <th style="font-size:12px; color:#555;">Price</th>
                        <th style="font-size:12px; color:#555;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="font-size:14px;">
                            {{ $item->product->title ?? '' }}
                        </td>
                        <td style="font-size:14px;">
                            {{ $item->quantity }}
                        </td>
                        <td style="font-size:14px;">
                            £{{ number_format($item->product->price ?? 0, 2) }}
                        </td>
                        <td style="font-size:14px; font-weight:bold;">
                            £{{ number_format(($item->quantity * ($item->product->price ?? 0)), 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- SUMMARY -->
            @if($status == 'approved')
            <div style="margin-top:20px; padding:15px; background:#f0fdf4; border-radius:8px;">
                <p style="margin:0; font-size:14px; color:#166534;">
                    Refund Amount
                </p>
                <p style="margin:5px 0 0; font-size:20px; font-weight:bold; color:#16a34a;">
                    £{{ number_format($refund, 2) }}
                </p>
            </div>
            @else
            <div style="margin-top:20px; padding:15px; background:#fef2f2; border-radius:8px;">
                <p style="margin:0; font-size:14px; color:#991b1b;">
                    Your return request was not approved.
                </p>
            </div>
            @endif

        </div>

        <!-- FOOTER -->
        <div style="background:#f8fafc; padding:15px; text-align:center; font-size:12px; color:#888;">
            © {{ date('Y') }} Your Company • All rights reserved
        </div>

    </div>

</body>
</html>