<?php

namespace Tests;


use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const USER_NAME     = 'holla_die_waldfee';
    const USER_PASSWORT = '1234';
    const USER_FULLNAME = 'Holla die Waldfee';
    const USER_EMAIL    = 'holla@localhost';

    public $user = null;

    /**
     * @param User|null $user
     */
    public function withUser(User $user = null)
    {
        if (!$user) {
            $user = User::firstOrCreate([
                'username' => self::USER_NAME,
                'password' => Hash::make(self::USER_PASSWORT),
                'fullname' => self::USER_FULLNAME,
                'email'    => self::USER_EMAIL
            ]);

            $this->user = $user;
        }

        Passport::actingAs($user);
    }
}
