<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Maatwebsite\Excel;
class MassuploadController extends Controller
{
    //
    use ApiHelper;

    public function store(Request $request){
        // dd($request->all());
        // return $request->all();
        $file_name =$this->uploadCSV($request->product_csv , 'public' , 'massupload/products/');
        $file_path = url('/')."/storage/massupload/products/$file_name";
        // return $file_name;
        // $file = file(url('/')."/storage/massupload/products/$file_name");


        // \Excel::toCollection(new ProductImport , $file);
        // return $this->csvToArray($file);
        // $rows = $this->csvToArray($file);
        // $csv = str_getcsv(file_get_contents(url('/')."/storage/massupload/products/$file_name"));


        $csv = array();
        $file = fopen($file_path, 'r');

        while (($result = fgetcsv($file)) !== false)
        {
            $csv[] = $result;
        }

        fclose($file);



        return url('/')."/storage/massupload/products/$file_name";

    }

    public function csvToArray($csvFile){

        $file_to_read = fopen($csvFile, 'r');

        while (!feof($file_to_read) ) {
            $lines[] = fgetcsv($file_to_read, 1000, ',');

        }

        fclose($file_to_read);
        return $lines;
    }
}
