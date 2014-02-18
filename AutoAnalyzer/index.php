<?php

libxml_use_internal_errors(true) ;

require_once 'classes.php';

// If we are processing an AJAX post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Create a new analysis with the POST'd segmentation
    $analysis = new Analysis($_POST['segmentation']);
    // Update the "and over" segment
    YearAnalysis::$AND_OVER = $_POST['andOver'];
    
    $url = $_POST['url'];
    // Download the HTML of this page from the website
    $html = file_get_contents($url);
    // Create a new DOM document
    $doc = new DOMDocument();
    // And load the downloaded HTML into this document
    $doc->loadHTML($html);
    // And also create a new XPath query engine
    $xpath = new DOMXPath($doc);
    
    // The XPath query to retrieve each non-featured listing on the page
    $getEachListing = "descendant-or-self::div[contains(concat(' ', normalize-space(@class), ' '), ' at_result ')][not(contains(concat(' ', normalize-space(@class), ' '), ' at_priorityResult '))]";
    // Execute the query
    $rows = $xpath->query($getEachListing);
    
    // Loop through each listing
    foreach ($rows as $listing) {        
        // Extract the title of the listing (where the year is at)
        $getTileQuery = "normalize-space(descendant-or-self::span[contains(concat(' ', normalize-space(@class), ' '), ' resultTitle ')]/text())";
        $titleSpan = $xpath->evaluate($getTileQuery, $listing);
        // Use a regular expression to extract the year
        if (preg_match('/.*([12][09][019][0-9]).*/X', $titleSpan, $year_matches)) {
                $year = $year_matches[1];
        }
        
        // Extract the price of the listing
        $getPriceQuery = "normalize-space(descendant-or-self::div[contains(concat(' ', normalize-space(@class), ' '), ' at_price ')]/text())";
        $priceDiv = $xpath->evaluate($getPriceQuery, $listing);
        // Use a regular expression to filter out the dollar sign and commas
        $price = preg_replace('/[ \$,]/', '', $priceDiv);
        
        // Extract the number of KMs on the car
        $getKmsQuery = "normalize-space(descendant-or-self::div[contains(concat(' ', normalize-space(@class), ' '), ' at_km ')]/text())";
        $kmsDiv = $xpath->evaluate($getKmsQuery, $listing);
        // Use a regular expression to filter out the letters km and the comma
        $kms = preg_replace('/[ km,]/', '', $kmsDiv);
        
        // Add the listing to the current analysis object
        $analysis->newListing(new Listing($year, $kms, $price));
    }

// Output the analysis
?>
<h1>Analysis: <?php echo $_POST['name']; ?></h1>
<p>Segmentation of <?php echo $_POST['segmentation']; ?>kms</p>
<table>
    <thead>
        <th></th>
        <th>Year Average</th>
        <?php
        $i = 0;
        while ($i < $_POST['andOver']) {
            $next = $i + $_POST['segmentation'];
            echo "<th> " .$i . " to " . ($next - 1) . "</th>";
            $i = $next;
        }
        echo "<th>$i and Over</th>";
        ?>
    </thead>
    <tbody>
        <?php
        foreach ($analysis->getYears() as $year => $yearsAnalysis) {
            echo "<tr>";
            echo "<td><strong>$year</strong></td>";
            echo "<td>";
            echo "<strong>Number</strong>: {$yearsAnalysis->getNumber()}<br/>";
            echo "<strong>Average</strong>: {$yearsAnalysis->getAverage()}<br/>";
            echo "<strong>Max</strong>: {$yearsAnalysis->getMax()}<br/>";
            echo "<strong>Min</strong>: {$yearsAnalysis->getMin()}<br/>";
            echo "</td>";
            foreach ($yearsAnalysis->getSegments() as $segment) {
                echo "<td>";
                echo "<strong>Number</strong>: {$segment->getNumber()}<br/>";
                echo "<strong>Average</strong>: {$segment->getAverage()}<br/>";
                echo "<strong>Max</strong>: {$segment->getMax()}<br/>";
                echo "<strong>Min</strong>: {$segment->getMin()}<br/>";
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<hr/>
<?php

    
}
else {
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <title>Automobile Pricing</title>
        <style>
            table { border: 1px solid #333; }
            td {border: 1px solid #aaa; padding: 5px; }
        </style>
    </head>
    <body>
        <form id="frmAnalysis" method="post" action="index.php">
            <label for="name">Analysis name</label><input value="Car name" type="text" name="name"/><br/>
            <label for="url">URL from autotrader.ca</label><input type="text" name="url"/><br/>
            <label for="segmentation">KM Segmentation</label>
            <select name="segmentation">
                <option value="10000">10,000km</option>
                <option value="15000" selected>15,000km</option>
                <option value="20000">20,000km</option>
            </select><br/>
            <label for="andOver">The "And Over" segment</label>
            <select name="andOver">
                <option value="60000">60,000km</option>
                <option value="120000">120,000km</option>
            </select><br/>
            <input type="submit"/>
        </form>
        <hr/>
        <div id="analysisTable"></div>
        <script>
            $("#frmAnalysis").submit(function(e) {
                e.preventDefault();
                $.post("index.php", $(this).serialize(), function(response) {
                    $("#analysisTable").append(response);
                });
            });
        </script>
    </body>
</html>
<?php
}
?>