<?php

namespace HelloFresh\Utils;
/**
 * Created by PhpStorm.
 * User: James
 * Date: 16/12/14
 * Time: 14:14
 */

class FormUtils {
    public function sanitiseInput ($input)
    {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
}