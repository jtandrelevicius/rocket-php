<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressao</title>
</head>
<body>
<?php if(isset($styles)):   ?>

<?php  foreach ($styles as $style): ?>

 <link href="<?php echo base_url('/'. $style)?>" rel="stylesheet"/>

<?php   endforeach; ?>

<?php endif;   ?>

<table class="printer-ticket">
                 <thead>
                    <tr>
                        <th class="title" colspan="3"><?php echo $empresa->empresa_nome_fantasia ?></th>
                    </tr>
                    <tr>
                        <th colspan="3"><?php echo formata_data_banco_com_hora($venda->venda_data_emissao) ?></th>
                    </tr>
                    <tr>
                        <th colspan="3">
                            <?php echo $venda->cliente_nome ?> <br />
                            <?php echo $venda->cliente_telefone ?>
                        </th>
                    </tr>
                    <tr>
                        <th class="ttu" colspan="3">
                            <b>Cupom não fiscal</b>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($produto as $produto) : ?>
                    <tr class="top">
                        <td colspan="3"><?php echo $produto->produto_descricao?></td>
                    </tr>
                    <tr>
                        <td><?php echo 'R$&nbsp;' . $produto->venda_produto_valor_unitario ?></td>
                        <td><?php echo $produto->venda_produto_quantidade?></td>
                        <td><?php echo 'R$&nbsp;' .$produto->venda_produto_valor_total?></td>
                    </tr>
                    <?php endforeach; ?>  
                </tbody>

                <tfoot>
                    <tr class="sup ttu p--0">
                        <td colspan="3">
                            <b>Totais</b>
                        </td>
                    </tr>
                
                    <tr class="ttu">
                        <td colspan="2">Desconto</td>
                        <td align="right"><?php echo  $venda->venda_valor_desconto?></td>
                    </tr>
                    <tr class="ttu">
                        <td colspan="2">Total</td>
                        <td align="right"><?php echo 'R$&nbsp;' . $venda->venda_valor_total?></td>
                    </tr>
                    <tr class="sup ttu p--0">
                        <td colspan="3">
                            <b>Pagamentos</b>
                        </td>
                    </tr>
                
                    <tr class="ttu">
                        <td colspan="2">Dinheiro</td>
                        
                    </tr>
                    <tr class="ttu">
                        <td colspan="2">Total pago</td>
                        <td align="right">R$10,00</td>
                    </tr>
                    <tr class="ttu">
                        <td colspan="2">Troco</td>
                        <td align="right">R$0,44</td>
                    </tr>
                    <tr class="sup">
                        <td colspan="3" align="center">
                            <b>Pedido: <?php echo $venda->venda_id?></b>
                        </td>
                    </tr>
                    <tr class="sup">
                        <td colspan="3" align="center">
                            <?php echo $empresa->empresa_site_url ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
                
</body>
</html>