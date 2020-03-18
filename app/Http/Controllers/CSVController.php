<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Support\Facades\DB;
    use App\Train;
    use Illuminate\Http\Request;
    use Laravel\Lumen\Routing\Controller as BaseController;
    
    class CSVController extends BaseController
    {
        //Make sure there's only a .csv file sent, validate it
        
        public function index() {
            $trains = $this->allTrains();
            return view('uploader', ['data' => $trains, 'errors' => '']);
        }
        
        
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
                    //Should actually throw and exception here, but not sure how to pass validator errors to catch
                    $trains = $this->allTrains();
                    return view('uploader', ['data' => $trains, 'errors' => $validator->errors()]);
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
                    while (($csv_data = fgetcsv($handle, 10000, ",")) !== false) {
                        
                        $num = count($csv_data);
                        
                        //Skip the header, skip empty rows
                        if ($row > 1 && $this->rowCheck($csv_data) === false) {
                            //Push into DB
                            $this->createUpdateTrains($csv_data);
                        }
                        
                        $row++;
                    }
                    fclose($handle);
                }
                
                //Get updated rows to display
                $trains = $this->allTrains();
                
            } catch (\Exception $e) {
                //Display trains, sure there's a better way
                $trains = $this->allTrains();
                return view('uploader', ['data' => $trains, 'errors' => $e]);
            }
            
            //If all is well
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
                $trains = Train::orderBy('run_number', 'asc')->get()->toArray();
            } catch (\Exception $e) {
                return $e;
            }
            
            return $trains;
        }
        
        /**
         * Check for empty row
         *
         * @return bool
         */
        private function rowCheck($csvItem)
        {
            //Compare number of blank fields to check if all fields are blank
            $isEmpty = false;
            $emptyCount = 0;
            $fieldCount = count($csvItem);
            
            //Check if value is values are empty, if so hit the flag value
            foreach($csvItem as $key=>$value) {
                if(empty($value) || !isset($value) || $value === ' ') {
                    $emptyCount++;
                }
            }
            
            //If all are empty, flag it
            if($emptyCount === $fieldCount) {
                $isEmpty = true;
            }
            
            return $isEmpty;
        }
        
        
    }
