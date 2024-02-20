<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Notifications\WelcomeSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request) {

        $data = $request->validate([
            'fullname' => 'required|string|min:2|max:100',
            'email' => 'required|string|email',
            'phoneNumber' => 'required|string|min:7|max:20',
            'country' => 'required|string|min:2|max:100',
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'email' => $data['email'],
                'fullname' => $data['fullname']
            ]);

            $user->userCountry()->create([
                'country_name' =>   $data['country']
            ]);

            $user->phoneBook()->create([
                'phone_number' =>   $data['phoneNumber']
            ]);

            // Send an email
            //Mail::to($user->email)->send(new WelcomeEmail());

            // Send sms
            //$user->notify(new WelcomeSms());
        });

        return response()->json([
            'message' => 'User successfully generated'
        ]);
    }
}
