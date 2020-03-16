<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
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
    
    private function updateDatabase($csvItem) {
    }
    
    public function uploadCSV(Request $request) {
        
        try {
            print_r($request);
    
            $validation = $this->validate($request, [
                'csv_upload' => 'required|mimes:csv'
            ]);
    
            if ($validation->fails()) {
                //
                echo "Failed"; //Throw exception
            }
            
            $csv_input = $request->query('csv_upload');
        } catch (\Exception $e) {
        
        }
        
        return $csv_input;
    }
    
    
}
