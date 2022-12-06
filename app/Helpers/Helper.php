<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper{

    public static function saveImgBase64($param, $folder)
    {
        $fileExtension = ['png', 'jpg', 'jpeg', 'gif'];
    
        if (count(explode(';', $param)) != 2) return false;
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        if (!in_array($tmpExtension[1], $fileExtension)) {
    
            return false;
        }
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');
    
        $checkDirectory = $storage->exists($folder);
    
        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
        return $fileName;
    }
}
