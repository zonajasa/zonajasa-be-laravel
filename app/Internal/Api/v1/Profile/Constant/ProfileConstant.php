<?php

namespace App\Internal\Api\v1\Profile\Constant;

class ProfileConstant
{
    const INVALID_REQUEST = 'Invalid request:mohon isi request dengan benar';
    const MESSAGE_INTERNAL_SERVER_ERROR = 'Maaf terjadi kesalahan pada sistem';
    const MESSAGE_SUCCESS_CREATE_JASA = 'Berhasil membuat jasa';
    const MESSAGE_INVALID_ID_SERVICE = 'ID Service tidak ditemukan';
    const MESSAGE_SUCCESS_DELETE_SERVICE = 'Berhasil menutup layanan';
    const MESSAGE_SUCCESS_GET_SERVICE = 'Berhasil mendapatkan jasa';
    const MESSAGE_UNSUCCESS_GET_SERVICE = 'Gagal mendapatkan data karena jasa belum dibuat';
    const MESSAGE_CATEOGORY_IS_INVALID = 'Maaf kategori belum tersedia';
    const MESSAGE_SUCCESS_GET_CATEGORY = 'Berhasil mendapatkan kategori';
}
