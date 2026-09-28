<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kode OTP SADARIN</title>
</head>

<body
    style="
        margin:0;
        padding:0;
        background:#f1f5f9;
        font-family:Arial, Helvetica, sans-serif;
        color:#334155;
    ">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f1f5f9; padding:40px 15px;">

        <tr>

            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="
                        max-width:560px;
                        background:#ffffff;
                        border-radius:16px;
                        overflow:hidden;
                        border:1px solid #e2e8f0;
                    ">

                    {{-- =====================================================
                        HEADER
                    ====================================================== --}}

                    <tr>

                        <td
                            style="
                                background:#0f172a;
                                padding:28px 30px;
                                text-align:center;
                            ">

                            <div
                                style="
                                    font-size:28px;
                                    font-weight:700;
                                    color:#ffffff;
                                    letter-spacing:1px;
                                ">
                                SADARIN
                            </div>

                            <div
                                style="
                                    margin-top:6px;
                                    font-size:12px;
                                    color:#cbd5e1;
                                ">
                                Sistem Arsip Data dan Berkas Internal
                            </div>

                        </td>

                    </tr>


                    {{-- =====================================================
                        CONTENT
                    ====================================================== --}}

                    <tr>

                        <td style="padding:35px 30px;">

                            <div
                                style="
                                    font-size:14px;
                                    color:#64748b;
                                ">
                                Halo,
                            </div>


                            <div
                                style="
                                    margin-top:8px;
                                    font-size:20px;
                                    font-weight:700;
                                    color:#0f172a;
                                ">
                                {{ $nama }}
                            </div>


                            <p
                                style="
                                    margin:20px 0 0 0;
                                    font-size:14px;
                                    line-height:1.7;
                                    color:#475569;
                                ">
                                Kami menerima permintaan login ke akun SADARIN Anda.
                                Gunakan kode OTP berikut untuk melanjutkan proses login.
                            </p>


                            {{-- =================================================
                                OTP BOX
                            ================================================== --}}

                            <div
                                style="
                                    margin:28px 0;
                                    padding:22px;
                                    background:#f8fafc;
                                    border:1px solid #e2e8f0;
                                    border-radius:14px;
                                    text-align:center;
                                ">

                                <div
                                    style="
                                        font-size:11px;
                                        font-weight:700;
                                        text-transform:uppercase;
                                        letter-spacing:2px;
                                        color:#64748b;
                                    ">
                                    Kode OTP
                                </div>


                                <div
                                    style="
                                        margin-top:12px;
                                        font-size:36px;
                                        line-height:1;
                                        font-weight:700;
                                        letter-spacing:10px;
                                        color:#0f766e;
                                    ">
                                    {{ $otp }}
                                </div>


                                <div
                                    style="
                                        margin-top:14px;
                                        font-size:12px;
                                        color:#94a3b8;
                                    ">
                                    Berlaku selama 10 menit
                                </div>

                            </div>


                            {{-- =================================================
                                WARNING
                            ================================================== --}}

                            <div
                                style="
                                    padding:14px 16px;
                                    background:#fff7ed;
                                    border:1px solid #fed7aa;
                                    border-radius:10px;
                                    font-size:12px;
                                    line-height:1.6;
                                    color:#9a3412;
                                ">

                                <strong>Perhatian:</strong>

                                Jangan berikan kode OTP ini kepada siapa pun,
                                termasuk pihak yang mengaku sebagai administrator SADARIN.

                            </div>


                            <p
                                style="
                                    margin:25px 0 0 0;
                                    font-size:13px;
                                    line-height:1.7;
                                    color:#64748b;
                                ">
                                Jika Anda tidak merasa melakukan login,
                                Anda dapat mengabaikan email ini.
                            </p>


                            <p
                                style="
                                    margin:25px 0 0 0;
                                    font-size:13px;
                                    line-height:1.7;
                                    color:#64748b;
                                ">

                                Terima kasih,<br>

                                <strong style="color:#334155;">
                                    Tim SADARIN
                                </strong>

                            </p>

                        </td>

                    </tr>


                    {{-- =====================================================
                        FOOTER
                    ====================================================== --}}

                    <tr>

                        <td
                            style="
                                padding:20px 30px;
                                background:#f8fafc;
                                border-top:1px solid #e2e8f0;
                                text-align:center;
                            ">

                            <div
                                style="
                                    font-size:11px;
                                    line-height:1.6;
                                    color:#94a3b8;
                                ">

                                Email ini dikirim secara otomatis oleh sistem SADARIN.

                                <br>

                                © {{ date('Y') }} SADARIN

                            </div>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>

</body>

</html>
