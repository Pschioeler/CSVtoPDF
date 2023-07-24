<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test opgave</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>TEST OPGAVE</h1>


    <h2>PHP file upload safely</h2>
    <!--Enctype = multipart/formdata, allows multiple file oploads-->
    <form action="process-form.php" method="post" enctype="multipart/form-data">

    <div class="fileselecter">
        <input class="btn-choosefile" type="file" name="files" id="files"/>
        <br>
        <button class="btn-upload"type="submit"></button>
    </div>

    </form>

</body>
</html>