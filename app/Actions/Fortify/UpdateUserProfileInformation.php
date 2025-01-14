<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    protected $protectedNames = [
        'admin',
        'support',
        'help',
        'official',
    ];

    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],

            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:30',
                Rule::unique(User::class)->ignore($user->id),
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s.-]*[a-zA-Z0-9]$/',
                'not_regex:/^\d+$/',
                'not_regex:/\s{2,}/',
                function ($attribute, $value, $fail) {
                    // Protected names check
                    if (in_array(strtolower($value), array_map('strtolower', $this->protectedNames))) {
                        $fail('This artist name is protected. If you are the legitimate owner, please contact support for verification.');
                    }
                    // Similar names check
                    $sanitizedValue = strtolower(preg_replace('/[._\-\s]/', '', $value));
                    foreach ($this->protectedNames as $protected) {
                        $sanitizedProtected = strtolower(preg_replace('/[._\-\s]/', '', $protected));
                        if ($sanitizedValue === $sanitizedProtected) {
                            $fail('This artist name is too similar to a protected name. Please choose another.');
                        }
                    }
                    // Impersonation check
                    $impersonationPatterns = ['real', 'official', 'verified', 'thereal', 'original'];
                    foreach ($impersonationPatterns as $pattern) {
                        if (stripos($value, $pattern) !== false) {
                            $fail('Artist names containing terms like "real", "official", or "verified" are not allowed.');
                        }
                    }
                },
            ],
        'location' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ])->validate();

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'location' => $input['location'],
                'region' => $input['region'],
                'country' => $input['country'],
            ])->save();
            $user->profile->save();

            session()->flash('success', 'Your profile has been updated successfully.');
        }
    }

    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
