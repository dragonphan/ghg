<!-- <?php include 'includes/header.php';?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- External Resources -->
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/resident-favicon.png">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- D3.js Library -->
    <script src="https://d3js.org/d3.v4.js"></script>
    <!-- jQuery Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Bonds</title>
</head>
<body>
     
    <!-- Main Content Container -->
    <div class="container main_content_container">
        <div class="row">
            <!-- 404 Error Message Container -->
            <div class="col mycontainer m-auto d-flex align-items-center flex-column justify-content-center">
                <!-- Logo -->
                <img src="assets/images/resident.png" alt="Bonds" width="250">
                
                <!-- Error Messages -->
                <h1 class="text-center display-1 fw-bold">404</h1>
                <h1 class="text-center">Oops! The page you are looking for does not exist !</h1>
                <p>You typed the wrong address or the page has been deleted</p>
                
                <!-- Return Button -->
                <!-- TODO: check type of session, then redirect them to admin or resident dashboard -->
                <a href="login.php" class="btn btn_mygreen">
                    <i class="bi bi-house fs-5 me-2"></i>Return to Main Page
                </a>
            </div>
        </div>  <!-- END Row -->
    </div>    <!-- END Outermost Container -->

    <!-- External JavaScript Resources -->
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Fontawesome Icons -->
    <script src="https://kit.fontawesome.com/db51efbc0b.js" crossorigin="anonymous"></script>
    <!-- Custom JavaScript -->
    <script src="assets/js/script.js"></script>
</body>
</html>
<!-- Remove duplicate closing html tag -->

<!-- Footer include commented out for now -->
<!-- <?php include 'includes/footer.php';?> -->
