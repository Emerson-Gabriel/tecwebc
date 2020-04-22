<?php
function UrlAtual() {
    $parte = $_SERVER['HTTP_HOST'];
    return $url = "http://" . $parte . $_SERVER['REQUEST_URI'];
}
function formataDataCalendario($dataAtual) { //funcao para inicializar o calendario de acordo com o mes atual
    //como o plugin do calendar tem a seguinde sequencia 2017-06 tenho que tratar
    return substr($dataAtual, 6, 6) . "-" . substr($dataAtual, 3, 2);
}
function formataDataHoje($dataAtual) { //função para mostrar o dia de hoje marcado no calendario
    //como o plugin do calendar tem a seguinde sequencia 2017-06 tenho que tratar
    return $diaCalendar = substr($dataAtual, 6, 6) . "-" . substr($dataAtual, 3, 2) . "-" . substr($dataAtual, 0, 2); //tratar o dia atual para 2017-07-15  
}
//funcao para tratar o mes do plugin js 
function mes_abreviado($mes_noticia){
    switch ($mes_noticia) {
        case "01": $mes_pt = "Jan";break;
        case "02": $mes_pt = "Fev";break;
        case "03": $mes_pt = "Mar";break;
        case "04": $mes_pt = "Abr";break;
        case "05": $mes_pt = "Mai";break;
        case "06": $mes_pt = "Jun";break;
        case "07": $mes_pt = "Jul";break;
        case "08": $mes_pt = "Ago";break;
        case "09": $mes_pt = "Set";break;
        case "10": $mes_pt = "Out";break;
        case "11": $mes_pt = "Nov";break;
        case "12": $mes_pt = "Dez";break;
    }
    return $mes_pt;
}
function mes_extenso($mes){
    switch ($mes) {
        case "01": $mes_ext = "Janeiro";break;
        case "02": $mes_ext = "Fevereiro";break;
        case "03": $mes_ext = "Março";break;
        case "04": $mes_ext = "Abril";break;
        case "05": $mes_ext = "Maio";break;
        case "06": $mes_ext = "Junho";break;
        case "07": $mes_ext = "Julho";break;
        case "08": $mes_ext = "Agosto";break;
        case "09": $mes_ext = "Setembro";break;
        case "10": $mes_ext = "Outubro";break;
        case "11": $mes_ext = "Novembro";break;
        case "12": $mes_ext = "Dezembro";break;
    }
    return $mes_ext;
}
function formata_titulo($titulo){
    return strtolower(preg_replace("[^a-zA-Z0-9-]", "-", strtr(utf8_decode(trim(preg_replace('/[ -]+/', '-', utf8_encode($titulo)))), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));
}