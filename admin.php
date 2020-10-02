<?php include "include/functions.php"; ?>
<?php
session_start();

if (!isset($_SESSION["login"])) {
    unset($_SESSION['login']);
    session_destroy();
    header("location: ./");
}
if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    session_destroy();
    header("location: ./");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (isset($_SESSION['login'])) {
        $query = mysqli_prepare($connection, "DELETE from agenda where agenda_id = ?");
        mysqli_stmt_bind_param($query, "i", $id);
        $result = mysqli_stmt_execute($query);
        header("location: {$_SERVER['PHP_SELF']}?deleted");

    }
}
if (isset($_GET['delete_not'])) {
    $id = $_GET['delete_not'];
    if (isset($_SESSION['login'])) {
        $query = mysqli_prepare($connection, "DELETE from notifications where not_id = ?");
        mysqli_stmt_bind_param($query, "i", $id);
        $result = mysqli_stmt_execute($query);
        header("location: {$_SERVER['PHP_SELF']}?deleted");
    }
}
?>
<?php 

if(isset($_GET['deleted'])) echo "<script>alert('Apagado com succeso.')</script>";

?>
<?php include "include/header.php" ?>
<div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <br>
                <button class="btn btn-outline-light " data-toggle="modal" data-target="#subscribe_modal">INSCREVER-SE</button>
            </div>
        </div>
    </div>
<div class="admin-entry">
    <a href="<?= $_SERVER['PHP_SELF'] ?>?logout" class="btn btn-outline-dark">
        <i class="fa fa-sign-out"></i>
    </a>
</div>
<?php

if (isset($result) && $result) {
    echo "
    <br>
<div class='alert alert-success text-center'>Apagado com sucesso.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>
";
}

?>
<div class="container wrapper">
    <div class="row d-flex">

        <div class="col-sm-12">
            <nav class="navbar navbar-dark sticky-top bg-dark">
                <div class="btn-group">
                    <button class="btn btn-outline-light" data-toggle="modal" data-target="#modal_create_not"><i class="fa fa-plus"></i> Criar Notificação</button>
                    <button class="btn btn-outline-light" data-toggle="modal" data-target="#modal_create"><i class="fa fa-plus"></i> Criar Evento</button>
                </div>
                <form class="form-inline my-2 my-lg-0" method="get" action="search_page.php">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Procurar">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </nav>
        </div>
    </div>
    <hr>


    <!-- /////////////////////////////////notfications/////////////////////////////////// -->



    <h2 class="text-muted text-center">
        Notificações
    </h2>
    <hr>

    <!-- /////////////// Infinite carousel  ////////////// -->
    <div class="text-center p-3">
        <button class="btn btm-secondary btn-sm toggle-all"><i class="fa fa-th" aria-hidden="true"></i> Mostrar todos</button>
    </div>

    <div id="infinite_carousel" class="d-flex align-items-center mb-4">
        <div class="p-3 control"><i class="fa fa-2x text-muted fa-chevron-left"></i></div>
        <div class="row w-100 flex-nowrap" style="overflow: hidden;">
            <?php

            $array_not = array_get_not("java_modal");

            for ($i = 0; $i < count($array_not); $i++) {

            ?>
                <div class="col-6 col-sm-4 col-md-4 col-xl-3 text-center">

                    <div class="card">
                        <div class="card-header text-right" style="background-image: linear-gradient(45deg, #ffe69e, #fbee3d);">
                            <button class='btn btn-outline-dark btn_confirm' data-toggle="modal" data-target="#modal_confirm" id="./include/email.php?id=<?= $array_not[$i]["not_id"] ?>&&route=notification">
                                <h5>
                                    <b>
                                        <i class="fa fa-bell"></i>
                                    </b>
                                </h5>
                            </button>
                            <button class='btn btn-outline-dark modal_update_open_not' id="<?= $array_not[$i]["not_id"]; ?>">
                                <h5>
                                    <b>
                                        <i class="fa fa-edit"></i>
                                    </b>
                                </h5>
                            </button>
                            <a class='btn btn-outline-dark' href="<?php echo $_SERVER['PHP_SELF'] . "?delete_not=" . $array_not[$i]["not_id"] ?>">
                                <h5>
                                    <b>
                                        <i class="fa fa-trash"></i>
                                    </b>
                                </h5>
                            </a>
                        </div>
                        <!-- tag a to direct to modal, as a preview -->

                        <div class="card-body">
                            <h5 class="card-title"><?= $array_not[$i]["not_title"] ?></h5>

                            <p><i class="fa fa-clock-o"></i>
                                publicado às: <?= $array_not[$i]["not_hour"] ?></p>

                            <button class="btn btn-danger card-link modal_open_not" id="<?= $array_not[$i]["not_id"] ?>">Ver</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="p-3 control">
            <i class="fa fa-2x text-muted fa-chevron-right"></i>
        </div>
    </div>



    <!-- /////////////////////////////////EVENTOS/////////////////////////////////// -->



    <hr>
    <h2 class="text-muted text-center mt-4">
        Eventos
    </h2>
    <hr>
    <div class="row d-flex ">
        <?php

        $array = array_get_agenda("php");

        for ($i = 0; $i < count($array); $i++) {
            $date = date_create($array[$i]["agenda_date"]);
            $hour = date_create($array[$i]["agenda_hour"]);
        ?>
            <div class="col-sm-4">
                <div class="card card-a" style="width: 18rem;">

                    <div class="card-header text-right bg-dark" >
                        <button class='btn btn-dark btn_confirm' data-toggle="modal" data-target="#modal_confirm" id="./include/email.php?id=<?= $array[$i]["agenda_id"] ?>&&participants=<?= $array[$i]["agenda_participants"] ?>&&route=event">
                            <h5>
                                <b>
                                    <i class="fa fa-bell"></i>
                                </b>
                            </h5>
                        </but>
                        <button class='btn btn-dark modal_update_open' id="<?= $array[$i]["agenda_id"]; ?>">
                            <h5>
                                <b>
                                    <i class="fa fa-edit"></i>
                                </b>
                            </h5>
                        </button>
                        <button class='btn btn-dark btn_delete_event' id="<?= $array[$i]["agenda_id"] ?>">
                            <h5>
                                <b>
                                    <i class="fa fa-trash"></i>
                                </b>
                            </h5>
                        </button>
                    </div>
                    <!-- tag a to direct to modal, as a preview -->

                    <div class="card-body">
                        <h5 class="card-title"><?= $array[$i]["agenda_title"] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Responsável(eis): <?= $array[$i]["agenda_teachers"] ?></h6>

                        <p><i class="fa fa-calendar"></i>
                            <?= date_format($date, "d") . "/" . date_format($date, "m") . "/" . date_format($date, "Y") ?>
                            às <?= date_format($hour, "H") . ":" . date_format($hour, "i") ?> hrs</p>

                        <button class="btn btn-primary card-link modal_open" id="<?= $array[$i]["agenda_id"] ?>">Ver</button>
                    </div>
                </div>
            </div>
        <?php } ?>




    </div>
</div>
</div>
<?php include "include/modal/modal_create_event.php" ?>
<?php include "include/modal/modal_create_notification.php" ?>
<?php include "include/modal/modal_update.php" ?>
<?php include "include/modal/modal_update_not.php" ?>
<?php include "include/modal/modal_view_not.php" ?>
<?php include "include/modal/modal_view.php" ?>
<?php include "include/modal/modal_delete_event.php" ?>
<?php include "include/modal/modal_confirm.php" ?>
<?php include "include/modal/modal_subscribe.php" ?>


<?php include "include/footer.php" ?>