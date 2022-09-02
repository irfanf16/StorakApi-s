<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

trait ApiHelper
{
    /*
    |======================================================================
    | This Function Converts File (png,jpg,pdf,etc) to Base64
    |======================================================================
    */
    public static function file64($image)
    {
        $path = $image->getRealPath();

        $mimeType = $image->getMimeType();
        $path = $path;
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        // MAKE DATA-URL
        $base64 = "data:$mimeType". ';base64,' . base64_encode($data);

        return $base64;
    }



    /*
    |======================================================================
    | This Function Converts Base64 to File
    |======================================================================
    | 1-Here in this function we are taking a base64 string and convert into a file.
    | 2-This function takes a base64 object and returns us an array consisting of
    | file and file-name;
    */
    public static function base64_to_file($image_64)
    {
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = Str::random(10).'.'.$extension;

        return json_decode(json_encode([
            "name" => $imageName,
            "file" => $image,
        ]) );
    }



    /*
    |=========================================================================
    | This Helper Method Uploads File In Storage-Folder and Returns File-Name
    |=========================================================================
    */
    public static function uploadFile($image , $disk , $subfolder ,  $scaling = false  )
    {
        $primary_image = self::base64_to_file($image);

        $primary_image_file =base64_decode($primary_image->file);

        // SAVE ORIGIONAL IMAGE -- lg FOLDER
        Storage::disk("$disk")->put("$subfolder/lg/".$primary_image->name, $primary_image_file );

        if($scaling ){
            $primary_image_make = Image::make($primary_image_file);

            // SAVE MEDIUM IMAGE -- md FOLDER
            $primary_image_make->resize(500 , 500 ,function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $toimg = (string) $primary_image_make->stream('png');
            Storage::disk("$disk")->put("$subfolder/md/".$primary_image->name, $toimg  ) ;

            // SAVE SMALL IMAGE -- sm FOLDER
            $primary_image_make->resize(150 , 150 ,function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $toimg = (string) $primary_image_make->stream('png');
            Storage::disk("$disk")->put("$subfolder/sm/".$primary_image->name, $toimg  ) ;

            return $primary_image->name;
        }

        return $primary_image->name;
    }





    public static function dataurl_to_csv($file){
        $extension = explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($file, 0, strpos($file, ',')+1);

        // find substring fro replace here eg: data:image/png;base64,

        $file = str_replace($replace, '', $file);
        $file = str_replace(' ', '+', $file);

        $imageName = Str::random(10).'.csv';

        return json_decode(json_encode([
            "name" => $imageName,
            "file" => $file,
        ]) );
    }


    public static function uploadCSV($file , $disk , $subfolder )
    {

        $file = self::dataurl_to_csv($file);
        // return $file;

        $file_decoded = base64_decode($file->file) ;

        Storage::disk("$disk")->put("$subfolder".$file->name, $file_decoded );



        return $file->name;
    }


}
