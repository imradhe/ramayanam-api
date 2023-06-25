<?php
error_reporting(0);
mb_internal_encoding("UTF-8");

// HTML content
$sarga = 1;
$sloka = 1;
$slokas = [];

for ($sloka = 1; $sloka <= 10; $sloka++) {
    $url = "https://www.valmiki.iitk.ac.in/content?language=dv&field_kanda_tid=1&field_sarga_value=$sarga&field_sloka_value=$sloka";
    $html = file_get_contents($url);

    // Create a new DOMDocument object and load the HTML
    $dom = new DOMDocument();
    $dom->loadHTML('<?xml encoding="UTF-8">' . $html);

    // Create a new DOMXPath object
    $xpath = new DOMXPath($dom);

    // Select elements with the "field-content" class
    $elements = $xpath->query('//div[contains(@class, "field-content")]');

    // Create an array to store the extracted content
    $content = array();

    // Loop through the selected elements
    foreach ($elements as $element) {
        $content[] = mb_convert_encoding($element->textContent, 'HTML-ENTITIES', 'UTF-8');
    }

    // Create the JSON object
    $text = html_entity_decode($content[0], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $transliteration = html_entity_decode($content[1], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $translation = html_entity_decode($content[2], ENT_QUOTES | ENT_XML1, 'UTF-8');
    $jsonObject = array(
        'script' => 'devanagari',
        'kanda' => 'बालकाण्ड',
        'sarga' => $sarga,
        'sloka' => $sloka,
        'text' => $text,
        'transliteration' => $transliteration,
        'translation' => $translation,
        'source' => $url
    );

    array_push($slokas, $jsonObject);
}

// Convert array to JSON format
$jsonData = json_encode($slokas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// Save JSON data to a file
$file = 'slokas.json';
file_put_contents($file, $jsonData);

echo "JSON data saved to $file.";
?>
