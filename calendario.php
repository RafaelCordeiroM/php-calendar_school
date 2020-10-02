<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    table td {
        border-top-color: white;

    }

    table {
        border-radius: 17px;
        outline: none;
    }

    tr>td>a {
        color: #a2243e;
    }

    tr>td>a:hover {
        color: #a2243e;
        text-decoration: none;
    }

    .table_day {
        padding: 7px;
        transition-duration: 0.3ms;

        border-radius: 28%;
    }

    .table_day:hover {
        background-image: linear-gradient(45deg, rgba(128, 128, 128, 0.3), rgba(182, 182, 182, 0.3));
    }
    .table_day_scheduled {
        color:#0930a3c2;
        background-image: linear-gradient(to bottom,transparent,transparent,#cbcbd2);
        padding: 7px;
        transition-duration: 0.3ms;
        border-bottom:1px solid #0930a3c2;
        border-radius: 28%;
    }

    .table_day_scheduled:hover {
        background-image: linear-gradient(45deg, rgba(128, 128, 128, 0.3), rgba(182, 182, 182, 0.3));
    }
</style>
<?php

$array_day = get_day_scheduled();

?>
<?php


function MostreSemanas()
{
    $semanas = "DSTQQSS";

    for ($i = 0; $i < 7; $i++)
        echo "<td>" . $semanas{
            $i} . "</td>";
}

function GetNumeroDias($mes)
{
    $numero_dias = array(
        '01' => 31, '02' => 28, '03' => 31, '04' => 30, '05' => 31, '06' => 30,
        '07' => 31, '08' => 31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
    );

    if (((date('Y') % 4) == 0 and (date('Y') % 100) != 0) or (date('Y') % 400) == 0) {
        $numero_dias['02'] = 29;    // altera o numero de dias de fevereiro se o ano for bissexto
    }

    return $numero_dias[$mes];
}

function GetNomeMes($mes)
{
    $meses = array(
        '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
        '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
        '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
        '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro"
    );

    if ($mes >= 01 && $mes <= 12) {
        return $meses[$mes];
    } else {
        return "Mês deconhecido";
    }
}

function MostreCalendario($mes)
{
    global $array_day;

    $numero_dias = GetNumeroDias($mes);    // retorna o número de dias que tem o mês desejado
    $nome_mes = GetNomeMes($mes);
    $diacorrente = 0;

    $diasemana = jddayofweek(cal_to_jd(CAL_GREGORIAN, $mes, "01", date('Y')), 0);    // função que descobre o dia da semana

    echo "<div class='col-sm-12'>";
    echo "<table border = '0' class='table' style='background-color:#dbdbdb;' cellspacing = '0' align = 'center'>";
    echo "<tr>";
    echo "<td colspan = 7><h3>" . $nome_mes . "</h3></td>";
    echo "</tr>";
    echo "<tr>";
    MostreSemanas();    // função que mostra as semanas aqui
    echo "</tr>";
    for ($linha = 0; $linha < 6; $linha++) {


        echo "<tr>";

        for ($coluna = 0; $coluna < 7; $coluna++) {
            echo "<td width = '30' height = '30' style='padding:0px;' ";

            if (($diacorrente == (date('d') - 1) && date('m') == $mes)) {
                echo " id = 'dia_atual' ";
            } else {
                if (($diacorrente + 1) <= $numero_dias) {
                    if ($coluna < $diasemana && $linha == 0) {
                        echo " id = 'dia_branco' ";
                    } else {
                        echo " id = 'dia_comum' ";
                    }
                } else {
                    echo " ";
                }
            }
            echo " align = 'center' valign = 'center'>";


            /* TRECHO IMPORTANTE: A PARTIR DESTE TRECHO É MOSTRADO UM DIA DO CALENDÁRIO (MUITA ATENÇÃO NA HORA DA MANUTENÇÃO) */

            if ($diacorrente + 1 <= $numero_dias) {
                if ($coluna < $diasemana && $linha == 0) {
                    echo " ";
                } else {
                    // echo "<input type = 'button' id = 'dia_comum' name = 'dia".($diacorrente+1)."'  value = '".++$diacorrente."' onclick = "acao(this.value)">";
                    $id = "";
                    $day_scheduled = false;
                    for ($i = 0; $i < count($array_day); $i++) {
                        $date = date_create($array_day[$i]["agenda_date"]);
                        if (date_format($date, "d") == $diacorrente + 1 && date_format($date, "m") == $mes) {
                            $id .= $array_day[$i]["agenda_id"]."-";
                            $day_scheduled = true;
                        }
                    }
                    if ($day_scheduled) {
                        echo "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_agenda_multiple' class='btn_modal_multiple' id='".$id."'><div class='table_day_scheduled'>" . ++$diacorrente . "</div></a>";
                    } else {
                        echo "<a href='javascript:void(0);'><div class='table_day'>" . ++$diacorrente . "</div></a>";
                    }
                }
            } else {
                break;
            }

            /* FIM DO TRECHO MUITO IMPORTANTE */



            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

function MostreCalendarioCompleto()
{

    $cont = 1;
    for ($j = 0; $j < 4; $j++) {
        echo "<div class='container'>";
        echo "<div class='row'>";
        for ($i = 0; $i < 3; $i++) {


            MostreCalendario(($cont < 10) ? "0" . $cont : $cont);

            $cont++;
        }
        echo "</div>";
        echo "</div>";
    }
}

echo "<br/>";
MostreCalendario(date("m"));
?>
<div class="text-right">
    <button class="full_year btn btn-dark">
        Ver agenda anual &dArr;
    </button>
</div>
<hr>

<div class="view_full_year" style="display:none;">
    <?php
    MostreCalendarioCompleto();
    ?>
</div>