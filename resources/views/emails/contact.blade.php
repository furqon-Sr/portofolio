<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru dari Kontak Portfolio</title>
</head>
<body style="margin: 0; padding: 0; background-color: #030712; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color: #f3f4f6; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #030712; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #090d16; border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px -10px rgba(0,0,0,0.7);">
                    <!-- Top Accent Line -->
                    <tr>
                        <td style="background-color: #3b82f6; height: 4px; line-height: 4px; font-size: 1px;">&nbsp;</td>
                    </tr>
                    
                    <!-- Header -->
                    <tr>
                        <td style="padding: 40px 40px 20px 40px;">
                            <span style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #3b82f6; display: block; margin-bottom: 8px;">Notifikasi Portfolio</span>
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: -0.025em; line-height: 1.25;">Pesan Baru Diterima</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 0 40px 40px 40px;">
                            <!-- Sender Metadata Grid -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 24px; border-bottom: 1px solid rgba(255, 255, 255, 0.06); padding-bottom: 24px;">
                                <tr>
                                    <td width="30%" style="padding: 8px 0; font-size: 13px; color: #9ca3af; font-weight: 500;">Pengirim</td>
                                    <td width="70%" style="padding: 8px 0; font-size: 14px; color: #ffffff; font-weight: 600;">{{ $contactName }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #9ca3af; font-weight: 500;">Email</td>
                                    <td style="padding: 8px 0; font-size: 14px; color: #3b82f6; font-weight: 600;">
                                        <a href="mailto:{{ $contactEmail }}" style="color: #3b82f6; text-decoration: none; border-bottom: 1px solid rgba(59, 130, 246, 0.2);">{{ $contactEmail }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px 0; font-size: 13px; color: #9ca3af; font-weight: 500;">Tanggal</td>
                                    <td style="padding: 8px 0; font-size: 13px; color: #e5e7eb;">{{ $contactTime }}</td>
                                </tr>
                            </table>

                            <!-- Message Content Box -->
                            <div style="background-color: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.04); border-radius: 12px; padding: 24px;">
                                <p style="margin: 0 0 12px 0; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: #6b7280;">Isi Pesan:</p>
                                <p style="margin: 0; font-size: 14px; color: #d1d5db; line-height: 1.6; white-space: pre-wrap;">{{ $contactMessage }}</p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: rgba(255, 255, 255, 0.01); border-top: 1px solid rgba(255, 255, 255, 0.04); padding: 24px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 11px; color: #4b5563;">Email ini dikirim secara otomatis melalui formulir kontak pada website Anda.</p>
                            <p style="margin: 6px 0 0 0; font-size: 11px; color: #6b7280;"><a href="{{ url('/') }}" style="color: #6b7280; text-decoration: none;">fahrurihanafi.vercel.app</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
