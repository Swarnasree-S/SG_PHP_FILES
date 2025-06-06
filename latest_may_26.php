<?php
set_time_limit(120);
// testing
// Source folder
$sourceFolder = '/home/sftpgo/data/data/Wattmon';

// Destination folder
$destinationFolder = '/home/thiru/fileflow/csv';

// Temporary folder
$tempFolder = '/home/thiru/csv-to-influx-wattmon-vilva-fruits/csv-source';

// Create date-wise folder
$dateFolder = date('Y-m-d');
$dateFolderPath = $destinationFolder . '/' . $dateFolder;

if (!file_exists($dateFolderPath)) {
    mkdir($dateFolderPath, 0777, true);
}

// Function to extract pattern from filename
function extractPattern($filename) {
    // Assuming the pattern is the part before the first underscore
    $pattern = strtok($filename, '_');
    return $pattern;
}

function uploadCsvFile($url, $filePath, $pattern, $filename) {
    // Check if the file exists
    if (!file_exists($filePath)) {
        return "Error: File does not exist.";
    }

    // Calculate the MD5 checksum of the file
    $fileContents = file_get_contents($filePath);
    if ($fileContents === false) {
        return "Error: Unable to read file contents.";
    }


    // Prepare the CURL request
    $curl = curl_init();

    // Attach the CSV file and MD5 checksum as multipart/form-data
    //$file = new CURLFile($filePath, 'text/csv', basename($filePath));
            /*CURLFile Object
            (
                [name] => csv/2025-01-25/9C956E78E3B2/9C956E78E3B2_20250125_01737782941.csv
                [mime] => text/csv
                [postname] => 9C956E78E3B2_20250125_01737782941.csv
            )*/
    $postFields = [
        'data' => $fileContents,
        'meta' => "datasourceid=".$pattern.";filename=".$filename
    ];

    // Set CURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_RETURNTRANSFER => true, // Get the response as a string
    ]);

    // Execute the request
    $response = curl_exec($curl);

    // Check for CURL errors
    if (curl_errno($curl)) {
        $error = curl_error($curl);
        curl_close($curl);
        return "CURL Error: " . $error;
    }

    // Close CURL session
    curl_close($curl);

    return $response;
}

