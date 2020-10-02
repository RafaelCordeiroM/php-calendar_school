<script src="./js/bootstrap.min.js"></script>
<script src="./js/script.js"></script>

<script>
    // function to get the index of array by id
    function get_index_by_id(id) {
        for (var i = 0; i < this.array.length; i++) {
            if (this.array[i].agenda_id == id) {
                return i;
            }
        }
    }
    <?php $array = array_get_agenda("java_modal"); ?>
    var array = <?= json_encode($array); ?>;

    ///////////////////////////////////////// view event   //////////////////////////////////////////
    //listen when the button is clicked
    $(document).ready(function() {
        $(".modal_open").on("click", function() {

            var id = $(this).attr("id");
            var index = get_index_by_id(id);

            ///////////////////////

            //apply text in modal

            document.querySelector("#modal_title").innerHTML = array[index].agenda_title;
            document.querySelector("#modal_hour").innerHTML = array[index].agenda_hour;
            document.querySelector("#modal_date").innerHTML = array[index].agenda_date;
            document.querySelector("#modal_teachers").innerHTML = array[index].agenda_teachers;
            document.querySelector("#modal_participants").innerHTML = array[index].agenda_participants;
            document.querySelector("#modal_description").innerHTML = array[index].agenda_description;


            ////////////////

            $("#modal_agenda").modal("show");
        });
    });
    /////////////////////////////////////////////////  Update event       //////////////////////////////////

    <?php $array = array_get_agenda("php"); ?>
    var array_update = <?= json_encode($array); ?>;
    $(document).ready(function() {
        $(".modal_update_open").on("click", function() {

            var id = $(this).attr("id");
            var index = get_index_by_id(id);

            ///////////////////////

            //apply text in modal
            array_update[index].agenda_hour = array_update[index].agenda_hour.slice(0, -3);
            var n1 = document.querySelector("#edit_id");
            if (n1) n1.value = id;
            document.querySelector("#edit_title").value = array_update[index].agenda_title;
            document.querySelector("#edit_hour").value = array_update[index].agenda_hour;
            document.querySelector("#edit_date").value = array_update[index].agenda_date;
            document.querySelector("#edit_teachers").value = array_update[index].agenda_teachers;
            document.querySelector("#edit_description").innerHTML = array_update[index].agenda_description;
            // CKEDITOR.instances['edit_description'].insertHtml(array_update[index].agenda_description);

            // uncheck all checkboxes
            $(".s1").each(function() {
                this.checked = false;
            });
            $(".s2").each(function() {
                this.checked = false;
            });
            $(".s3").each(function() {
                this.checked = false;
            });


            var participants = array_update[index].agenda_participants.split(' ');
            //the last element is null

            //deleting first and last element if;
            if (participants[participants.length - 1] == "") participants.pop();
            if (participants[0] == "") participants.shift();
            console.log(participants);

            participants.forEach(element => {
                $('.' + element).each(function() {
                    this.checked = true;
                });
            });


            $("#modal_update").modal("show");
        });
    });









    ////////////////////////////////////// view notifications/////////////////////////////////////////////

    <?php $array_not = array_get_not("java_modal"); ?>
    var array_not = <?= json_encode($array_not); ?>;

    function get_index_by_id_not(id) {
        for (var i = 0; i < this.array_not.length; i++) {
            if (this.array_not[i].not_id == id) {
                return i;
            }
        }
    }
    ///////////////////////////////////////// view event   //////////////////////////////////////////
    //listen when the button is clicked
    $(document).ready(function() {
        $(".modal_open_not").on("click", function() {

            var id = $(this).attr("id");
            var index = get_index_by_id_not(id);

            console.log(array_not[index]);

            ///////////////////////

            //apply text in modal
            document.querySelector("#modal_not_title").innerHTML = array_not[index].not_title;
            document.querySelector("#modal_not_hour").innerHTML = array_not[index].not_hour;
            document.querySelector("#modal_not_author").innerHTML = array_not[index].not_author;
            document.querySelector("#modal_not_description").innerHTML = array_not[index].not_description;


            ////////////////

            $("#modal_not").modal("show");
        });
    });

    <?php $array = array_get_not("php"); ?>
    var array_update_not = <?= json_encode($array); ?>;

    $(document).ready(function() {
        $(".modal_update_open_not").on("click", function() {

            var id = $(this).attr("id");
            var index = get_index_by_id_not(id);

            //apply text in modal
            document.querySelector("#edit_not_id").value = id;
            document.querySelector("#edit_not_title").value = array_update_not[index].not_title;
            document.querySelector("#edit_not_author").value = array_update_not[index].not_author;
            document.querySelector("#edit_not_description").innerHTML = array_update_not[index].not_description;

            $("#modal_update_not").modal("show");
        });
    });





    ////////////////////////////////////////////////// Multiple view ///////////////

    $(document).ready(function() {
        $(".btn_modal_multiple").on("click", function() {
            var id = $(this).attr("id");
            var array_id = id.split('-');
            if (array_id[array_id.length - 1] == "") array_id.pop();

            var html = "";
            for (var i = 0; i < array_id.length; i++) {
                var index = get_index_by_id(array_id[i]);

                var htmlModel =
                    '<div class="row"><div class="col-sm-12 text-center "><div class="jumbotron"><h3><p>%title%</p></h3></div></div><div class="col-sm-12 text-center border-bottom "><div class="" style="display:inline-flex;"><h2><i class="fa fa-calendar"></i></h2><div class="hour_div p-2"><span class="hour"><h5><p>%hour%</p></h5></span></div><div class="date_div p-2" style="color:white;"><p>%date%</p></div></div></div><div class="col-sm-6 pt-4 pb-4 " style="background-image: linear-gradient(to right,white,white,white,#eee);"><h5><b><i class="fa fa-user"></i> Responsável(eis) :</b></h5><p class="text-muted">%teachers%</p></div><div class="col-sm-6 pt-4 pb-4" style="background-image: linear-gradient(to right,white,white,white,#eee);"><h5><b>Direcionado às turmas:</b></h5><p class="text-muted">%participants%</p></div><div class="col-sm-12 border-top text-center bg-dark p-4" style="color:white;border-radius:10px;"><h5><b><i class="fa fa-comments"></i> Descrição</b></h5><p class="text-muted">%description%</p></div></div>';
                    htmlModel = htmlModel.replace("%title%", array[index].agenda_title);
                    htmlModel = htmlModel.replace("%hour%", array[index].agenda_hour);
                    htmlModel = htmlModel.replace("%date%", array[index].agenda_date);
                    htmlModel = htmlModel.replace("%teachers%", array[index].agenda_teachers);
                    htmlModel = htmlModel.replace("%participants%", array[index].agenda_participants);
                    htmlModel = htmlModel.replace("%description%", array[index].agenda_description);
                html += htmlModel;
            }
            
            document.querySelector(".container_modal_multiple").innerHTML = html

        })
    });










    //system of selection adminPage
    $(document).ready(function() {

        $(".select-1").click(function(event) {

            if (this.checked) {
                $(".s1").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s1").each(function() {
                    this.checked = false;
                });
            }

        });

        $(".select-2").click(function(event) {

            if (this.checked) {
                $(".s2").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s2").each(function() {
                    this.checked = false;
                });
            }

        });

        $(".select-3").click(function(event) {

            if (this.checked) {
                $(".s3").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s3").each(function() {
                    this.checked = false;
                });
            }

        });

        $(".all").click(function(event) {

            if (this.checked) {
                $(".s1").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s1").each(function() {
                    this.checked = false;
                });
            }

            if (this.checked) {
                $(".s2").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s2").each(function() {
                    this.checked = false;
                });
            }

            if (this.checked) {
                $(".s3").each(function() {
                    this.checked = true;
                });
            } else {
                $(".s3").each(function() {
                    this.checked = false;
                });
            }

            if (this.checked) {
                $(".teachers").each(function() {
                    this.checked = true;
                });
            } else {
                $(".teachers").each(function() {
                    this.checked = false;
                });
            }

        });

    });
