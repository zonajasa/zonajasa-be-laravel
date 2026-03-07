<?php

namespace App\Internal\Api\Auth\Constant;

class AuthConstant
{
    const MESSAGE_ERROR_EMAIL_OR_NO_WHATSAPP = 'No whatsapp atau email belum terdaftar';
    const MESSAGE_ERROR_PASSWORD = 'Password salah';
    const MESSAGE_SUCCESS_LOGIN = 'Berhasil kirim otp cek email atau whatsapp anda';
    const OTP_INVALID = 'OTP yang anda masukan salah';
    const MESSAGE_VERIFICATION_OTP_FAILED = 'Verifikasi OTP gagal,otp sudah kadaluarsa atau tidak ditemukan';
    const MESSAGE_SUCCESS_VERIFY_OTP = 'Berhasil verifikasi OTP silahkan masuk kedalam sistem';
    const MESSAGE_SUCCESS_REGISTER = 'Berhasil registrasi, silahkan verifikasi akun untuk masuk kedalam sistem';
    const MESSAGE_SUCCESS_LOGOUT = 'Berhasil logout,silahkan kembali login';
    const MESSAGE_SUCCESS_PROFILE = 'Berhasil mendapatkan data profile';
}
