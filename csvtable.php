<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test opgave</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/table.css">
</head>
<body>

     <!--Export to pdf -->
     <div class="button-container">
        <button class="btn-exportpdf" id="browserPrint">Export to pdf</button>
    </div>

    <?php
    //show table in html
    //instead of a direct path i should change it to choose from files in upload folder
    $csvFile = "nytexempel.csv";

    // Check if the file exists and is readable
    if (file_exists($csvFile) && is_readable($csvFile)) {
        // Open the file for reading
        $fileHandle = fopen($csvFile, 'r');

        // Check if the file was successfully opened
        if ($fileHandle !== false) {
            // Start building the table
            echo '<table class="table" id="csvdocument">';

            // Read the header row and create the table header
            $headerRow = fgetcsv($fileHandle);
            echo '<tr>';
            foreach ($headerRow as $header) {
                echo '<th>' . htmlspecialchars($header) . '</th>';
            }
            echo '</tr>';

            // Read the remaining rows and create the table rows
            while (($data = fgetcsv($fileHandle)) !== false) {
                echo '<tr>';
                foreach ($data as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }

            // Close the file
            fclose($fileHandle);

            // Close the table
            echo '</table>';
        } else {
            echo '<p>Error: Unable to open the CSV file.</p>';
        }
    } else {
        echo '<p>Error: CSV file not found or not readable.</p>';
    }
    ?>

<!-- Load Javascript -->
<script src="exportpdf.js"></script>
</body>
</html>