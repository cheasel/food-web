<?php
    session_start();
    include '../main/connectAPI.php';
    if (isset($_SESSION['id'])) {
        $session_login_id = $_SESSION['id'];
        $session_login_email = $_SESSION['email'];
        $session_login_username = $_SESSION['username'];
        $session_login_status = $_SESSION['status'];
    }

    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = 20;
    $skip = ($page - 1) * $limit;
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $url = 'menu-detail/ingre-name?username=cheasel&api_key=fe1913c8bddda7fbf1b050c92949ef887c97369bb965bc866bcbc9c15d65154e&name='.urlencode($search).'&skip='.$skip.'&limit='.$limit;
    $resultmenu = json_decode(getAPI($url),true);
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
    <link href="../mainstyle/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../mainstyle/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../mainstyle/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/landing-page.min.css" rel="stylesheet">

    <link href="../css/all.min.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="../assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="../assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">

    <link href="../css/show-food.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="../mainstyle/jquery/jquery.min.js"></script>
    <script src="../mainstyle/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="../assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="../assets/node_modules/raphael/raphael-min.js"></script>
    <script src="../assets/node_modules/morrisjs/morris.min.js"></script>
    <!--c3 JavaScript -->
    <script src="../assets/node_modules/d3/d3.min.js"></script>
    <script src="../assets/node_modules/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <link href="../css/show-food.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!--<div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Sharing Thai Food</p>
        </div>
    </div>-->
    <div id="main-wrapper">
        <?php include("../function/header-admin.php"); ?>
        <?php include("../function/list-admin.php"); ?>
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Recipe</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">All Recipe</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="../main/add-menu.php" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down">Add Food <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body row">
                                <div class="col-8">
                                    <h4 class="card-title">Recipe</h4>
                                    <h6 class="card-subtitle">Manage Recipe</h6>
                                </div>
                                <div class="col-4 admin-search-container">
                                    <form action="allfood.php">
                                        <div class='admin-search'>
                                            <i class="fa fa-search"></i>
                                            <input style="width: 75%;" type="text" placeholder="ค้นหาจากชื่อเมนู, วัตถุดิบ" name="search">
                                            <button type="button" id="filter-but"><i class="fa fa-filter"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 table-responsive" style="margin: 5px 10px 5px 10px; display:none;" id="filter-box">
                                    <div class="col-12" style="padding-left: 0; font-size: 1.1rem;">
                                        <i class="fa fa-times" id="close-filter"></i>
                                    </div>
                                    <div class="col-12">
                                        <h6>ADVANCE SEARCH</h6>
                                    </div>
                                    <form action="">
                                        <div class="row">
                                            <div class="col-6 form-group">
                                                <label class="col-12">min calories</label>
                                                <div class="col-8">
                                                    <input type="text" name="min-cal" placeholder="0" class="form-control form-control-line" style="min-height: 20px; font-size: 14px;">
                                                </div>
                                            </div>
                                            <div class="col-6 form-group">
                                                <label class="col-12">max calories</label>
                                                <div class="col-8">
                                                    <input type="text" name="max-cal" placeholder="0" class="form-control form-control-line" style="min-height: 20px; font-size: 14px;">
                                                </div>
                                            </div>
                                            <label class="col-12" style="padding-left:28px;">ingredients</label>
                                            <div class="col-1">
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient1" name="ingredient1" value="หมู">
                                                <label for="ingredient1"> หมู</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient2" name="ingredient2" value="ไก่">
                                                <label for="ingredient2"> ไก่</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient3" name="ingredient3" value="กุ้ง">
                                                <label for="ingredient3"> กุ้ง</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient4" name="ingredient4" value="ปลาหมึก">
                                                <label for="ingredient4"> ปลาหมึก</label>
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient5" name="ingredient5" value="ปลา">
                                                <label for="ingredient5"> ปลา</label>
                                            </div>
                                            <div class="col-1">
                                            </div>
                                            <div class="col-1">
                                            </div>
                                            <div class="col-2">
                                                <input type="checkbox" id="ingredient6" name="ingredient6" value="ไข่">
                                                <label for="ingredient6"> ไข่</label>
                                            </div>
                                            <div class="col-12">
                                                <center>
                                                    <input type="reset"></input>
                                                    <input type="submit"></input>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Calories (kcal)</th>
                                                <th>Date Add</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = (($page - 1) * $limit) + 1;
                                            foreach($resultmenu as $row){ ?>
                                                <tr>
                                                    <td><?php echo $i ?></td>
                                                    <td>
                                                        <h6><?php echo $row["title"]; ?></h6>
                                                    </td>
                                                    <td><?php echo number_format((float)$row['nutrition']['calories']['quantity']/$row['serve'], 2, '.', ''); ?></td>
                                                    <td><?php echo date('m/d/Y H:i:s', (int) ((int)$row["date_add"]['$date'] / 1000)); ?></td>
                                                    <td>
                                                        <a href="<?php echo '../main/edit-food.php?id='. $row["_id"] ?>"><i class="fa fa-pencil-square-o text-success mr-3" style="font-size: 1.25rem;"></i></a>
                                                        <a href="#exampleModal" data-toggle="modal" data-id="<?php echo $row["_id"] ?>" class="open-modal"><i class="fa fa-trash-o text-danger" style="font-size: 1.25rem;"></i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++;
                                            } ?>
                                        </tbody>
                                    </table>
                                    <?php include('../function/pagination.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer" style="padding-top:1rem !important;padding-bottom:1rem !important">
                © 2020 Admin by sharing-thaifood.herokuapp.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
    </div>

    <!-- On top -->
    <div class="secondmenu text-right">
        <a href='#top' id="">
            <i class="fa fa-angle-up btn btn-block btn-lg " style="width: 50px; height: 43px;" aria-hidden="true"></i>
        </a>
    </div>

    <script>
        // On top
        $("a[href='#top']").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false;
        });

        $(document).on("click", ".open-modal", function () {
            var foodId = $(this).data('id');
            $("#foodId").val( foodId );
        });

        // filter-box toggle
        $("#filter-but").click(function(){
            $("#filter-box").toggle();
        });

        // close-filter button 
        $("#close-filter").click(function(){
            $("#filter-box").hide();
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Delete</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5>You want to delete a receipe ?</h5>
        </div>
        <div class="modal-footer">
            <form action="../function/delete-food.php" method="POST">
                <input type="hidden" name="foodId" id="foodId" value=""/>
                <input type="hidden" name="status" id="status" value="<?php echo $session_login_status ?>"/>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancle</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>
    </div>

</body>

</html>