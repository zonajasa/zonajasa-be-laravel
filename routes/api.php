<?php

use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;

#import auth routes
require base_path('app/Internal/Api/Auth/Routes/AuthRoutes.php');

Route::get('/user-session', function (Request $request) {
    return $request->user(); //get user session
})->middleware('auth:api');

Route::get('/test-user-token', function (Request $request) {

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
