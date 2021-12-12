<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'initials' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'infix' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'initials' => $input['initials'],
            'first_name' => $input['first_name'],
            'infix' => $input['infix'],
            'last_name' => $input['last_name'],
            'postal_code' => $input['postal_code'],
            'address' => $input['address'],
            'city' => $input['city'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
