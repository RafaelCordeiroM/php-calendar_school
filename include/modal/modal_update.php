<?php if (isset($_POST['submit_update_event'])) {
    if (update_event()) {
        echo "<script>alert('Editado com sucesso!')</script>";
    }
}
?>

<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="id" id="edit_id">

                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" id="edit_title" required>

                        <br>

                        <label for="description">Descrição</label>
                        <textarea type="text" name="description" id="edit_description" class="form-control" required></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#edit_description'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>

                        <br>

                        <label for="teachers">Professores coordenadores</label>
                        <input type="text" class="form-control" name="teachers" id="edit_teachers" required>

                        <br>
                        <hr>
                        <div class="from-group d-flex">
                            <div class="col">
                                <label for="date">Data</label>
                                <input type="date" class="form-control" name="date" id="edit_date" required>
                            </div>
                            <div class="col">
                                <label for="time">Horário</label>
                                <input type="time" class="form-control" name="hour" id="edit_hour" required>
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
                                    <td>A<input type='checkbox' class='form-control s1 cA 1ºA' name='participants[]' value='1ºA'></td>
                                    <td>A<input type='checkbox' class='form-control s2 cA 2ºA' name='participants[]' value='2ºA'></td>
                                    <td>A<input type='checkbox' class='form-control s3 cA 3ºA' name='participants[]' value='3ºA'></td>
                                    <td>Todos<input type='checkbox' class='form-control teachers' name='participants[]' value='Professores'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>B<input type='checkbox' class='form-control s1 cB 1ºB' name='participants[]' value='1ºB'></td>
                                    <td>B<input type='checkbox' class='form-control s2 cB 2ºB' name='participants[]' value='2ºB'></td>
                                    <td>B<input type='checkbox' class='form-control s3 cB 3ºB' name='participants[]' value='3ºB'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>C<input type='checkbox' class='form-control s1 cC 1ºC' name='participants[]' value='1ºC'></td>
                                    <td>C<input type='checkbox' class='form-control s2 cC 2ºC' name='participants[]' value='2ºC'></td>
                                    <td>C<input type='checkbox' class='form-control s3 cC 3ºC' name='participants[]' value='3ºC'></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>D<input type='checkbox' class='form-control s2 cD 2ºD' name='participants[]' value='2ºD'></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>E<input type='checkbox' class='form-control s2 cE 2ºE' name='participants[]' value='2ºE'></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Editar" name="submit_update_event">
                    </form>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>