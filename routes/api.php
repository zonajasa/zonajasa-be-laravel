<?php

use App\Infrastructure\Database\v1\Eloquent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;

#import auth routes:admin & mobile
Route::prefix('v1/admin')->group(function () {
    Route::middleware('admin.header')->group(function () {});
});


Route::prefix('v1/user')->group(function () {
    Route::middleware('user.header')->group(function () {
        require base_path('app/Internal/Api/v1/Auth/Routes/AuthRoutes.php');
        require base_path('app/Internal/Api/v1/Jasa/Routes/JasaRoutes.php');
        require base_path('app/Internal/Api/v1/Profile/Routes/ProfileRoutes.php');
    });

    //kalo true api debug nya jalan selain itu default nya hanya base api fitur
    if (config('app.debug') == true) {
        //debug API
        Route::get('session', function (Request $request) {
            return Auth::guard('api')->user();
        })->middleware('auth:api');


        Route::post('encrypt-decrypt', function (Request $request) {
            $data = $request->post();
            if (empty($data)) {
                return ErrorRes('Data is required for encryption or decryption');
            }

            if ($data['type'] !== 'encrypt' && $data['type'] !== 'decrypt') {
                return ErrorRes('Invalid type. Type must be either "encrypt" or "decrypt".');
            }

            if (empty($data['data'])) {
                return ErrorRes('Masukan data email dan no whatsapp');
            }

            switch ($data['type']) {
                case 'encrypt':
                    if (!empty($data['data']['email'])) {
                        $data['data']['email'] = Crypt::encryptString($data['data']['email']);
                    }

                    if (!empty($data['data']['no_whatsapp'])) {
                        $data['data']['no_whatsapp'] = Crypt::encryptString($data['data']['no_whatsapp']);
                    }
                    return OkRes('Encrypted successfully', [
                        'email' =>  !empty($data['data']['email']) ? $data['data']['email'] : null,
                        'no_whatsapp' =>  !empty($data['data']['no_whatsapp']) ? $data['data']['no_whatsapp'] : null
                    ]);
                default:
                    if (!empty($data['data']['email'])) {
                        $data['data']['email'] = Crypt::decryptString($data['data']['email']);
                    }

                    if (!empty($data['data']['no_whatsapp'])) {
                        $data['data']['no_whatsapp'] = Crypt::decryptString($data['data']['no_whatsapp']);
                    }
                    return OkRes('Decrypted successfully', [
                        'email' =>  !empty($data['data']['email']) ? $data['data']['email'] : null,
                        'no_whatsapp' =>  !empty($data['data']['no_whatsapp']) ? $data['data']['no_whatsapp'] : null
                    ]);
            }
        });

        Route::post('token', function (Request $request) {

            //validation request
            $req = $request->post('user_id');
            if (empty($req)) {
                return response()->json([
                    'message' => 'User id is required'
                ], 422);
            }

            //get reterive user data by id valid or not
            $user = User::find($req);
            if (!empty($user)) {

                //create token personal akses
                $token = $user->createToken('zonajasa')->accessToken;

                //retriving token valid as user
                $tokenValid = $user->tokens()
                    ->with('client')
                    ->where('revoked', false)
                    ->where('expires_at', '>', now())
                    ->get()
                    ->filter(fn(Token $token) => $token->client->hasGrantType('personal_access'));
                return response()->json([
                    'message' => 'User found',
                    'user' => $user,
                    'token' => $token,
                    'token_valid' => $tokenValid,
                ], 200);
            } else {
                //default invalid user id
                return response()->json([
                    'message' => 'User not found'
                ], 422);
            }
        });
    }
});
