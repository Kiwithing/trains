<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class CSVController extends BaseController
{
    //Make sure there's only a .csv file sent, validate it
    private function sanitizeUpload($csv) {
        try {
        
        } catch (Exception $e) {
        
        }
        
        return true;
    }
    
    public function uploadCSV(Request $request) {
        print_r($request);
        $csv_input = $request->query('csv_upload');
    
        try {
        
        } catch (Exception $e) {
        
        }
        
        return $csv_input;
    }
    
    
}
