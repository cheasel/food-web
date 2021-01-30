<?php
  session_start();
  include 'main/connectAPI.php';
  if (isset($_SESSION['id'])) {
    $session_login_id = $_SESSION['id'];
    $session_login_email = $_SESSION['email'];
    $session_login_status = $_SESSION['status'];
    $session_login_username = $_SESSION['username'];
  }

    $url = 'menu-detail/menu-id?username=cheasel&api_key=fe1913c8bddda7fbf1b050c92949ef887c97369bb965bc866bcbc9c15d65154e&id='.$_GET['id'];
    $resultmenu = json_decode(getAPI($url),true);

    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 6;
    $skip = ($page - 1) * $limit;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $url2 = 'menu-detail/ingre-name?username=cheasel&api_key=fe1913c8bddda7fbf1b050c92949ef887c97369bb965bc866bcbc9c15d65154e&name='.urlencode($search).'&skip='.$skip.'&limit='.$limit;
    $resultmenu2 = getAPI($url2);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
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

    <!-- Chart Bar-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


    <!-- Chart Pei -->
    <link href="admin/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- <link href="css/style.css" rel="stylesheet"> -->


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
    <?php #include("function/search.php"); ?>

    <!-- Icons Grid -->
    <form action="show-manu.php" method="get">
        <?php #include("function/region.php"); ?>

    </form>

    <section class="container">
        <div class="row">
            <div class="col-8">
                <div class="card" style="padding-top: 20px; box-shadow: 0 4px 5px rgba(0, 0, 0, 0.6);">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 m">
                                <div class="card" style="box-shadow: 0 4px 5px rgba(0, 0, 0, 0.6);">
                                    <center>
                                        <img class="card-img-left mt-2 mb-2"
                                            style="box-shadow: 0 4px 5px rgba(0, 0, 0, 0.6);"
                                            src="<?php echo $resultmenu[0]['image']; ?>" width="190" height="190"
                                            alt="Card image cap">
                                        <br>
                                        <h5 class="card-title m-b-0 mt-3 align-self-center">คุณค่าอาหาร</h5>
                                    </center>

                                    <div id="visitor" style="height:260px; width:100%;"></div>
                                    <ul class="list-inline m-t-30 ml-4 font-12">
                                        <li><i class="fa fa-circle text-danger"></i> แคลอรี่</li>
                                        <li><i class="fa fa-circle" style="color: #ff5722;"></i> คาร์โบไฮเดรต</li>
                                        <li><i class="fa fa-circle text-warning"></i> คอเลสเตอรอล</li>
                                        <li><i class="fa fa-circle text-success"></i> ไขมัน</li>
                                        <li><i class="fa fa-circle text-primary"></i> โปรตีน</li>
                                    </ul>
                                </div>
                                <!-- <div class="card mt-2" style="box-shadow: 0 4px 5px rgba(0, 0, 0, 0.6);">
                                    <div class="d-flex m-b-30 no-block">
                                        <h5 class="card-title m-b-0 align-self-center">คุณค่าอาหาร</h5>
                                    </div>
                                    <h5 class="card-title m-b-0 align-self-center">คุณค่าอาหาร</h5>
                                    <div id="visitor" style="height:260px; width:100%;"></div>
                                    <ul class="list-inline m-t-30 text-center font-12">
                                        <li><i class="fa fa-circle text-purple"></i> Tablet</li>
                                        <li><i class="fa fa-circle text-success"></i> Desktops</li>
                                        <li><i class="fa fa-circle text-info"></i> Mobile</li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><?php echo $resultmenu[0]['title']; ?></h5>
                                <p class="card-text"><?php 
                                    if( isset($resultmenu[0]["description"]) ){
                                        echo $resultmenu[0]["description"];
                                    }else{
                                        echo '';
                                    } 
                                ?></p>
                                <br>
                                <h5 class="card-title">วัตถุดิบ</h5>
                                <?php 
                                    echo '<div class="row">';
                                    foreach($resultmenu[0]['ingredients'] as $ing){
                                        echo '<div class="pl-4 col-6">';
                                        echo '<p>'. $ing['name'] .'</p>';
                                        echo '</div>';
                                        echo '<div class="col-3" style="text-align:right;">';
                                        echo '<p class="ml-5">'. $ing['value'] .'</p>';
                                        echo '</div>';
                                        echo '<div class="col-3" style="text-align:right;">';
                                        echo '<p>'. $ing['unit'] .'</p>';
                                        echo '</div>';
                                    }
                                    echo '</div>';
                                ?>

                                <br>
                                <h5 class="card-title">ขั้นตอนการทำ</h5>

                                <?php 
                                    $num = 1;
                                    echo '<div class="row">';
                                    foreach($resultmenu[0]['preparations'] as $ing){
                                        echo '<div class="pl-4 col-2">';
                                        echo '<p>'. $num .'</p>';
                                        echo '</div>';
                                        echo '<div class="col-10" style="text-align:left;padding:0;margin-left:0;">';
                                        echo '<p style="margin-left:5px;padding:0;">'. $ing .'</p>';
                                        echo '</div>';
                                        $num++;
                                    }
                                    echo '</div>';
                                ?>
                                <br>
                                <h5>ผู้เขียน</h5>
                                <div class="col pl-3">Exsample.@gmail.com</div>
                                <h5>เอกสารอ้างอิง</h5>
                                <div class="col pl-3">
                                    https://www.wongnai.com/recipes/ugc/7b9ac2dcbf0d4a64b8bda6539ae75ba5</div>
                                <!-- <br>
                                <h5 class="">โภชนาการ</h5>
                                <p class="ml-4">คาร์โบไฮเดรต: 10 g ให้พลังงาน <?php echo 10*4 ?> kcal</p>
                                <p class="ml-4">ไขมัน: 10 g ให้พลังงาน <?php echo 10*9 ?> kcal</p>
                                <p class="ml-4">โปรตีน: 10 g ให้พลังงาน <?php echo 10*4 ?> kcal</p>
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="chart-bar">
                                            <canvas id="myBarChart"></canvas>
                                        </div>
                                        <hr>
                                        <p> คาร์โบไฮเดรต 1 กรัม ให้พลังงาน 4 กิโลแคลอรี</p>
                                        <p> ไขมัน 1 กรัม ให้พลังงาน 9 กิโลแคลอรี</p>
                                        <p> โปรตีน 1 กรัม ให้พลังงาน 4 กิโลแคลอรี</p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card" style="box-shadow: 0 4px 5px rgba(0, 0, 0, 0.6);">
                    <div class="card-body">
                        <center>
                            <h5 class="card-title">อาหารแนะนำ</h5>
                        </center>
                        <?php
                            foreach( json_decode($resultmenu2,true) as $rowmenu){
                        ?>
                        <div class="row mb-3">
                            <div class="col-4"><img class="card-img-left rounded-circle"
                                    src="<?php if ($rowmenu["image"] != null) { echo $rowmenu["image"]; } else { echo "https://icons-for-free.com/iconfiles/png/512/food+icon-1320167995070278295.png"; }  ?>"
                                    width="100" height="100" alt="Card image cap">
                            </div>
                            <div class="col-8"> <?php echo $rowmenu["title"]; ?>
                                <?php echo '<a class="link" href=/projectapi/show-food.php?id='. (int)$rowmenu['_id'] .'>'. "<br>Read more"; ?></a>
                            </div>
                        </div>
                        <?php
                            }; 
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include("function/footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="mainstyle/jquery/jquery.min.js"></script>
    <script src="mainstyle/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Chart Bar -->
    <script src="assets/js/chart.js/Chart.min.js"></script>
    <script src="assets/js/chart.js/chart-bar-demo.js"></script>

    <!--Chart Pei -->
    <script src="admin/assets/node_modules/jquery/jquery.min.js"></script>
    <script src="admin/assets/node_modules/d3/d3.min.js"></script>
    <script src="admin/assets/node_modules/c3-master/c3.min.js"></script>
    <script src="admin/js/dashboard1.js"></script>

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