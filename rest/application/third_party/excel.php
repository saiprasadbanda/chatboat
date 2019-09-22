<?php 
/*
|--------------------------------------------------------------------------
| Excel To Array
|--------------------------------------------------------------------------
| Helper function to convert excel sheet to key value array
| Input: path to excel file, set wether excel first row are headers
| Dependencies: PHPExcel.php include needed
*/
include 'PHPExcel.php';

function excelHeaders($filePath, $header=true){
    //Create excel reader after determining the file type
    $inputFileName = $filePath;
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /** Set read type to read cell data onl **/
    $objReader->setReadDataOnly(true);
    $worksheetList = $objReader->listWorksheetNames($inputFileName);

       //echo '<pre>';print_r($worksheetList);exit;
    $defaultSheetIndex = 0;
    for($a=0;$a<count($worksheetList);$a++){
        if(strtolower($worksheetList[$a]) == 'sum ratios'){
            $defaultSheetIndex = $a;
        }
    }

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    $objPHPExcel->setActiveSheetIndex($defaultSheetIndex);

    //Get worksheet and built array with first row as header
    $objWorksheet = $objPHPExcel->getActiveSheet();

    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
    $headingsArray = $headingsArray[1];

    return $headingsArray;
}

function excelHeadersBySheetName1($sheetName ,$filePath, $header=true){
    //Create excel reader after determining the file type
    $inputFileName = $filePath;
    //createReader
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setLoadSheetsOnly('Sum');
    /** Set read type to read cell data onl **/
    /*$objReader->setReadDataOnly(true);*/
    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    /*echo '<pre>';var_dump($objReader->setLoadSheetsOnly('Sum Ratios'));exit;*/
    //Get worksheet and built array with first row as header
    $objWorksheet = $objPHPExcel->getActiveSheet();
  /*  echo '<pre>';print_r($objWorksheet);exit;*/
    /*$objWorksheet = $objPHPExcel->getActiveSheet();*/


    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();
    $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
    $headingsArray = $headingsArray[1];

    return $headingsArray;
}

function excelHeadersBySheetName($sheetName ,$filePath, $header=true){
    /*$inputFileType = 'Excel2007';*/
    $inputFileName = 'C:\Users\threshold\Desktop\AccessBank\Access Bank-financials\test.xlsx';

    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);

    /**  Create a new Reader of the type defined in $inputFileType  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /**  Read the list of worksheet names and select the one that we want to load  **/
    $worksheetList = $objReader->listWorksheetNames($inputFileName);
    /*echo '<pre>';print_r($worksheetList);exit;*/

    $sheetname = $worksheetList[5];
    /*print_r($sheetname);exit;*/

    /**  Advise the Reader of which WorkSheets we want to load  **/
    $objReader->setLoadSheetsOnly('Balance Sheet');
    //$objReader->getActiveSheet($sheetname);
    $objPHPExcel = $objReader->load($inputFileName);
    $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
   // echo '<pre>';print_r($objPHPExcel);exit;
}


function excelToArray($filePath, $header=true){
        //Create excel reader after determining the file type
        $inputFileName = $filePath;
        /**  Identify the type of $inputFileName  **/
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        /**  Create a new Reader of the type that has been identified  **/
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        /** Set read type to read cell data onl **/
        $objReader->setReadDataOnly(true);
        /**  Load $inputFileName to a PHPExcel Object  **/
        $objPHPExcel = $objReader->load($inputFileName);
        /**************************************************/

        $worksheetList = $objReader->listWorksheetNames($inputFileName);
        $defaultSheetIndex = 0;
        for($a=0;$a<count($worksheetList);$a++){
            if(strtolower($worksheetList[$a]) == 'sum ratios'){
                $defaultSheetIndex = $a;
            }
        }
        $objPHPExcel->setActiveSheetIndex($defaultSheetIndex);

        /**************************************************/

        //Get worksheet and built array with first row as header
        $objWorksheet = $objPHPExcel->getActiveSheet();

        //excel with first row header, use header as key
        if($header){
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();
            $highestColumn = 'E';
            $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
            $headingsArray = $headingsArray[1];


            /*$bar = $objPHPExcel->getActiveSheet()->getCell('A4')->getValue();
            echo '<pre>';print_r($bar);exit;*/

            $r = 0;
            $namedDataArray = array();
            for ($row = 3; $row <= $highestRow; ++$row) {
                   /* foreach($headingsArray as $columnKey => $columnHeading) {
                        echo '<br>';
                       // echo $columnKey.$row;
                        echo $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getValue();
                       //$namedDataArray[$r][$row] = $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getFormattedValue();

                    }*/

                $namedDataArray[$row]['is_formulae'] = 1;
                foreach($headingsArray as $columnKey=>$abc) {
                    $namedDataArray[$row][$columnKey.$row]['val'] = $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getValue();
                    $namedDataArray[$row][$columnKey.$row]['calVal'] = $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getFormattedValue();
                   // $namedDataArray[$row][$columnKey.$row]['calVal'] = $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getCalculatedValue();
                    if($namedDataArray[$row][$columnKey.$row]['val'] == $namedDataArray[$row][$columnKey.$row]['calVal'])
                    { }
                    else {
                        $namedDataArray[$row]['is_formulae'] = 0;
                    }
                    $namedDataArray[$row][$columnKey.$row] = $objPHPExcel->getActiveSheet()->getCell($columnKey.$row)->getCalculatedValue();
                    //$r++;
                }
                $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);

                /*if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    foreach($headingsArray as $columnKey => $columnHeading) {
                        $namedDataArray[$r][$columnKey] = $dataRow[$row][$columnKey];
                    }
                }*/
            }
            //echo '<pre>';print_r($namedDataArray);exit;
        }
        else{
            //excel sheet with no header
            $namedDataArray = $objWorksheet->toArray(null,true,true,true);
        }

        return $namedDataArray;
}
function excelToArrayOrg($filePath, $header=true){
    //Create excel reader after determining the file type
    $inputFileName = $filePath;
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /** Set read type to read cell data onl **/
    $objReader->setReadDataOnly(true);
    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    //Get worksheet and built array with first row as header
    $objWorksheet = $objPHPExcel->getActiveSheet();

    //excel with first row header, use header as key
    if($header){
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
        $headingsArray = $headingsArray[1];

        $r = -1;
        $namedDataArray = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                }
            }
        }
    }
    else{
        //excel sheet with no header
        $namedDataArray = $objWorksheet->toArray(null,true,true,true);
    }

    return $namedDataArray;
}
function getSheetByName($sheetName,$filePath, $header=true){
    //Create excel reader after determining the file type
    $inputFileName = $filePath;
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);

    $objReader->setLoadSheetsOnly($sheetName);
    /** Set read type to read cell data onl **/
    $objReader->setReadDataOnly(true);
    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    //Get worksheet and built array with first row as header
    $objWorksheet = $objPHPExcel->getActiveSheet();

    //excel with first row header, use header as key
    if($header){
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
        $headingsArray = $headingsArray[1];

        $r = -1;
        $namedDataArray = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                }
            }
        }
    }
    else{
        //excel sheet with no header
        $namedDataArray = $objWorksheet->toArray(null,true,true,true);
    }

    return $namedDataArray;
}

?>