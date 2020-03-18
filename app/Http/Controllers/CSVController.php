<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Support\Facades\DB;
    use App\Train;
    use Illuminate\Http\Request;
    use Laravel\Lumen\Routing\Controller as BaseController;
    
    class CSVController extends BaseController
    {
        //Make sure there's only a .csv file sent, validate it
        /**
         * Process the upload
         *
         * @param Request $request
         *
         * @return Response
         */
        public function uploadCSV(Request $request)
        {
            
            try {
                $data_rows = []; //Actual data from CVS
                
                //Set up validator
                $validator = \Validator::make($request->all(), [
                    // Do not allow any shady characters
                    'csv_upload' => 'required|file|mimetypes:text/csv,text/plain',
                ]);
                if ($validator->fails()) {
                    return view('uploader', ['header' => '', 'data' => '', 'errors' => $validator->errors()]);
                }
                
                //Check if file exists and then grab file data
                if ($request->hasFile('csv_upload') && $request->file('csv_upload')->isValid()) {
                    $csv_input = $request->file('csv_upload');
                } else {
                    return view('uploader', ['header' => '', 'data' => '', 'errors' => 'Please reupload file again']);
                }
                
                //Assume line one is table header, iterate and add to arrays
                $row = 1;
                if (($handle = fopen($csv_input, "r")) !== false) {
                    while (($csv_data = fgetcsv($handle, 5000, ",")) !== false) {
                        
                        $num = count($csv_data);
                        //Probably a more elegant way of doing this, getting header under assumption that there's always going to be one.
                        if ($row > 1) { //Skip the header
                            //Push into DB
                            $this->createUpdateTrains($csv_data);
                        }
                        
                        $row++;
                    }
                    fclose($handle);
                }
                
                //Get updated rows to display
                $trains = Train::all()->toArray();
                
            } catch (\Exception $e) {
                return $e;
            }
            
            return view('uploader', ['data' => $trains, 'errors' => '']);
        }
        
        /**
         * Add or Update entries based on Run Number
         *
         * @param mixed $csvItem
         *
         * @return mixed
         */
        public function createUpdateTrains($csvItem)
        {
            //TODO: Check if row is completely empty
            try {
                if ($csvItem !== null) {
                    
                    //Add or update new rows. First arg = key, Second = values to update + insert
                    $newTrain = DB::table('trains')->updateOrInsert(
                        [
                            'run_number' => $csvItem[2],
                            'train_line' => $csvItem[0]
                        ],
                        [
                            'train_line'  => $csvItem[0],
                            'route_name'  => $csvItem[1],
                            'run_number'  => $csvItem[2],
                            'operator_id' => $csvItem[3]
                        ]
                    );
                    
                }
            } catch (\Exception $e) {
                return false;
            }
            
            return true;
        }
        
        /**
         * Remove train
         *
         * @param Request $request
         *
         * @return mixed
         */
        public function deleteTrains(Request $request)
        {
            
            try {
            
            } catch (\Exception $e) {
            
            }
            
            return true;
        }
        
        /**
         * List trains
         *
         * @return mixed
         */
        public function allTrains()
        {
            $trains = [];
            
            try {
                $trains = Train::all()->toArray();
            } catch (\Exception $e) {
            }
            
            return view('uploader', ['data' => $trains, 'errors' => '']);
        }
        
        private function sanitizeUpload($csv)
        {
            try {
            
            } catch (Exception $e) {
            
            }
            
            return true;
        }
    }
