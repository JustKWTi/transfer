<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Transfer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        #fileInput {
            margin-bottom: 20px;
        }
        #downloadLink {
            display: none;
        }
    </style>
</head>
<body>
    <h1>File Transfer</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . time() . '_' . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "<a id='downloadLink' href='$uploadFile' download>Download File</a>";
        } else {
            echo "File upload failed!";
        }
    }
    ?>

    <form id="uploadForm" action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" id="fileInput" name="file">
        <button type="submit">Upload File</button>
    </form>

    <script>
        const downloadLink = document.getElementById('downloadLink');
        if (downloadLink) {
            downloadLink.style.display = 'block';
        }
    </script>
</body>
</html>
