<?php if (isset($_POST['submit_create_event'])) {
    if(create_event()){
        echo "<script>alert('Criado com sucesso!')</script>";
    }
}
?>

<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" required placeholder="Título">

                        <br>

                        <label for="description">Descrição</label>
                        <textarea type="text" name="description" id="editor-content" class="form-control" required>
                        </textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor-content'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>

                        <br>

                        <label for="teachers">Professores coordenadores</label>
                        <input type="text" class="form-control" name="teachers" required>

                        <br>
                        <hr>
                        <div class="from-group d-flex">
                            <div class="col">
                                <label for="date">Data</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="col">
                                <label for="time">Horário</label>
                                <input type="time" class="form-control" name="hour" required>
                            </div>
                        </div>
                        <hr>
                        <br>

                        <label for="">Direcionado a:</label>
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <th>Todos <input type='checkbox' class='form-control all'></th>
                                <th>1° <input type='checkbox' class='form-control select-1' name='participants[]' value=''> </th>
                                <th>2° <input type='checkbox' class='form-control select-2' name='participants[]' value=''> </th>
                                <th>3° <input type='checkbox' class='form-control select-3' name='participants[]' value=''> </th>
                                <th>Professores</th>
                            </thead>
                            <!-- sN -> s=Serie and n=serie -->
                            <!-- cN -> c=class and N=class -->
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>A<input type='checkbox' class='form-control s1 cA ' name='participants[]' value='1ºA'></td>
                                    <td>A<input type='checkbox' class='form-control s2 cA ' name='participants[]' value='2ºA'></td>
                                    <td>A<input type='checkbox' class='form-control s3 cA ' name='participants[]' value='3ºA'></td>
                                    <td>Todos<input type='checkbox' class='form-control teachers' name='participants[]' value='Professores'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>B<input type='checkbox' class='form-control s1 cB ' name='participants[]' value='1ºB'></td>
                                    <td>B<input type='checkbox' class='form-control s2 cB ' name='participants[]' value='2ºB'></td>
                                    <td>B<input type='checkbox' class='form-control s3 cB ' name='participants[]' value='3ºB'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>C<input type='checkbox' class='form-control s1 cC ' name='participants[]' value='1ºC'></td>
                                    <td>C<input type='checkbox' class='form-control s2 cC ' name='participants[]' value='2ºC'></td>
                                    <td>C<input type='checkbox' class='form-control s3 cC ' name='participants[]' value='3ºC'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>D<input type='checkbox' class='form-control s2 cD' name='participants[]' value='2ºD'></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>E<input type='checkbox' class='form-control s2 cE' name='participants[]' value='2ºE'></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Criar" name="submit_create_event">
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>