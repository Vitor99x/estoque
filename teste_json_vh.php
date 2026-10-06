<?php
    // 1. Lê o conteúdo do arquivo JSON como uma string
    $caminho = __DIR__ . '/dados_vh.json';
    $conteudoJson = file_get_contents($caminho);

    // 2. Converte a string JSON em um array associativo do PHP (usando true)
    $dados = json_decode($conteudoJson, true);


   // Percorre as vendas lidas do JSON.
    foreach ($dados["vendas"] as $venda) {

        if (!is_array($venda) || !isset($venda["vendedor"], $venda["valor"]) || !is_string($venda["vendedor"]) || !is_numeric($venda["valor"])) {

            exit("Existe uma venda com vendedor ou valor inválido.");

        }

        $vendedor = htmlspecialchars($venda["vendedor"], ENT_QUOTES, "UTF-8");

        $valor    = number_format((float) $venda["valor"], 2, ",", ".");

        if($venda['valor'] < '100' && $venda['valor'] >= '0'){

            echo "Sem comissao - " . "Valor: " . $venda['valor'] . " Vendedor: " . $vendedor . "<br>";
            echo "-----------------------------------------------------------------------------------";
            echo "<br>";


        }else if($venda['valor'] >= '100' && $venda['valor'] <'500'){

            $comissao_recebida  = $venda['valor'] * 0.01;
            $valor_com_acrescimo = $venda['valor'] + $comissao_recebida;

            echo "Valor de 1% sendo aplicado na comissão <br>";
            echo "Venda realizada: R$" . $venda['valor'] .  "<br>";
            echo "Comissao de 1% recebida para o Vendedor: $vendedor total de: $valor_com_acrescimo <br>";
            echo "-----------------------------------------------------------------------------------";
            echo "<br>";


        }else{

            $comissao_recebida  = $venda['valor'] * 0.05;
            $valor_com_acrescimo = $venda['valor'] + $comissao_recebida;

            echo "Valor de 5% sendo aplicado na comissão <br>";
            echo "Venda realizada: R$" . $venda['valor'] .  "<br>";
            echo "Comissao de 5% recebida para o Vendedor: $vendedor total de: $valor_com_acrescimo <br>";
            echo "-----------------------------------------------------------------------------------";
            echo "<br>";

        }



    }
?>