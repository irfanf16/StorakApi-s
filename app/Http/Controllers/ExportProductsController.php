<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsController extends Controller
{
    public function exportProductsFacebook(Request $request){
        $request['data_type']='facebook';
        return Excel::download(new ProductExport($request),'all_google_products.csv' );
    }

    public function exportProductsGoogle(Request $request){
        $request['data_type']='google';
        return Excel::download(new ProductExport($request),'all_google_products.xlsx' );
    }
}
