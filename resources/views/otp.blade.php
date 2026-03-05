<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Kode OTP Verifikasi - Zona Jasa</title>
    <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
    <style type="text/css">
        /* Reset */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #E8F0FE;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* Base Styles */
        .email-body {
            background-color: #E8F0FE;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
        }

        /* Typography */
        .heading {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #1A56DB;
            line-height: 1.3;
        }

        .subheading {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #1E3A5F;
            line-height: 1.4;
        }

        .body-text {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #4A5568;
            line-height: 1.6;
        }

        .small-text {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            font-weight: 400;
            color: #8896AB;
            line-height: 1.5;
        }

        /* OTP Box */
        .otp-code {
            font-family: 'Courier New', Courier, monospace;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: 12px;
            color: #1A56DB;
            background-color: #EBF2FF;
            border: 2px dashed #1A56DB;
            border-radius: 12px;
            padding: 20px 32px;
            display: inline-block;
        }

        /* Button */
        .btn-primary {
            background-color: #1A56DB;
            color: #ffffff !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 8px;
            display: inline-block;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid #D4E0F0;
            margin: 0;
        }

        /* Responsive */
        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }

            .padding-mobile {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .otp-code {
                font-size: 30px !important;
                letter-spacing: 8px !important;
                padding: 16px 20px !important;
            }

            .heading {
                font-size: 20px !important;
            }

            .logo-img {
                width: 100px !important;
                height: 100px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; background-color: #E8F0FE;">
    <!-- Preheader (hidden text for email preview) -->
    <div
        style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
        Kode OTP Verifikasi Anda: {{ $otp }} - Zona Jasa
    </div>

    <!-- Main Email Wrapper -->
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #E8F0FE;">
        <tr>
            <td align="center" style="padding: 30px 10px;">
                <table role="presentation" class="email-container" cellpadding="0" cellspacing="0" width="600"
                    style="max-width: 600px; margin: 0 auto;">

                    <!-- ========== HEADER ========== -->
                    <tr>
                        <td align="center"
                            style="background: linear-gradient(135deg, #1A56DB 0%, #2E7AE6 50%, #4A9AF5 100%); border-radius: 16px 16px 0 0; padding: 36px 40px 28px 40px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/photo_2026-02-28_13-29-51-KegAHKB72Gj2YaiDkKeOPGK7srXQ5r.jpg"
                                            alt="Zona Jasa Logo" class="logo-img" width="120" height="120"
                                            style="display: block; width: 120px; height: 120px; border-radius: 16px; object-fit: cover;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 16px;">
                                        <h1
                                            style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 24px; font-weight: 800; color: #FFFFFF; letter-spacing: 2px;">
                                            ZONA JASA</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 4px;">
                                        <p
                                            style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; font-weight: 400; color: #C5DCFA; letter-spacing: 1px;">
                                            Solusi Jasa Terdekat</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ========== CONTENT ========== -->
                    <tr>
                        <td style="background-color: #FFFFFF; padding: 40px 44px;" class="padding-mobile">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <!-- Greeting -->
                                <tr>
                                    <td>
                                        <p class="heading"
                                            style="margin: 0 0 8px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 22px; font-weight: 700; color: #1A56DB;">
                                            Verifikasi Akun Anda</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="body-text"
                                            style="margin: 0 0 24px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 15px; color: #4A5568; line-height: 1.6;">
                                            Halo <strong style="color: #1E3A5F;">{{ $full_name }}</strong>,<br />
                                            Kami menerima permintaan untuk memverifikasi akun Zona Jasa Anda. Gunakan
                                            kode OTP di bawah ini untuk melanjutkan:
                                        </p>
                                    </td>
                                </tr>

                                <!-- OTP Code Box -->
                                <tr>
                                    <td align="center" style="padding: 12px 0 28px 0;">
                                        <table role="presentation" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center"
                                                    style="background-color: #EBF2FF; border: 2px dashed #1A56DB; border-radius: 12px; padding: 22px 36px;">
                                                    <span class="otp-code"
                                                        style="font-family: 'Courier New', Courier, monospace; font-size: 40px; font-weight: 800; letter-spacing: 12px; color: #1A56DB; line-height: 1;">{{ $otp }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Expiry Notice -->
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td
                                                    style="background-color: #FFF7ED; border-radius: 8px; padding: 12px 20px; border-left: 4px solid #F59E0B;">
                                                    <p
                                                        style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px; color: #92400E; line-height: 1.5;">
                                                        &#9200; Kode ini berlaku selama <strong>1 menit</strong>. Jangan
                                                        bagikan kode ini kepada siapapun.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Divider -->
                                <tr>
                                    <td style="padding: 28px 0;">
                                        <hr style="border: none; border-top: 1px solid #E2E8F0; margin: 0;" />
                                    </td>
                                </tr>

                                <!-- Security Info -->
                                <tr>
                                    <td>
                                        <p class="subheading"
                                            style="margin: 0 0 10px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: 600; color: #1E3A5F;">
                                            &#128274; Tips Keamanan:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-left: 4px;">
                                        <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="padding: 4px 0;">
                                                    <p
                                                        style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; color: #4A5568; line-height: 1.6;">
                                                        &#8226; Jangan pernah membagikan kode OTP kepada siapapun</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 4px 0;">
                                                    <p
                                                        style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; color: #4A5568; line-height: 1.6;">
                                                        &#8226; Tim Zona Jasa tidak akan pernah meminta kode OTP Anda
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 4px 0;">
                                                    <p
                                                        style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; color: #4A5568; line-height: 1.6;">
                                                        &#8226; Jika Anda tidak meminta kode ini, abaikan email ini</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Divider -->
                                <tr>
                                    <td style="padding: 28px 0;">
                                        <hr style="border: none; border-top: 1px solid #E2E8F0; margin: 0;" />
                                    </td>
                                </tr>

                                <!-- Help Section -->
                                <tr>
                                    <td align="center">
                                        <p
                                            style="margin: 0 0 16px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; color: #64748B; line-height: 1.5;">
                                            Butuh bantuan? Hubungi tim support kami
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!--[if mso]>
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="mailto:support@zonajasa.com" style="height:48px;v-text-anchor:middle;width:200px;" arcsize="17%" fillcolor="#1A56DB">
                      <w:anchorlock/>
                      <center style="color:#ffffff;font-family:'Segoe UI',sans-serif;font-size:15px;font-weight:600;">Hubungi Support</center>
                    </v:roundrect>
                    <![endif]-->
                                        <!--[if !mso]><!-->
                                        <a href="mailto:support@zonajasa.com" class="btn-primary"
                                            style="background-color: #1A56DB; color: #ffffff !important; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 15px; font-weight: 600; text-decoration: none; padding: 14px 40px; border-radius: 8px; display: inline-block;">Hubungi
                                            Support</a>
                                        <!--<![endif]-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ========== FOOTER ========== -->
                    <tr>
                        <td style="background-color: #0F3A7D; border-radius: 0 0 16px 16px; padding: 32px 44px;"
                            class="padding-mobile">
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <!-- Social Links -->
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <table role="presentation" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 0 8px;">
                                                    <a href="https://zonajasa.com"
                                                        style="color: #A8C8F0; text-decoration: none; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px;"
                                                        target="_blank">Website</a>
                                                </td>
                                                <td style="color: #3B6DB5; padding: 0 4px;">|</td>
                                                <td style="padding: 0 8px;">
                                                    <a href="https://www.instagram.com/zonajasaplatform/"
                                                        style="color: #A8C8F0; text-decoration: none; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px;"
                                                        target="_blank">Instagram</a>
                                                </td>
                                                <td style="color: #3B6DB5; padding: 0 4px;">|</td>
                                                <td style="padding: 0 8px;">
                                                    <a href="https://wa.me/6287868000622"
                                                        style="color: #A8C8F0; text-decoration: none; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 13px;"
                                                        target="_blank">WhatsApp</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Divider -->
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <hr style="border: none; border-top: 1px solid #1D4E8A; margin: 0;" />
                                    </td>
                                </tr>

                                <!-- Company Info -->
                                <tr>
                                    <td align="center">
                                        <p
                                            style="margin: 0 0 6px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 14px; font-weight: 600; color: #FFFFFF;">
                                            Zona Jasa</p>
                                        <p
                                            style="margin: 0 0 4px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 12px; color: #8AAED4; line-height: 1.5;">
                                            Solusi Jasa Terdekat untuk Kebutuhan Anda</p>
                                        <p
                                            style="margin: 0 0 16px 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 12px; color: #6B95C4; line-height: 1.5;">
                                            Indonesia</p>
                                    </td>
                                </tr>

                                <!-- Legal -->
                                <tr>
                                    <td align="center">
                                        <p
                                            style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 11px; color: #5A84B3; line-height: 1.5;">
                                            &copy; 2026 Zona Jasa. All rights reserved.<br />
                                            Email ini dikirim secara otomatis, mohon tidak membalas email ini.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
