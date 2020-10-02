<?php if (isset($_POST['submit_update_not'])) {
    if (update_not()) {
        echo "<script>alert('Editado com sucesso!')</script>";
    }
}
?>

<div class="modal fade" id="modal_update_not" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <form action="" method="post">

                        <!-- hidden id in order to update -->
                        <input type="hidden" name="id" id="edit_not_id">

                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" id="edit_not_title" required>

                        <br>

                        <label for="author">Autor</label>
                        <input type="text" class="form-control" name="author" id="edit_not_author" required>
                        <br>

                        <label for="description">Descrição</label>
                        <textarea type="text" name="description" id="edit_not_description" class="form-control" required></textarea>
                        <!-- <script>
                            ClassicEditor
                                .create(document.querySelector('#edit_not_description'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script> -->

                        <br>
                        <hr>
                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Editar" name="submit_update_not">
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>