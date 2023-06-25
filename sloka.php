<style>
    body {
        white-space: pre-wrap;
    }
</style>
<body>
<?php
error_reporting(0);
$kanda = $_GET["kanda"];
$sarga = $_GET["sarga"];
$slokaNumber = $_GET["sloka"];

$csvFile = fopen('test/slokas.csv', 'r');
// Find the requested sloka
$requestedSloka = null;
while (($row = fgetcsv($csvFile)) !== false) {
    if ($row[2] === $kanda.".".$sarga.".".$slokaNumber) {
        $requestedSloka = $row;
        break;
    }
}

// Close the CSV file
fclose($csvFile);

// Display the requested sloka
if ($requestedSloka !== null) {
    echo "Verified: " . $requestedSloka[0] . "<br>";
    echo "Verified By: " . $requestedSloka[1] . "<br>";
    echo "ID: " . $requestedSloka[2] . "<br>";
    echo "Script: " . $requestedSloka[3] . "<br>";
    echo "Kanda: " . $requestedSloka[4] . "<br>";
    echo "Sarga: " . $requestedSloka[5] . "<br>";
    echo "Sloka: " . $requestedSloka[6] . "<br>";
    echo "" . $requestedSloka[7] . "<br>";
    echo "" . $requestedSloka[8] . "<br>";
    echo "Meaning: " . $requestedSloka[9] . "<br>";
    echo "Translation: " . $requestedSloka[10] . "<br>";
    echo "Source: <a href='" . $requestedSloka[11] . "'>" . $requestedSloka[11] . "</a> <br><br><br><br>";
} else {
    echo "Sloka not found.";
}
?>
</body>
