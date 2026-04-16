<?php

namespace App\Internal\Api\v1\Auth\Constant;

class AuthConstant
{
    const MESSAGE_ERROR_EMAIL_OR_NO_WHATSAPP = 'No whatsapp dan password tidak terdaftar';
    const MESSAGE_SUCCESS_LOGIN = 'Successfully Login';
    const OTP_INVALID = 'OTP yang anda masukan salah';
    const MESSAGE_OTP_EXPIRED = 'OTP yang anda masukan sudah expired harap lakukan permintaan ulang';
    const MESSAGE_SUCCESS_VERIFY_OTP = 'Berhasil verifikasi OTP';
    const MESSAGE_SUCCESS_REGISTER = 'Berhasil registrasi, silahkan verifikasi akun untuk masuk kedalam sistem';
    const MESSAGE_SUCCESS_LOGOUT = 'Berhasil logout,silahkan kembali login';
    const MESSAGE_SUCCESS_PROFILE = 'Berhasil mendapatkan data profile';
    const MESSAGE_VERIFY_ACCOUNT = 'Maaf akun anda belum terverifikasi,harap segera lakukan verifikasi';
    const MESSAGE_INTERNAL_SERVER_ERROR = 'Maaf terjadi kesalahan pada sistem';
    const MESSAGE_INPUT_INVALID = 'Input tidak valid';
    const MESSAGE_SUCCESS_RESEND_OTP = 'Berhasil mengirim ulang OTP, silahkan cek kembali di WhatsApp anda';
    const MESSAGE_SUCCESS_FORGOT_PASSWORD = 'Berhasil melakukan permintaan reset password, silahkan cek kembali di WhatsApp anda';
    const MESSAGE_SUCCESS_RESET_PASSWORD = 'Berhasil reset password, silahkan login kembali dengan password baru anda';
}
