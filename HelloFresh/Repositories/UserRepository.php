<?php
namespace HelloFresh\Repositories;
use Illuminate\Database\Eloquent as Eloquent;
use Illuminate\Database\Capsule\Manager as Capsule;

class UserRepository   {

    public function getUsers($email)
    {
        return Capsule::table('users')
            ->where('email', '=', $email)
            ->get();
    }

}