<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 16/12/14
 * Time: 12:29
 */
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'hellofresh',
    'username'  => 'HelloFresh',
    'password'  => 'HelloFresh',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();

$users = Capsule::table('users')->get();
