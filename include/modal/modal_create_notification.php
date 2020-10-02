<?php 
    if(isset($_POST['input_create_not'])){
        if (create_not()){
            echo"<script>alert('Criado com sucesso!')</script>";
        }
    }
?>

<div class="modal fade" id="modal_create_not" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" method="post">


                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" max="100" placeholder="Título" required>
                    <br>
                    <label for="author">Autor</label>
                    <input type="text" name="author" class="form-control" placeholder="Autor" required>
                    <br>

                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" id="editor_description_not" class="form-control" placeholder="descrição" required>                    
                    </textarea>
                    <!-- <script>
                        ClassicEditor
                            .create(document.querySelector('#editor_description_not'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script> -->

                    <input type="submit" value="Criar" name="input_create_not" class="btn btn-primary btn-block btn-lg">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>