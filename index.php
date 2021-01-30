<?php
    // include 'cache/top-cache.php';
    session_start();
    include 'main/connectAPI.php';
    if (isset($_SESSION['id'])) {
        $session_login_id = $_SESSION['id'];
        $session_login_email = $_SESSION['email'];
        $session_login_status = $_SESSION['status'];
        $session_login_username = $_SESSION['username'];
    }

    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 20;
    $skip = ($page - 1) * $limit;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $url = 'menu-detail/ingre-name?username=cheasel&api_key=fe1913c8bddda7fbf1b050c92949ef887c97369bb965bc866bcbc9c15d65154e&name='.urlencode($search).'&skip='.$skip.'&limit='.$limit;
    $resultmenu = getAPI($url);
   

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="th" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo-icon-api.png">

    <title>Sharing Thai Food</title>

    <!-- Bootstrap core CSS -->
    <link href="mainstyle/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="mainstyle/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="mainstyle/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
        type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/landing-page.min.css" rel="stylesheet">
    <link href="css/all.min.css" rel="stylesheet">

    <link href="css/show-food.css" rel="stylesheet">
    <style>
        body {
         
            background-image: url(img/bg/flat-lay-2583213.jpg);
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <?php include("function/navigation.php"); ?>

    <!-- Masthead -->


    <div class='search-container'>
        <form action="/projectapi/index.php">
            <div class='search'>
                <i class="fa fa-search"></i>
                <input type="text" placeholder="ค้นหาจากชื่อเมนู, วัตถุดิบ" name="search">
                <input type="submit" value="ค้นหา" name="sumbmit">
            </div>
        </form>
    </div>

    <section class="container ">
        <div class='show-menu-title '>
            <center>
                <?php
                if( $search != "" ){
                    echo '<h4> ค้นหา เมนู'. $search .'</h4>';
                }else{
                    echo '<h4> เมนูอาหารทั้งหมด </h4>';
                }
            ?>
            </center>
        </div>
        <div class="show-menu">
            <?php
                foreach ( json_decode($resultmenu,true) as $rowmenu){
            ?>
              <a href=" <?php echo '/projectapi/show-food.php?id='. (int)$rowmenu['_id'];?>">
                  <div id="wb_element_instance2" class="wb_element hvr-grow menu-box mb-4">
                      <center>
                          <img class="card-img-left rounded-circle mt-3" src="<?php echo $rowmenu["image"]; ?>" width="250"
                              height="250" alt="Card image cap">
                      </center>
                      <div class='menu-name'>
                          <h5 class="card-title name-title text-center">
                              <?php echo $rowmenu["title"]; ?></a>
                          </h5>
                          <!-- <p class="card-text detail-description">
                              <?php 
                                          if( isset($rowmenu["description"]) ){
                                              echo $rowmenu["description"];
                                          }else{
                                              echo '';
                                          }
                                      ?>
                          </p> -->
                      </div>
                  </div>
              </a>
            <?php
                }; 
            ?>
        </div>
    </section>

    <?php include('function/pagination.php'); ?>


    <!-- BMR Calculator , Congenital disease , Food allergies -->
    <?php #include("function/another-function.php"); ?>

    <!-- Call to Action -->
    <!--<section class="call-to-action text-white text-center" style="background-image: url('http://www.healthyhome.asia/wp-content/uploads/2017/11/1-2-2.jpg') ;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h2 class="mb-4">Find your favorite food</h2>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form action="#">
                        <div class="form-row input-group">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <input type="text" name="search" class="form-control form-control-lg" placeholder="Searching for...">
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-block btn-lg btn-primary">Searching!</button>
                                <a href='#top' id="">Go Top</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>-->

    <!-- Footer -->
    <?php include("function/footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="mainstyle/jquery/jquery.min.js"></script>
    <script src="mainstyle/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        // On top
        $("a[href='#top']").click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });
    </script>


</body>

</html>