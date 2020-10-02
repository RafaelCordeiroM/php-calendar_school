<?php ob_start() ?>
<?php include "include/functions.php"; ?>
<?php
session_start();
if (isset($_POST['login_submit'])) {
    echo "ionmdsa";
    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login == "virgilio" && $password == "seemg") {

        $_SESSION["login"] = true;
        header("location: admin.php");
    }
}

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
    <?php
    if (isset($_SESSION['login'])) :
    ?>
        <a class="btn btn-outline-dark" href="admin.php">
            <i class="fa fa-user"></i> Admin
        </a>
    <?php else : ?>
        <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal_login">
            <i class="fa fa-user"></i>
        </button>
    <?php endif; ?>

</div>
<div class="container wrapper">
    <div class="row">
        <div class="col-sm-12 side-div-inverse">
            <h2 class="text-muted text-center">Notificações</h2>
            <hr>
            <!-- ///////////////////////////////////////////////////////////////////// -->
            <div class="text-center p-3">
                <button class="btn btm-secondary btn-sm toggle-all"><i class="fa fa-th" aria-hidden="true"></i> Mostrar todos</button>
            </div>

            <div id="infinite_carousel" class="d-flex align-items-center">
                <div class="p-3 control"><i class="fa fa-2x text-muted fa-chevron-left"></i></div>
                <div class="row w-100 flex-nowrap" style="overflow: hidden;">

                    <?php

                    $array_not = array_get_not("java_modal");

                    for ($i = 0; $i < count($array_not); $i++) {


                    ?>
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2 text-center">
                            <div class="p-4 notification-div modal_open_not" style="cursor:pointer;" id="<?= $array_not[$i]["not_id"] ?>">
                                <span style="font-size:25px;"><i class="fa fa-warning"></i></span>
                                <p id="notification-title">
                                    <?= $array_not[$i]["not_title"] ?>
                                </p>
                                <div class="bg-light" style="border-radius:10px;">
                                    <i class="fa fa-clock-o"></i><?= $array_not[$i]["not_date"]." às ".$array_not[$i]["not_hour"] ?>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
                <div class="p-3 control">
                    <i class="fa fa-2x text-muted fa-chevron-right"></i>
                </div>

            </div>
            <!-- ///////////////////////////////////////////////////////////////////// -->

        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-7 side-div text-center">
            <h2 class="text-muted text-center">Eventos</h2>
            <hr>
            <section class="p-4">
                <div class="container d-block" align="center">

                    <?php

                    $array = array_get_agenda("php");
                    for ($i = 0; $i < count($array); $i++) {

                        $date = date_create($array[$i]["agenda_date"]);

                    ?>
                        <span class="el_css modal_open" id="<?= $array[$i]["agenda_id"] ?>">
                            <div class="div-date-scheduled border_schedule_div m-1 mb-4" style="cursor:pointer;">
                                <div class="mr-2 p-1 ">
                                    <h2 class="target_el_css" style="color:black;"><?= $array[$i]["agenda_title"]; ?></h2>
                                </div>
                                <div class="date_div p-3">
                                    <span class="day"><?= date_format($date, "d"); ?></span>
                                    <span class="mos">/<?= date_format($date, "m"); ?>/</span>
                                    <span class="yr"><?= date_format($date, "Y"); ?></span>
                                </div>
                            </div>
                        </span>
                    <?php } ?>
                </div>


            </section>

        </div>
        <div class="col-sm-5 side-div">
            <h2 class="text-muted text-center">Calendário Anual</h2>
            <hr>
            <?php include "calendario.php"; ?>

        </div>
    </div>
</div>
<?php include "include/modal/modal_view_not.php" ?>
<?php include "include/modal/modal_view.php" ?>
<?php include "include/modal/modal_view_multiple.php" ?>
<?php include "include/modal/modal_subscribe.php" ?>

<?php include "include/modal/modal_login.php" ?>
<?php include "include/footer.php" ?>