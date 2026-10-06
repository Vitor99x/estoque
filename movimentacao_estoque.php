<?php

    date_default_timezone_set('America/Sao_Paulo');

    // Mantem compatibilidade com o servidor original e permite rodar localmente.
    if(file_exists("../seguranca_acentuacao.php")){
        require_once("../seguranca_acentuacao.php");
    }

    if(file_exists("../verifica.php")){
        require_once("../verifica.php");
    }

    $data_id = date("dmY");                                    
    $hora_id = date("His");

    $id_unico = uniqid();
    $uniq_id = $id_unico . $data_id . $hora_id;

    // 1. Lê o conteúdo do arquivo JSON como uma string
    $caminho = __DIR__ . '/dados_vh.json';
    $conteudoJson = file_get_contents($caminho);

    // 2. Converte a string JSON em um array associativo do PHP (usando true)
    $dados = json_decode($conteudoJson, true);

    $entrada_produto = '';
    $saida_produto   = '';
    

?>

<!DOCTYPE html>

<html lang="en" style="background-color: white;">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title> Registro Eletrônico - Transcontinental </title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../img/Logo_cinza.png">
        <link rel="stylesheet" href="css/novo_template/vendor/owl-carousel/css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/novo_template/vendor/owl-carousel/css/owl.theme.default.min.css">
        <link href="css/novo_template/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
        <link href="css/novo_template/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/font-awesome/6.2/css/all.min.css"/>
        <link rel="stylesheet" href="../assets/font-awesome/5.0/css/all.min.css"/>
        <link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- Fallbacks para ambiente local. Os links originais acima foram mantidos. -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <style>

            .form-control {
                background: #fff;
                border: 1px solid #bbbbbb;
                color: #454545;
            }

            .nav-header .brand-title {
                margin-left: 2px;
                max-width: 180px;
            }

            .nav-header .logo-abbr {
                max-width: 40px;
            }

            .iframe {
                position: relative;
                width: 100%;
                overflow: hidden;
                padding-top: 100%; /* 1:1 Aspect Ratio */
            }

            .responsive-iframe {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                width: 100%;
                height: 100%;
                border: none;
            }

            .input-field label {
                -webkit-transform: translateY(-14px) scale(0.8);
                transform: translateY(-14px) scale(0.8);
                -webkit-transform-origin: 0 0;
                transform-origin: 0 0;
            }

            .iframe {
                position: relative;
                width: 100%;
                overflow: hidden;
                padding-top: 100%; /* 1:1 Aspect Ratio */
            }

            .responsive-iframe {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                width: 100%;
                height: 100%;
                border: none;
            }

            .modal-header {
                display: flex;
                padding: 1rem 1rem;
                border-bottom: 1px solid #EEEEEE;
                border-top-left-radius: 0.3rem;
                border-top-right-radius: 0.3rem;
                flex-direction: column;
                align-content: center;
                justify-content: center;
                flex-wrap: wrap;
                align-items: center;
            }

        </style>
    
    </head>

    <body style="color: black;">
        <div id="main-wrapper">         
            <div class="content-body"style="padding-top: 15px; margin-left: 0px; background-color: white;">
                <div class="container-fluid">

                    <div class="form-validation">
                        <form autocomplete="off" class="form-valide" action="" method="post" novalidate="novalidate" id="formPrincipal" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <div class="row">

                                                    <label class="col-md-2 col-form-label"  style="padding-left: 15px; padding-right: 15px;">
                                                        <b style="color: black;"> Código </b> 
                                                    </label>
                                                    <div class="col-lg-1">
                                                        <input type="text" class="form-control" id="codigo" name="codigo" readonly>
                                                    </div>

                                                    <i class="fa-solid fa-magnifying-glass" style="color: #0000FF; padding-top: 10px; cursor: pointer; margin-right: 10px;" title="Buscar" onclick="abrirBusca()"></i>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">

                                                    <label class="col-md-2 col-form-label"  style="padding-left: 15px; padding-right: 15px;">
                                                        <b style="color: black;"> Produto </b> 
                                                    </label>

                                                
                                                    <div class="col-lg-2">
                                                        <select class="form-control" id="cod_produto" name="cod_produto">
                                                            <option value=""> Selecione... </option>
                                                            <?php
                                                                // Percorre as vendas lidas do JSON.
                                                                foreach ($dados["estoque"] as $estoque) {
                                                            ?>
                                                                <option value="<?php echo $estoque["codigoProduto"]; ?>"> 
                                                                    <?php echo $estoque["descricaoProduto"]; ?>
                                                                </option>

                                                            <?php
                                                                }
                                                            ?>
                                                        </select> 
                                                    </div>
                                      
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-md-2 col-form-label"  style="padding-left: 15px; padding-right: 15px;">
                                                        <b style="color: black;"> Ação</b> 
                                                    </label>
                                                    <div class="col-lg-2">
                                                        <select class="form-control" id="acao_estoque" name="acao_estoque">
                                                            <option value=""> Selecione... </option>
                                                            <option value="Entrada"> Entrada Estoque </option>
                                                            <option value="Saida"> Saida Estoque </option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group" id="div_entrada_produto" style="display:none;">
                                                <div class="row">

                                                    <label class="col-md-2 col-form-label"  style="padding-left: 15px; padding-right: 15px;">
                                                        <b style="color: black;"> Entrada </b> 
                                                    </label>
                                                    <div class="col-lg-2">
                                                        <input type="number" class="form-control" id="entrada_produto" name="entrada_produto" value="<?php echo $entrada_produto; ?>">
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" id="div_saida_produto" style="display:none;">
                                                <div class="row">

                                                    <label class="col-md-2 col-form-label"  style="padding-left: 15px; padding-right: 15px;">
                                                        <b style="color: black;"> Saída </b> 
                                                    </label>
                                                    <div class="col-lg-2">
                                                        <input type="number" class="form-control" id="saida_produto" name="saida_produto" value="<?php echo $saida_produto; ?>">
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- FINAL DO PRIMEIRO QUADRANTE DE INFORMAÇÕES --> 

                            <div id="div_botoes" class="row">
                                <div class="col-lg-12">
                                    <div class="row">
            
                                        <div style="width: 15px;"> </div>

                                        <button type="button" class="btn btn-rounded btn-success" onclick="BotaoSalvar()" style="background-color: #1abf90; border-color: #1abf90;">
        
                                            <i class="fas fa-save"></i> &nbsp; Salvar
        
                                        </button>
        
                                        <div style="width: 15px;"> </div>
        

                                    </div>
                                </div>
                            </div>

                            <!-- Modal - Confirmar o Salvamento -->
                            <div class="modal fade" id="modal_salvar" style="margin-top: 200px;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div style="background-color: #f5f5f5; text-align: center;" class="modal-header"> 
                                            <h5 class="modal-title" style="font-size: 18px;"> <i class="fas fa-check" style="color: green;"></i> &nbsp; Os campos foram validados! </h5>
                                        </div>
                                        <div class="modal-body" style="padding-bottom: 0px;">
                                            <div style="font-size: 16px;">
                                                Você deseja salvar as informações?
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="enviarFormularioFinalizacao()">Sim</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Required vendors -->
        <script src="css/novo_template/vendor/global/global.min.js"></script>
        <script src="css/novo_template/js/quixnav-init.js"></script>
        <script src="css/novo_template/js/custom.min.js"></script>

        <!-- Vectormap -->
        <script src="css/novo_template/vendor/raphael/raphael.min.js"></script>
        <script src="css/novo_template/vendor/morris/morris.min.js"></script>
        <script src="css/novo_template/vendor/circle-progress/circle-progress.min.js"></script>
        <script src="css/novo_template/vendor/chart.js/Chart.bundle.min.js"></script>
        <script src="css/novo_template/vendor/gaugeJS/dist/gauge.min.js"></script>

        <!--  flot-chart js -->
        <script src="css/novo_template/vendor/flot/jquery.flot.js"></script>
        <script src="css/novo_template/vendor/flot/jquery.flot.resize.js"></script>

        <!-- Owl Carousel -->
        <script src="css/novo_template/vendor/owl-carousel/js/owl.carousel.min.js"></script>

        <!-- Counter Up -->
        <script src="css/novo_template/vendor/jqvmap/js/jquery.vmap.min.js"></script>
        <script src="css/novo_template/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
        <script src="css/novo_template/vendor/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="css/novo_template/js/dashboard/dashboard-1.js"></script>

        <!-- Máscara -->
        <script src="../assets/js/jquery.mask.js"></script>

        <!-- Fallbacks para ambiente local. Mantem os scripts originais. -->
        <script>
            if (typeof window.jQuery === 'undefined') {
                document.write('<script src="https://code.jquery.com/jquery-3.7.1.min.js"><\/script>');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
    
            function BotaoNovo(){

                window.location.href = "cad_assinantes.php";

            }
            
            function BotaoSalvar(){

                var cod_produto  = document.getElementById("cod_produto").value;
                var acao_estoque = document.getElementById("acao_estoque").value;

                if (cod_produto == ""){
                    alert("Preencher o campo do Produto!");
                    return;
                }

                if (acao_estoque == ""){
                    alert("Preencher o tipo de Ação!");
                    return;
                }

                if (acao_estoque == "Entrada"){

                    var entrada_produto = document.getElementById("entrada_produto").value;

                    if(entrada_produto == ""){
                        alert("Preencher quantidade de Entrada do Produto!");
                        return;
                    }

                }

                if (acao_estoque == "Saida"){

                    var saida_produto = document.getElementById("saida_produto").value;

                    if(saida_produto == ""){
                        alert("Preencher quantidade de Saida do Produto!");
                        return;
                    }

                }

                $("#modal_salvar").modal("show");

            }
            
            function enviarFormularioFinalizacao(){

                document.getElementById("formPrincipal").action = "grava_mov_estoque.php";
                document.getElementById("formPrincipal").submit();
                
            }

            function abrirBusca() { 

                popup = window.open("conana_log_mov.php","","width=1000,height=500,left=" + (screen.width - 1000) / 2 + ",top=" + (screen.height - 500) / 2);
            
            }

            $(document).ready(function(){

                // CONVERSÃO DAS VARIAVEIS DE PHP PARA JAVASCRIPT

                
                // if(codigo != ""){

                //     document.getElementById("codigo").value = codigo;

                // }

                // if(tipo_assin != ""){

                //     document.getElementById("tipo_assinatura").value = tipo_assin;

                // }

                // if(email != ""){

                //     document.getElementById("email").value = email;

                // }

                // if(cpf != ""){

                //     document.getElementById("cpf").value = cpf;

                // }

                // if(ativo_sn != ""){

                //     document.getElementById("ativo_sn").value = ativo_sn;

                // }

                // if(assina_sn != ""){

                //     document.getElementById("assina_sn").value = assina_sn;

                // }

                // if(assina_xml != ""){

                //     document.getElementById("assina_xml").value = assina_xml;

                // }

            });

            $("#acao_estoque").on("change", function() {

                var acao_estoque = $(this).val();

                if(acao_estoque == "Entrada"){

                    $("#div_entrada_produto").css("display","");
                    $("#div_saida_produto").css("display","none");
                    document.getElementById("saida_produto").value = "";

                }else if(acao_estoque == "Saida"){

                    $("#div_saida_produto").css("display","");
                    $("#div_entrada_produto").css("display","none");
                    document.getElementById("entrada_produto").value = "";

                }else{

                    $("#div_saida_produto").css("display","none");
                    $("#div_entrada_produto").css("display","none");
                    document.getElementById("entrada_produto").value = "";
                    document.getElementById("saida_produto").value = "";

                }

            });

        </script>

    </body>

</html>