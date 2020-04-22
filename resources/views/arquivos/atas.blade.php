<?php 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <META http-equiv="X-UA-Compatible" content="IE=8">
        <TITLE>Atas - Marcação de Banca</TITLE>
        <META name="generator" content="BCL easyConverter SDK 5.0.140">
        <STYLE type="text/css">

            body {margin-top: 0px;margin-left: 0px;}

            #page_1 {position:relative; overflow: hidden;margin: 55px 0px 58px 80px;padding: 0px;border: none;width: 681px;}

            #page_1 #p1dimg1 {position:absolute;top:0px;left:0px;z-index:-1;width:203px;height:84px;}
            #page_1 #p1dimg1 #p1img1 {width:203px;height:84px;}




            .dclr {clear:both;float:none;height:1px;margin:0px;padding:0px;overflow:hidden;}

            .ft0{font: bold 13px 'Times New Roman';line-height: 15px;}
            .ft1{font: bold 16px 'Times New Roman';line-height: 19px;}
            .ft2{font: 16px 'Times New Roman';line-height: 19px;}
            .ft3{font: 16px 'Times New Roman';line-height: 18px;}
            .ft4{font: 1px 'Times New Roman';line-height: 1px;}

            .p0{text-align: left;padding-left: 230px;margin-top: 31px;margin-bottom: 0px;}
            .p1{text-align: left;padding-left: 257px;margin-top: 0px;margin-bottom: 0px;}
            .p2{text-align: left;padding-left: 79px;margin-top: 32px;margin-bottom: 0px;}
            .p3{text-align: left;padding-left: 167px;margin-top: 0px;margin-bottom: 0px;}
            .p4{text-align: left;padding-left: 121px;margin-top: 15px;margin-bottom: 0px;}
            .p5{text-align: left;padding-left: 56px;margin-top: 0px;margin-bottom: 0px;}
            .p6{text-align: left;margin-top: 15px;margin-bottom: 0px;}
            .p7{text-align: justify;padding-right: 113px;margin-top: 0px;margin-bottom: 0px;}
            .p8{text-align: justify;padding-right: 114px;margin-top: 4px;margin-bottom: 0px;}
            .p9{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
            .p10{text-align: center;padding-right: 3px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
            .p11{text-align: center;padding-left: 17px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
            .p12{text-align: left;margin-top: 55px;margin-bottom: 0px;}

            .td0{padding: 0px;margin: 0px;width: 283px;vertical-align: bottom;}
            .td1{padding: 0px;margin: 0px;width: 273px;vertical-align: bottom;}

            .tr0{height: 21px;}
            .tr1{height: 65px;}
            .tr2{height: 18px;}
            .tr3{height: 37px;}
            .tr4{height: 56px;}

            .t0{width: 556px;margin-top: 33px;font: 16px 'Times New Roman';}

        </STYLE>
    </HEAD>

    <?php
    foreach ($dados as $dado) {
    ?>
    <BODY>
        @foreach($dado->info as $row)
        <DIV id="page_1">
            <DIV id="p1dimg1">
                <IMG src="data:image/jpg;base64,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" id="p1img1"></DIV>


            <DIV class="dclr"></DIV>
            <P class="p0 ft0">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E</P>
            <P class="p1 ft0">TECNOLOGIA DO TRIÂNGULO MINEIRO</P>
            <P class="p2 ft1">ATA DA DEFESA DE TRABALHO DE CONCLUSÃO DE</P>
            <P class="p3 ft1">CURSO (TCC) - MONOGRAFIA</P>
            <P class="p4 ft1">ATA Nº {{ $row->numero }}/{{ $row->ano }} DE APRESENTAÇÃO DE TCC</P>
            <?php 
                mb_internal_encoding('UTF-8');
                $cursoUpper = mb_strtoupper($row->nomeCurso);
                
            ?>
            <P class="p5 ft1 text-uppercase text-center">CURSO DE <?= $cursoUpper ?></P>
            <P class="p6 ft2"></P>
            <P class="p7 ft3">Aos {{ date('d', strtotime( $row->dataHora )) }} dias do mês de {{strftime('%B', strtotime($row->dataHora))}} de {{ date('Y', strtotime( $row->dataHora )) }}, às {{ date('H:i', strtotime( $row->dataHora )) }}, na 
                Unidade Patrocínio do INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO TRIÂNGULO MINEIRO, 
            reuniu-se a Banca Avaliadora sob a presidência de {{ $row->nomeProfessor }} e com participação de 
            <?php 
                //GAMBIARRA TOPZERA kkkkkkkkkkkk
                $i = 0;
                $total = count($dado->avaliadores);
                $str = "";
                foreach ($dado->avaliadores as $row2){
                    $i++;
                    if ($i < $total){
                        $str = $str . $row2->nome . ", ";
                    }else{
                        $str = substr_replace($str, ' e ', -2);
                        $str = $str . $row2->nome;
                        echo $str;
                    }
                }
            ?>, para avaliar o 
            Trabalho de Conclusão de Curso @if ($row->sexo == 'm'){{ 'do estudante '.$row->nomeAluno }}@else{{ 'da estudante '.$row->nomeAluno }}@endif, apresentado como requisito 
            obrigatório para a conclusão do curso de {{ $row->nomeCurso }}, 
            de acordo com o Projeto Pedagógico de Curso – PPC ({{ $row->ppcCurso }}). 
            O presente trabalho tem como título: {{$row->titulo}}, 
            desenvolvido sob a orientação do(a) professor(a) {{ $row->nomeProfessor }}. Após a avaliação pela banca, 
            @if ($row->sexo == 'm'){{ 'o' }}@else{{ 'a' }}@endif estudante foi @if ($row->sexo == 'm'){{ 'considerado' }}@else{{ 'considerada' }}@endif _____________. Para registro, eu, {{ $row->nomeProfessor }}, lavrei a presente Ata que, 
            depois de lida e aprovada, será assinada por mim e pelos demais membros da Banca Avaliadora.</P>
        <TABLE cellpadding=0 cellspacing=0 class="t0">
            <TR>
                <TD class="tr0 td0"><P class="p9 ft2">Patrocínio, {{ date('d', strtotime( $row->dataHora )) }} de {{strftime('%B', strtotime($row->dataHora))}} de {{ date('Y', strtotime( $row->dataHora )) }}</P></TD>
                <TD class="tr0 td1"><P class="p9 ft4">&nbsp;</P></TD>
            </TR>
            <TR>
                <TD class="tr1 td0">
                    <P class="p10 ft2">________________________________</P>
                    <P class="p10 ft3">{{ $row->nomeProfessor }}</P>
                </TD>
                <TD class="tr1 td1">
                    <P class="p11 ft2">________________________________</P>
                    <P class="p11 ft3"><?= $dado->avaliadores[0]->nome ?></P>
                </TD>
            </TR>
            <TR>
            <?php
            //foreach para rodar nos outros avaliadores
                foreach ($dado->avaliadores as $row3){
                    
                    if (isset($dado->avaliadores[3]->nome)){//duas validacao 
                        if ($row3->nome == $dado->avaliadores[3]->nome){
                            break;
                        }
                    }
                    if (isset($dado->avaliadores[4]->nome)){//duas validacao 
                        if ($row3->nome == $dado->avaliadores[4]->nome){
                            break;
                        }
                    }
                    
                    if ($row3->nome <> $dado->avaliadores[0]->nome){
                        if ($row3->nome == $dado->avaliadores[1]->nome){
            ?>
                <TD class="tr1 td0">
                    <P class="p10 ft2">________________________________</P>
                    <P class="p10 ft3"><?= $row3->nome ?></P>
                </TD>
            <?php
                        }
                        if (isset($dado->avaliadores[2]->nome)){
                            if ($row3->nome == $dado->avaliadores[2]->nome){
            ?>
                <TD class="tr1 td0">
                    <P class="p11 ft2">________________________________</P>
                    <P class="p11 ft3"><?= $row3->nome ?></P>
                </TD>
            <?php
                            }
                        }
                    }
                }
            ?>
            </TR>
            <?php 
                if (isset($dado->avaliadores[3]->nome)){
            ?>
            <TR>
                
                <TD class="tr1 td0">
                    <P class="p10 ft2">________________________________</P>
                    <P class="p10 ft3">{{ $dado->avaliadores[3]->nome }}</P>
                </TD>

                <?php 
                    if (isset($dado->avaliadores[4]->nome)){
                ?>
                <TD class="tr1 td1">
                    <P class="p11 ft2">________________________________</P>
                    <P class="p11 ft3"><?= $dado->avaliadores[4]->nome ?></P>
                </TD>
                <?php 
                    }
                ?>
            </TR>
            <?php 
                }
            ?>
            <TR>
                <TD class="tr4 td0"><P class="p9 ft2">Observações:</P></TD>
                <TD class="tr4 td1"><P class="p9 ft4">&nbsp;</P></TD>
            </TR>
        </TABLE>
        <P class="p12 ft2">Nota: _____________ Conceito: ____________________</P>
    </DIV>
    <DIV style="display: none;padding: 50px 0px 15px 20px; font-family: Arial, Helvetica, sans-serif; font-size: 8px; color: #c8c8c8;">
        <P><A href="https://www.pdfonline.com/convert-pdf/" style="color: #c8c8c8; text-decoration: none;">Convertir Word a PDF</A> Converted By BCLTechnologies</P>
    </DIV>
        @endforeach
</BODY>
<?php 
    }
    ?>
</HTML>
