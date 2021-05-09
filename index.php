<?php
    include 'db.php'; 
    include 'function.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <p class="mb-0">Little Bitty URL Shortener</p>
        </div>
    </nav>
    <!-- Form -->
    <form method="post" action="index.php"> 
        <div class="input-group-lg center-content">
            <h2 class="text-center"> Little Bitty URL Shortener </h2>
            <input type="text" class="form-control" name="long_url" aria-describedby="inputGroup-sizing-lg" placeholder="Enter the URL">
        </div>
        <center>
            <input type="submit" class="btn btn-primary btn-align" name="submit" value="Let's shorten it!" >
        </center>
    </form>
    <footer>
        <p> This is a mini project done by Akshara A with respect to her Technology Management internship at NAF. </p>
    </footer>
    
    <!-- To avoid resubmission on reload -->
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
    }
    </script>
</body>
</html>

<?php
    if(isset($_POST["submit"])) 
    {
        // To check whether the link user input has already exist or not
        $long_url = $_POST["long_url"];
        $url_id = generateRandomString();
        $short_url = $base_url . "/" . $url_id;
        $query = mysqli_query($db, "INSERT short_url (id, long_url, shorten_url) VALUES ('$url_id','$long_url','$short_url')");
        if($query)
            echo "<center>Your shortened URL is: <a href=" .$short_url. ">" .$short_url. "</a></center>";
        else
            echo "There is some problem";
    }

    if(isset($_GET['redirect']) || !empty($_GET['redirect']))
    {
        $url_id = $_GET['redirect']; 
        $sql = "SELECT long_url FROM short_url WHERE id = '$url_id'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        if(mysqli_num_rows($result) == 1)
        {
            $redirect_to_long_url = $row['long_url'];
            header('Location:' .$redirect_to_long_url);
        }
        else
        {
            header('Location: index.php');
        }
}
?>
