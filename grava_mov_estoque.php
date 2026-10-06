<?php

    date_default_timezone_set('America/Sao_Paulo');

    $cod_produto     = trim($_POST['cod_produto'] ?? '');
    $acao_estoque    = trim($_POST['acao_estoque'] ?? '');
    $entrada_produto = isset($_POST['entrada_produto']) ? (int) $_POST['entrada_produto'] : 0;
    $saida_produto   = isset($_POST['saida_produto']) ? (int) $_POST['saida_produto'] : 0;

    $caminho = __DIR__ . '/dados_vh.json';

    $conteudoJson = file_get_contents($caminho);

    $dados = json_decode($conteudoJson, true);

    if(!is_array($dados)){
        echo "Erro ao ler o arquivo JSON!";
        exit;
    }

    $uniq_id = uniqid();

    $produto_encontrado = false;

    foreach($dados['estoque'] as &$produto){

        if($produto['codigoProduto'] == $cod_produto){

            $produto_encontrado = true;

            $estoque_anterior = (int) $produto['estoque'];

            if($acao_estoque == "Entrada"){

                $quantidade_movimentada = $entrada_produto;

                $descricao_movimentacao = "Entrada de produto no estoque";

                $produto['estoque'] = $produto['estoque'] + $entrada_produto;

            }else if($acao_estoque == "Saida"){

                if($saida_produto > $produto['estoque']){
                    echo "Quantidade de saída maior que o estoque disponível!";
                    exit;
                }

                $quantidade_movimentada = $saida_produto;

                $descricao_movimentacao = "Saída de produto do estoque";

                $produto['estoque'] = $produto['estoque'] - $saida_produto;

            }

            $estoque_final = $produto['estoque'];

            $descricao_produto = $produto['descricaoProduto'];

            break;

        }

    }

    unset($produto);

    if($produto_encontrado == false){

        echo "Produto não encontrado!";
        exit;

    }

    $dados['log_mov'][] = [
        "uniq_id" => $uniq_id,
        "codigoProduto" => (int) $cod_produto,
        "descricaoProduto" => $descricao_produto,
        "tipoMovimentacao" => $acao_estoque,
        "descricaoMovimentacao" => $descricao_movimentacao,
        "quantidadeMovimentada" => $quantidade_movimentada,
        "estoqueAnterior" => $estoque_anterior,
        "estoqueFinal" => $estoque_final,
        "dataMovimentacao" => date("d/m/Y H:i:s")
    ];

    $novoJson = json_encode($dados,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    $gravou = file_put_contents($caminho, $novoJson, LOCK_EX);

    if($gravou === false){
        echo "Erro ao gravar o arquivo JSON!";
        exit;
    }

    header("Location: movimentacao_estoque.php");
    exit;

?>