
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Translate</title>
</head>
<body>
    <form id="fileForm" action="script.php" method="post" enctype="multipart/form-data">
        <label for="fileInput">Select a JSON file to upload:</label>
        <input type="file" id="fileInput" name="fileToUpload" accept=".json">
        <br>
        <label for="lang">Select the target language:</label>
        <select id="lang" name="lang">
            <option value="ES">Spanish</option>
            <option value="FR">French</option>
            <option value="DE">German</option>
            <option value="IT">Italian</option>
            <option value="PL">Polish</option>
            <option value="NL">Dutch</option>
        </select>
        <br>
        <input type="submit" value="Upload and Translate">
    </form>
</body>
</html>