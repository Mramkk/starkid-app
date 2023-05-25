<?php

namespace App\Helper;

class ResMsg
{
    public static function invalidAction()
    {
        return json_encode([
            "status" => false,
            "message" => "Invalid action type"
        ]);
    }
    public static function invalidUser()
    {
        return json_encode([
            "status" => false,
            "message" => "Invalid user"
        ]);
    }
    public static function credentials()
    {
        return json_encode([
            "status" => false,
            "message" => "Invalid login credentials"
        ]);
    }
    public static function error()
    {
        return json_encode([
            "status" => false,
            "message" => "Error ! please try again later."
        ]);
    }
    public static function passNotMatched()
    {
        return json_encode([
            "status" => false,
            "message" => "Invalid current password !."
        ]);
    }
    public static function invalidImg($msg)
    {
        return json_encode([
            "status" => false,
            "message" => $msg
        ]);
    }
    public static function failed($msg)
    {
        return json_encode([
            "status" => false,
            "message" => $msg
        ]);
    }
    public static function inactiveUser()
    {
        return json_encode([
            "status" => false,
            "message" => "You are an Inactive User !"
        ]);
    }
    public static function rlMsg($msg, $uid, $token)
    {
        return json_encode([
            "status" => true,
            "message" => $msg,
            "uid" => $uid,
            "token" => $token
        ]);
    }
    public static function data($msg, $data)
    {
        return json_encode([
            "status" => true,
            "message" => $msg,
            "data" => $data
        ]);
    }
    public static function success($msg)
    {
        return json_encode([
            "status" => true,
            "message" => $msg,
        ]);
    }
    public static function logout()
    {
        return json_encode([
            "status" => true,
            "message" => "You logout successfully !"
        ]);
    }


    public static function exception()
    {
        return json_encode([
            'status' => false,
            'message' => "Exeption !",
        ]);
    }
}
