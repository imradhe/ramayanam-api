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

$csvFile = fopen('slokas/slokas.csv', 'r');
$slokas = array();

// Find all slokas of the specified sarga
while (($row = fgetcsv($csvFile)) !== false) {
    if ($row[4] === $kanda && $row[5] === $sarga) {
        $slokas[] = $row;
    }
}

// Close the CSV file
fclose($csvFile);

// Display the slokas
if (!empty($slokas)) {
    foreach ($slokas as $sloka) {
        echo "Verified: " . $sloka[0] . "<br>";
        echo "Verified By: " . $sloka[1] . "<br>";
        echo "ID: " . $sloka[2] . "<br>";
        echo "Script: " . $sloka[3] . "<br>";
        echo "Kanda: " . $sloka[4] . "<br>";
        echo "Sarga: " . $sloka[5] . "<br>";
        echo "Sloka: " . $sloka[6] . "<br>";
        echo "" . $sloka[7] . "<br>";
        echo "" . $sloka[8] . "<br>";
        echo "Meaning: " . $sloka[9] . "<br>";
        echo "Translation: " . $sloka[10] . "<br>";
        echo "Source: <a href='" . $sloka[11] . "'>" . $sloka[11] . "</a> <br><br><br><br>";
    }
} else {
    echo "No slokas found for the specified sarga.";
}
?>
</body>
