<?php
namespace App\Helpers;

class AppHelper
{   
    public function fail($validator)
    {
        $err = array();
        $errors = $validator->errors();
        $all_messagges = "";
        $i = 0;
        $len = count($errors->all());
        foreach ($errors->all() as $message) {
            if ($i == $len - 1) {
                $all_messagges = $all_messagges . $message;
            } else {
                $all_messagges = $all_messagges . $message . ", ";
            }
            $i++;
        }
        $err['message'] = $all_messagges;
        return  response($err, 400)
                ->header('Content-Type', 'application/json');
    }

    public function error($errors)
    {
        $json = $errors;
        return  response($json, 403)
                        ->header('Content-Type', 'application/json');
    }
    
    public function unauthorized($errors)
    {
        $json = $errors;
        return  response($json, 401)
                        ->header('Content-Type', 'application/json');
    }
    public function equal($message)
    {
        $json = $message;
        return  response($json, 409)
                        ->header('Content-Type', 'application/json');
    }
    public function teapot($message)
    {
        $json = $message;
        return  response($json, 418)
                        ->header('Content-Type', 'application/json');
    }
    
    
    public function success($data)
    {
//         $options = app('request')->header('accept-charset') == 'utf-8' ? JSON_UNESCAPED_UNICODE : null;

        return response()->json($data);
    }

    public static function instance()
    {
     return new AppHelper();
    }
}