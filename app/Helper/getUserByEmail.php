<?php
if (!function_exists('getUserByEmail')) {
    function getUserByEmail($email)
    {
        return \App\Models\User::where('email', $email)->first();
    }
}

