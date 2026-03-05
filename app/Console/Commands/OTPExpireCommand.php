<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OTPExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:check-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expired code OTP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // get otp yang expire
        $otp = DB::table('otps')->where('expired_at', '<', now()->timezone(config('app.timezone'))->format('H:i:s'))->get();
        foreach ($otp as $otp_item) {

            //buat message
            $message = "Menghapus OTP dengan ID {$otp_item->id}, code: {$otp_item->code}, expired_at: {$otp_item->expired_at}";

            //simpan informasi log di log cron expire code otp
            Log::channel('otp_expire')->info($message);

            //delete otp yang sudah expired
            DB::table('otps')->where('code', '=', $otp_item->code)->delete();

            //tetap tampil infonya kalo jalan manual
            $this->info('Berhasil delete OTP expired');
        }
    }
}
