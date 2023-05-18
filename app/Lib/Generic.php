<?php

namespace App\Lib;

class Generic 
{

    public static function upload_image($file)
    {
        $filename   = time() . rand(111, 699) . '.' . $file->getClientOriginalExtension();
        $file->move('upload/', $filename);
        return $filename;
    }

    public static function delete_image($filename)
    {
        $path = public_path('upload/' . $filename);
        if (file_exists($path)) {
            unlink($path);
            return true;
        } else {
            return false;    
        }
    }
}