</script>
<script>
    $('.toggle-all').on('click', function() {
        $('#infinite_carousel .row').toggleClass('flex-nowrap');
        $('#infinite_carousel .control').toggleClass('d-none');
        $(this).html($('#infinite_carousel .row').hasClass('flex-nowrap') ? '<i class="fa fa-th" aria-hidden="true"></i> Mostrar todos' : '<i class="fa fa-chevron-right" aria-hidden="true"></i> Voltar');
    });

    $('#infinite_carousel .fa-chevron-right').on('click', () => {
        let $infinite_carousel_row = $('#infinite_carousel .row');
        let $col = $infinite_carousel_row.find('.col-6:first');
        $infinite_carousel_row.append($col[0].outerHTML);
        $col.remove();
    });

    $('#infinite_carousel .fa-chevron-left').on('click', () => {
        let $infinite_carousel_row = $('#infinite_carousel .row');
        let $col = $infinite_carousel_row.find('.col-6:last');
        $infinite_carousel_row.prepend($col[0].outerHTML);
        $col.remove();
    });
</script>
<script>
    $(document).ready(function() {

        $(".btn_delete_event").on("click", function() {
            var link = $(this).attr("id");
            link_delete = "admin.php?delete=" + link;
            $(".btn_delete").attr("href", link_delete);
            $("#modal_delete_event").modal('show');
        });

    });
    $(document).ready(function() {

        $(".btn_confirm").on("click", function() {
            var link = $(this).attr("id");
            $(".btn_modal_confirm").attr("href", link);
            $("#modal_confirm").modal('show');
        });

    });

</script>

</body>

</html>