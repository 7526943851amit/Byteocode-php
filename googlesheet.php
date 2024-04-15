<?php
// api key => AIzaSyAsVgmCEiuG9uG2JmiH68Yblx-IFhLMW3k
// composer require google/apiclient:"^2.0"


// sheetname- >merchant
// sheetid=>1kQaIdue0srKWBk7P3UFbw38TrmdjQ49vjVdUCJaYgkM
require __DIR__ . '/vendor/autoload.php';

use Google\Client;
use Google\Service\Sheets;
// $apikey=AIzaSyAsVgmCEiuG9uG2JmiH68Yblx-IFhLMW3k

$credentialsPath = 'my-project-22-3-2024-65606caf34c6.json';


$client = new Client();
// echo $client;
// die;
$client->setApplicationName('My Project 22-3-2024');
$client->setScopes([Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig($credentialsPath);
$service = new Sheets($client);

// Spreadsheet ID
$spreadsheetId = 'fghfghg  fg';


$csvFilePath = 'merchant_center_feed/merchant_center_feed.csv';
// print_r($csvFilePath);
// die;
// Read CSV data
$csvData = [];
if (($handle = fopen($csvFilePath, 'r')) !== FALSE) {
    while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
        $csvData[] = $row;
    }
    fclose($handle);
}


$range = 'A1'; 
$body = new Google_Service_Sheets_ValueRange([
    'values' => $csvData
]);
$params = [
    'valueInputOption' => 'RAW'
];


$result = $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
print_r($result);
