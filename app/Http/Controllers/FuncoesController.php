<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;

class FuncoesController extends Controller {

    static function enviarEmail($destinatario, $processo) { //pegando destinatario e qual tipo do email a enviar
        switch ($processo) {
            case 1: //enviar documentacao de formalizacao
                //pegando email do aluno
                $formalizacao = DB::table('formalizacao')
                        ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                        ->where('aluno.idAluno', '=', $destinatario)
                        ->select('formalizacao.*', 'aluno.nome as nomeAluno', 'aluno.email as emailAluno', 'aluno.*')
                        ->get();

                $emailDestinatario = $formalizacao[0]->emailAluno;
                $nomeDestinatario = $formalizacao[0]->nomeAluno;
//                $emailDestinatario = "emersong730@gmail.com";
//                $nomeDestinatario = "Emerson Gabriel";

                $mail = new PHPMailer(); // create a n
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP(); // Define que o e-mail será no protocol SMTP
                $mail->Host = "mail.pwlunar.com"; //endereço do servidor

                $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
                $mail->Username = 'email@pwlunar.com'; // Usuário do servidor SMTP
//    $mail->Username = 'noreply@pwlunar.com'; // Usuário do servidor SMTP
                $mail->Password = 'D01sdvp14'; // Senha do servidor SMTP
                //  REMETENTE =====
                $mail->From = "email@pwlunar.com"; // Seu e-mail
                $mail->FromName = "TECWEBC"; // Seu nome       
                $mail->Port = 587; //porta smtp

//                echo getcwd() . '<br>';
//                echo dirname(__FILE__) . '<br>';
//                echo basename(__DIR__) . '<br>';   
//                $mail->addAttachment("uploads/"."teste.pdf");
                $mail->addAttachment("uploads/Documentos/Formalizacao/"."apendiceB.pdf");

                $nome = $formalizacao[0]->nomeAluno;
                $titulo = $formalizacao[0]->titulo;
                $telefone = $formalizacao[0]->telefone;
                $cpf = $formalizacao[0]->cpf;
                $menssagem = "Confirme seus dados enviados neste e-mail.";
                $data = date('d/m/Y');
                $hora = date('H:i:s');

                $mail->IsHTML(true);

                $mail->AddAddress($emailDestinatario, $nomeDestinatario);

                $mail->Subject = "Contato de teste pelo TECWEBC"; // assunto da mensagem
                $mail->Body = "
                                    <!DOCTYPE html>
                                            <html lang='pt-br'>
                                                <head>
                                                    <meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
                                                    <style>                
                                                        table {font-family: arial, sans-serif;border-collapse: collapse}td, th {text-align: left;padding: 8px;}tr:nth-child(even) {background-color: #dddddd;}
                                                    </style>
                                                </head>
                                                <body style='margin: 20px 0'>
                                                <p>
                                                Preencha os documentos anexados neste e-mail e encaminhe até a direção.
                                                </p>
                                                    <table>
                                                        <tbody>                 
                                                            <tr>
                                                                <td colspan='2' style='text-align: center' >
                                                                    <img alt='' height='100' src='---------'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Nome</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $nome . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Telefone</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $telefone . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Título</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $titulo . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>CPF</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $cpf . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Mensagem</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $menssagem . "</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <p style='color: #737478;font-size: 12px'>Enviado às " . $hora . ", " . $data . "</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </body>
                                            </html>";
                $enviado = $mail->Send(); // enviando email

                $mail->ClearAllRecipients();
                $mail->ClearAttachments();

                if ($enviado = 1) {
                    return "1";
                } else {
                    return "0";
                }

                break;
            case 2:
                
                //pegando email do aluno
                $formalizacao = DB::table('formalizacao')
                        ->join('aluno', 'formalizacao.idAluno', '=', 'aluno.idAluno')
                        ->where('formalizacao.idFormalizacao', '=', $destinatario)
                        ->select('formalizacao.*', 'aluno.nome as nomeAluno', 'aluno.email as emailAluno', 'aluno.*')
                        ->get();

                $emailDestinatario = $formalizacao[0]->emailAluno;
                $nomeDestinatario = $formalizacao[0]->nomeAluno;
                echo $emailDestinatario;
                echo $nomeDestinatario;
//                $emailDestinatario = "emersong730@gmail.com";
//                $nomeDestinatario = "Emerson Gabriel";

                $mail = new PHPMailer(); // create a n
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP(); // Define que o e-mail será no protocol SMTP
                $mail->Host = "mail.pwlunar.com"; //endereço do servidor

                $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
                $mail->Username = 'email@pwlunar.com'; // Usuário do servidor SMTP
//    $mail->Username = 'noreply@pwlunar.com'; // Usuário do servidor SMTP
                $mail->Password = 'D01sdvp14'; // Senha do servidor SMTP
                //  REMETENTE =====
                $mail->From = "email@pwlunar.com"; // Seu e-mail
                $mail->FromName = "TECWEBC"; // Seu nome       
                $mail->Port = 587; //porta smtp

//                echo getcwd() . '<br>';
//                echo dirname(__FILE__) . '<br>';
//                echo basename(__DIR__) . '<br>';   
//                $mail->addAttachment("uploads/"."teste.pdf");
                $mail->addAttachment("uploads/Documentos/RelatorioFrequenciaAtividade/"."apendiceG.pdf");
                $mail->addAttachment("uploads/Documentos/TermoResponsabilidade/"."apendiceC.pdf");

                $nome = $formalizacao[0]->nomeAluno;
                $titulo = $formalizacao[0]->titulo;
                $telefone = $formalizacao[0]->telefone;
                $cpf = $formalizacao[0]->cpf;
                $menssagem = "Confirme seus dados enviados neste e-mail.";
                
                $data = date('d/m/Y');
                $hora = date('H:i:s');

                $mail->IsHTML(true);

                $mail->AddAddress($emailDestinatario, $nomeDestinatario);

                $mail->Subject = "Arquivos referente a marcação de banca - TECWEBC"; // assunto da mensagem
                $mail->Body = "
                                    <!DOCTYPE html>
                                            <html lang='pt-br'>
                                                <head>
                                                    <meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>
                                                    <style>                
                                                        table {font-family: arial, sans-serif;border-collapse: collapse}td, th {text-align: left;padding: 8px;}tr:nth-child(even) {background-color: #dddddd;}
                                                    </style>
                                                </head>
                                                <body style='margin: 20px 0'>
                                                <p>
                                                Preencha os documentos anexados neste e-mail e encaminhe até a direção.
                                                </p>
                                                    <table>
                                                        <tbody>                 
                                                            <tr>
                                                                <td colspan='2' style='text-align: center' >
                                                                    <img alt='' height='100' src='---------'>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Nome</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $nome . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Telefone</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $telefone . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Título</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $titulo . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Telefone</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $telefone . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='border: 1px solid #dddddd;width: 100px;'>Mensagem</td>
                                                                <td style='border: 1px solid #dddddd;width: 200px;'>" . $menssagem . "</td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <p style='color: #737478;font-size: 12px'>Enviado às " . $hora . ", " . $data . "</p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </body>
                                            </html>";
                $enviado = $mail->Send(); // enviando email

                $mail->ClearAllRecipients();
                $mail->ClearAttachments();

                if ($enviado = 1) {
//                    return "1";
                } else {
//                    return "0";
                }
                
                break;
            case 3:
                echo "outro processo 3";
                break;
        }
    }

}
