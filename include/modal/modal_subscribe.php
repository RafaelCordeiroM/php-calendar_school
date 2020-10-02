<?php

if (isset($_POST['subscribe_submit'])) {

    $email = $_POST['email'];
    $class = $_POST['class'];

    $query = mysqli_query($connection, "SELECT * from users where user_email = '{$email}'");

    if (mysqli_num_rows($query) == 1) {
        $stmt = mysqli_prepare($connection, "UPDATE users set user_class = ? WHERE user_email = ?");
        mysqli_stmt_bind_param($stmt, "ss", $class, $email);
        if (!mysqli_stmt_execute($stmt)) echo mysqli_stmt_error($stmt);
    } else if (mysqli_num_rows($query) == 0) {
        $stmt = mysqli_prepare($connection, "INSERT INTO users(user_class,user_email) VALUES(?,?)");
        mysqli_stmt_bind_param($stmt, "ss", $class, $email);
        mysqli_stmt_execute($stmt);
        if (!mysqli_stmt_execute($stmt)) echo mysqli_stmt_error($stmt);
    }
    echo "<script>alert('Incrito com sucesso!')</script>";
}

?>
<div class="modal fade" id="subscribe_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-image: linear-gradient(to right,#363a75,#b3852f,#eeba3e);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wrapper fadeInDown" style="box-shadow:none;">
                    <div id="formContent" class="text-center">
                        <!-- Login Form -->
                        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST">

                            <label for="email">Endereço de email</label>
                            <input type="email" id="email_subscribe" class="form-control fadeIn first" name="email" placeholder="Email" required>

                            <br>

                            <label for="class">Selecionar Turma</label>
                            <select name="class" id="" class="fadeIn second form-control required" required>
                                <option value="" hidden></option>
                                <option value="1ºA">1ºA</option>
                                <option value="1ºB">1ºB</option>
                                <option value="1ºC">1ºC</option>
                                <option value="2ºA">2ºA</option>
                                <option value="2ºB">2ºB</option>
                                <option value="2ºC">2ºC</option>
                                <option value="2ºD">2ºD</option>
                                <option value="2ºE">2ºE</option>
                                <option value="3ºA">3ºA</option>
                                <option value="3ºB">3ºB</option>
                                <option value="3ºC">3ºC</option>
                                <option value="Professores">Professores</option>
                            </select>
                            <input type="submit" class="fadeIn fourth" name="subscribe_submit" value="Inscrever">
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>