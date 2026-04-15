<?php

namespace App\Internal\Api\v1\Auth\Constant;

class AuthConstant
{
    const MESSAGE_ERROR_EMAIL_OR_NO_WHATSAPP = 'No whatsapp dan password tidak terdaftar';
    const MESSAGE_SUCCESS_LOGIN = 'Successfully Login';
    const OTP_INVALID = 'OTP yang anda masukan salah';
    const MESSAGE_VERIFICATION_OTP_FAILED = 'OTP tidak ditemukan harap lakukan permintaan ulang';
    const MESSAGE_SUCCESS_VERIFY_OTP = 'Berhasil verifikasi OTP silahkan masuk kedalam sistem';
    const MESSAGE_SUCCESS_REGISTER = 'Berhasil registrasi, silahkan verifikasi akun untuk masuk kedalam sistem';
    const MESSAGE_SUCCESS_LOGOUT = 'Berhasil logout,silahkan kembali login';
    const MESSAGE_SUCCESS_PROFILE = 'Berhasil mendapatkan data profile';
    const MESSAGE_VERIFY_ACCOUNT = 'Maaf akun anda belum terverifikasi,harap segera lakukan verifikasi';
}
