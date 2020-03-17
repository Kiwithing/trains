<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Laravel\Lumen\Routing\Controller as BaseController;
    
    class CSVController extends BaseController
    {
        //Make sure there's only a .csv file sent, validate it
        /**
         * Process the upload
         *
         * @param int $id
         *
         * @return Response
         */
        public function uploadCSV(Request $request)
        {
            
            try {
                $data_rows  = []; //Actual data from CVS
                $header_row = []; //Header data
                
                //Let's validate right quick
                /*$validation = $this->validate($request, [
                    'csv_upload' => 'required|mimes:csv'
                ]);
        
                //Check validation
                if ($validation->fails()) {
                    //
                    echo "Failed"; //Throw exception
                }*/
                
                //Check if file exists and then grab file data
                if ($request->hasFile('csv_upload')) {
                    $csv_input = $request->file('csv_upload');
                } else {
                    //Throw error
                }
                
                //Assume line one is table header, iterate and add to arrays
                $row = 1;
                if (($handle = fopen($csv_input, "r")) !== false) {
                    while (($data = fgetcsv($handle, 5000, ",")) !== false) {
                        
                        $num = count($data);
                        $new_row = [];
                        //Probably a more elegant way of doing this, getting header under assumption that there's always going to be one.
                        if ($row === 1) {
                            for ($c = 0; $c < $num; $c++) {
                                //echo $data[$c] . "<br />\n";
                                $header_row[] = $data[$c];
                            }
                        } else {
                            
                            for ($c = 0; $c < $num; $c++) {
                                //Turn row into array
                                array_push($new_row, $data[$c]);
                            }
                            
                            array_push($data_rows);
                        }
                        
                        $row++;
                    }
                    fclose($handle);
                }
                
            } catch (\Exception $e) {
            
            }
            
            return view('uploader', ['version' => '100', 'header' => $header_row ,'data' => $data_rows]);
        }
        

        private function sanitizeUpload($csv)
        {
            try {
            
            } catch (Exception $e) {
            
            }
            
            return true;
        }
        
        /**
         * Update the DB
         *
         * @param int $id
         *
         * @return Response
         */
        private function updateDatabase($csvItem)
        {
            return true;
        }
        
        
    }
