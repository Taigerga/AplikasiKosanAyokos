<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - AyoKos</title>
</head>
<body style="margin:0;padding:0;background-color:#fefce8;font-family:'Inter',Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#fefce8;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="560" cellpadding="0" cellspacing="0" style="background:#fff;border:4px solid #000;box-shadow:6px 6px 0 #000;max-width:560px;">
                    <tr>
                        <td style="border-bottom:4px solid #000;padding:32px 40px 24px;text-align:center;">
                            <div style="width:56px;height:56px;background:#000;border:2px solid #000;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                <span style="color:#fff;font-size:24px;font-weight:900;">AK</span>
                            </div>
                            <h1 style="font-size:24px;font-weight:900;margin:0 0 4px;color:#000;">Reset Password</h1>
                            <p style="font-size:14px;font-weight:700;color:#6b7280;margin:0;">AyoKos</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 40px;">
                            <p style="font-size:16px;font-weight:700;color:#000;margin:0 0 16px;">Halo, {{ $nama }}!</p>
                            <p style="font-size:14px;font-weight:500;color:#374151;margin:0 0 24px;line-height:1.6;">
                                Kami menerima permintaan reset password untuk akun AyoKos Anda. 
                                Klik tombol di bawah ini untuk mereset password Anda:
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto 24px;">
                                <tr>
                                    <td style="background:#38bdf8;border:3px solid #000;box-shadow:4px 4px 0 #000;" align="center">
                                        <a href="{{ $url }}" style="display:inline-block;padding:14px 36px;color:#000;font-size:16px;font-weight:800;text-decoration:none;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <p style="font-size:13px;font-weight:500;color:#6b7280;margin:0 0 8px;line-height:1.5;">
                                Link ini akan kadaluarsa dalam 60 menit. Jika Anda tidak meminta reset password, abaikan email ini.
                            </p>
                            <p style="font-size:13px;font-weight:500;color:#6b7280;margin:0;line-height:1.5;">
                                Jika tombol di atas tidak berfungsi, salin link berikut ke browser Anda:<br>
                                <span style="color:#38bdf8;word-break:break-all;">{{ $url }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top:4px solid #000;padding:20px 40px;text-align:center;">
                            <p style="font-size:12px;font-weight:500;color:#9ca3af;margin:0;">
                                &copy; {{ date('Y') }} AyoKos. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
