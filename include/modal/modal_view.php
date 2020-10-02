<div class="modal fade" id="modal_agenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-image: linear-gradient(to left,#f9d56d,#a83737);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-12 text-center ">
                            <div class="jumbotron">
                                <h3>
                                    <p id="modal_title"></p>
                                </h3>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center border-bottom ">
                            <div class="" style="display:inline-flex;">
                                <h2><i class="fa fa-calendar"></i></h2>
                                <div class="hour_div p-2">

                                    <span class="hour">

                                        <h5>
                                            <p id="modal_hour">

                                            </p>

                                        </h5>
                                    </span>
                                </div>
                                <div class='date_div p-2' style="color:white;">
                                    <p id="modal_date">

                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6 pt-4 pb-4 " style="background-image: linear-gradient(to right,white,white,white,#eee);">
                            <h5><b><i class="fa fa-user"></i> Responsável(eis) :</b></h5>
                            <p id="modal_teachers" class="text-muted"></p>
                        </div>

                        <div class="col-sm-6 pt-4 pb-4" style="background-image: linear-gradient(to right,white,white,white,#eee);">
                            <h5><b>Direcionado às turmas:</b></h5>
                            <p id="modal_participants" class="text-muted"></p>
                        </div>

                        <div class="col-sm-12 border-top text-center bg-dark p-4" style="color:white;border-radius:10px;">
                            <h5><b><i class="fa fa-comments"></i> Descrição</b></h5>
                            <p id="modal_description" class="text-muted"></p>
                        </div>


                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>