// Function to move files recursively
function moveFiles($sourceFolder, $destinationFolder, $tempFolder) {
    $files = glob($sourceFolder . '/*');

    foreach ($files as $file) {
        if (is_dir($file)) {
            // Recursively move files inside subfolders
            moveFiles($file, $destinationFolder, $tempFolder);
        } else {
            // Move file to destination folder
            $filename = basename($file);
            $pattern = extractPattern($filename);
            $patternFolderPath = $destinationFolder . '/' . $pattern;

            if (!file_exists($patternFolderPath)) {
                mkdir($patternFolderPath, 0777, true);
            }

            $newFilePath = $patternFolderPath . '/' . $filename;
            rename($file, $newFilePath);

            if($pattern == "9C956E78E3E0" || $pattern == "9C956E78E40D" || $pattern == "9C956E78E379" || $pattern == "74D5C6CF2DEA" || $pattern == "74D5C6CF2D7D"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-best-green/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);                
            }elseif($pattern == "D8478F42B1FB"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);                
            }elseif($pattern == "D8458F42BB20"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42BA80" || $pattern == "D8478F42BB82"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-aalayam-wind-farm/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E5327B0"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-vilva-fruits/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            //}elseif($pattern == "D8478F42BB20" || $pattern == "44B7D09EA734" || $pattern == "44B7D09E72C3" || $pattern == "44B7D09EA6E1" || $pattern == "44B7D09EA720" || $pattern == "74D5C623B908" || $pattern == "44B7D09EA711" || $pattern == "44B7D09E98D2"){
            }elseif($pattern == "D8478F42BB20" || $pattern == "44B7D09EA734" || $pattern == "44B7D09E72C3"|| $pattern == "44B7D09EA720" || $pattern == "74D5C623B908" || $pattern == "44B7D09EA711" || $pattern == "44B7D09E98D2" || $pattern == "44B7D09EA6E1" || $pattern == "44B7D09EA7A6"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-nirt/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E532793"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-sol-swift-solutions/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42B223"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-prosun/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "608A108DC956"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-tiger-power/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42B6F0"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-indway/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F42BB21"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-vivin-tex-pv-dg/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "D8478F40E729"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-indway-prime-energy/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "74D5C604DBB7" || $pattern == "9C956E78E401" || $pattern == "9C956E78E3B2" || $pattern == "D8478F42B5F0" || $pattern == "9C956E78E3C5" || $pattern == "9C956E78E3F4" 
            || $pattern == "74D5C604DBBC"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-sunderapandian-park/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }/*elseif($pattern == "D8478F42BB74"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-heyday-ventures/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
		}*/elseif($pattern == "9C956E78E445" || $pattern == "9C956E78E3ED" || $pattern == "9C956E78E3F2" || $pattern == "44B7D09EA6F6" || $pattern == "44B7D09E72BA"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-saran-solar/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E5327F1" || $pattern == "44B7D09EA78F" || $pattern == "44B7D09EA695" || $pattern == "44B7D09EA6C1" || $pattern == "44B7D09EA7C4" || $pattern == "44B7D09EA7A8"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-olitec/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
	    }elseif($pattern == "9C956E78E3EB" || $pattern == "9C956E78E40E" || $pattern == "9C956E78E3E1" || $pattern == "74D5C6CF2D5E" || $pattern == "74D5C6CF2DF1" || $pattern == "74D5C6CF2DF5" || $pattern == "74D5C6CF3F1F" || $pattern == "74D5C6CF3F44" || $pattern == "44B7D09EA71D" || $pattern == "44B7D09E72C2" || $pattern == "44B7D09EA702"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-Renfra/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "9C956E78E40C"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-ahil-green-energy/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E97D2"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-jsw-steel/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E9827"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-chennai-plastic/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E9837"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-eveready-cotton/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E98DB"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-shree-sai-hanuman-smelters/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
                //send file every 15 minutes once to ventus cloud
                if (date('i') % 15 == 0) {
                    $url = "https://positive-apex-448606-f7.ey.r.appspot.com/api/send";
                    $response = uploadCsvFile($url, $newFilePath, $pattern, $filename);
                }
            }elseif($pattern == "44B7D09EA715"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon-foxcon/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E72BC" || $pattern == "44B7D09EA78B" || $pattern == "44B7D09EA75E" || $pattern == "44B7D09EA77D" || $pattern == "44B7D09E993F" || $pattern == "44B7D09EA742"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-Aadil-Solar-Energy/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E981D"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-M2V-Growenergy/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09EA771" || $pattern == "44B7D09EA7AE"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-jayaram-industries/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E990E"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-jain-sun-solar/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            //}elseif($pattern == "44B7D09E72C2"){
                //$tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-rg-demo/csv-source";
                //copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09E97ED" || $pattern == "74D5C6CF2DDB" || $pattern == "44B7D09EA718" || $pattern == "74D5C6CF2DCF"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-sivaswamy-school/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09EA6C5" || $pattern == "44B7D09EA7B3"){
                $tempFolder = "/home/thiru/csv-to-influx-wattmon/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09EA6CD"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-jharka/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "74D5C6CF2DEF" || $pattern == "74D5C6CF3F2C" || $pattern == "74D5C6CF2D8B" || $pattern == "74D5C6CF2D85"|| $pattern == "44B7D09EA7B8" || $pattern == "74D5C6CF2DF6" || $pattern == "74D5C6CF2DC2" || $pattern == "D8478F42BB74"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-aim-electricals/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            } elseif($pattern == "44B7D09EA70F"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-eternal_renewables/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }elseif($pattern == "44B7D09EA6D0"){
                $tempFolder = "/home/grafanauser/apps/csv-to-influx-wattmon-marg/csv-source";
                copy($newFilePath, $tempFolder . '/' . $filename);
            }


        }
    }
}          

// Move files recursively from source to destination folder
moveFiles($sourceFolder, $dateFolderPath, $tempFolder);

echo "Files moved successfully.";

?>

