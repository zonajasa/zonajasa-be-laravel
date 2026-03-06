<?php

namespace App\Internal\Api\Auth\Constant;

class AuthConstant
{
    const ERROR_EMAIL_OR_NO_WHATSAPP = 'No whatsapp atau email belum terdaftar';
    const ERROR_PASSWORD = 'Password salah';
    const SUCCESS_LOGIN = 'Berhasil kirim otp cek email atau whatsapp anda';
    const OTP_INVALID = 'OTP yang anda masukan salah';
    const VERIFICATION_OTP_FAILED = 'Verifikasi OTP gagal,otp sudah kadaluarsa atau tidak ditemukan';
    const SUCCESS_VERIFY_OTP = 'Berhasil verifikasi OTP silahkan masuk kedalam sistem';
}
