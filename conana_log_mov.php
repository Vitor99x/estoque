<?php 


    date_default_timezone_set('America/Sao_Paulo');

    // Mantem compatibilidade com o servidor original e permite rodar localmente.
    if(file_exists("../seguranca_acentuacao.php")){
        require_once("../seguranca_acentuacao.php");
    }

    if(file_exists("../verifica.php")){
        require_once("../verifica.php");
    }

    $caminho = __DIR__ . '/dados_vh.json';

    $conteudoJson = file_get_contents($caminho);

    $dados = json_decode($conteudoJson, true);
    
?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
       
        <meta name="description" content="" />
        <meta name="viewport"    content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />  
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../assets/font-awesome/6.2/css/all.min.css"/>
        <link rel="stylesheet" href="../assets/font-awesome/5.0/css/all.min.css"/>
        <link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" /> 
        <link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" /> 
        <link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />     
        <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../assets/css/jquery-ui.min.css" />   
        <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="../assets/css/fixedColumns.dataTables.min.css"/>
        <link rel="stylesheet" href="../assets/css/buttons.dataTables.min.css"/>     
        <script src="../assets/js/ace-extra.min.js"></script>     
        <script src="../assets/js/jquery-1.12.4.js"> </script>    
        <script type="text/javascript" language="javascript" src="../assets/js/jquery.dataTables.min.js">
        </script> 

        <!-- Fallbacks para ambiente local. Os links originais foram mantidos. -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    </head>

    <body class="no-skin">

        <div class="loader" id="loader" style="position: absolute; top: 149px; width: 100%; height: calc(100% - 223px); display: block; z-index:9999999; background-image:url('/pastao/img/ajax-loader.gif'); background-repeat: no-repeat; background-position: center center;"> </div>

        <div class="main-container ace-save-state" id="main-container">

            <div class="page-content">
                <!-- INICIO VISÃO GERAL (PAINEL) -->
                <div class="row">

                    <div id ="table_mostra" style="display:none" class="table-responsive">

                        <table id="consulta" class="table table-striped table-bordered table-hover table-condensed">
                            
                            <thead>
                                <tr>
                                    <th>Identificador</th>
                                    <th>Código Produto</th>
                                    <th>Produto</th>
                                    <th>Movimentação</th>
                                    <th>Quantidade</th>
                                    <th>Estoque Anterior</th>
                                    <th>Estoque Final</th>
                                    <th>Data</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                    foreach($dados['log_mov'] as $log){

                                        $uniq_id                 = trim($log['uniq_id']);
                                        $codigo_produto          = trim($log['codigoProduto']);
                                        $descricao_produto       = trim($log['descricaoProduto']);
                                        $tipo_movimentacao       = trim($log['tipoMovimentacao']);
                                        $quantidade_movimentada  = trim($log['quantidadeMovimentada']);
                                        $estoque_anterior        = trim($log['estoqueAnterior']);
                                        $estoque_final           = trim($log['estoqueFinal']);
                                        $data_movimentacao       = trim($log['dataMovimentacao']);

                                ?>

                                        <tr>

                                            <td><?php echo $uniq_id; ?></td>

                                            <td><?php echo $codigo_produto; ?></td>

                                            <td><?php echo $descricao_produto; ?></td>

                                            <td><?php echo $tipo_movimentacao; ?></td>

                                            <td><?php echo $quantidade_movimentada; ?></td>

                                            <td><?php echo $estoque_anterior; ?></td>

                                            <td><?php echo $estoque_final; ?></td>

                                            <td><?php echo $data_movimentacao; ?></td>

                                        </tr>

                                <?php

                                    }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div><!-- FINAL PAINEL -->
            </div><!-- /.page-content -->
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="../assets/js/bootstrap.min.js"></script> 
    <script src="../assets/js/ace-elements.min.js"></script>
    <script src="../assets/js/ace.min.js"></script>

    <script>

        $(document).ready(function(){
            $('#table_mostra').fadeIn('slow', function(){
                $('#table_mostra').delay(5000).fadeIn(); 
            });

            $('div.loader').fadeOut();
        });
            
    </script>
 
    <!-- DATATABLE COM FILTRO PARA PESQUISA -->
    <script type="text/javascript" class="init">
            $(document).ready(function() {

                $('#consulta').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                                    
                    'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                    ],
                    "iDisplayLength": 5,
                    "order": [[ 1, "asc" ]],
                    "bProcessing": true,
                    "bInfo": true,
                    "bLengthChange": false,
                    "oLanguage": {
                        "sProcessing": "Processando...",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix":  "",
                        "sSearch":       "Procurar:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "Primeiro",
                            "sPrevious": "Anterior",
                            "sNext":     "Próximo",
                            "sLast":     "Ùltimo"
                        }
                    }
                })
            });
    </script>

    <script>
       
        function selecionarRegistro(uniq_id){

            window.opener.document.location.href = "cad_assinantes.php?uniq_id=" + uniq_id;
            window.close();

        }

        $("span[id^=cod_] i").on('mouseover', function(){
                $(this).removeClass("fa-circle");
                $(this).addClass("fa-check-circle");
        }).on('mouseout', function(){
            $(this).removeClass("fa-check-circle"); 
            $(this).addClass("fa-circle");
        });

    </script> 

    <script src="../assets/js/jquery-1.12.4.js"> </script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"> </script>
    <script src="../assets/js/dataTables.buttons.min.js"> </script>
    <script src="../assets/js/buttons.flash.min.js"> </script>
    <script src="../assets/js/jszip.min.js"> </script>
    <script src="../assets/js/pdfmake.min.js"> </script>
    <script src="../assets/js/buttons.html5.min.js"> </script>
    <script src="../assets/js/vfs_fonts.js"> </script>
    <script src="../assets/js/buttons.print.min.js"> </script>
    <script src="../assets/js/bootstrap.min.js"></script>

    </body>
</html>
