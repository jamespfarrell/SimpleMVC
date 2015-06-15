<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 16/12/14
 * Time: 14:14
 */
namespace HelloFresh\Utils;

class EncryptUtil {

    public function __construct() {
       // $this->Rhythm = $rhythm;


    }

    public function verify($password, $hashedPassword) {

        return crypt($password, $hashedPassword) == $hashedPassword;
    }


    public function encryptString ($password) {



         // A higher "cost" is more secure but consumes more processing power
                $cost = 10;

        // Create a random salt
                $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
                $salt = sprintf("$2a$%02d$", $cost) . $salt;

        // Value:
        // $2a$10$eImiTXuWVxfM37uY4JANjQ==

        // Hash the password with the salt
                $hash = crypt($password, $salt);

        // Value:
        // $2a$10$eImiTXuWVxfM37uY4JANjOL.oTxqp7WylW7FCzx2Lc7VLmdJIddZq
        return $hash;
    }
}