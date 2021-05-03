<?php 
 include("mpdf60/mpdf.php");

 $html = "
<table class='printer-ticket'>'
 <thead>
    <tr>
        <th class='title' colspan='3'> $empresa->empresa_nome_fantasia </th>
    </tr>
    <tr>
        <th colspan='3'>$venda->venda_data_emissao</th>
    </tr>
    <tr>
        <th colspan='3'>
            $venda->cliente_nome <br />
            $venda->cliente_telefone
        </th>
    </tr>
    <tr>
        <th class='ttu' colspan='3'>
            <b>Cupom não fiscal</b>
        </th>
    </tr>
</thead>

<tbody>
foreach ($produto as $produto) 
<tr class='top'>
    <td colspan='3'>$produto->produto_descricao</td>
</tr>
<tr>
    <td>R$7,99</td>
    <td>2.0</td>
    <td>R$15,98</td>
</tr>
endforeach;  
</tbody>

<tfoot>

<tr class='sup ttu p--0'>
    <td colspan='3'>
        <b>Totais</b>
    </td>
</tr>
    
                  


<tr class='sup'>
     <td colspan='3' align='center'>
    $empresa->empresa_site_url
    </td>
</tr>


</table>
 ";

            $mpdf=new mPDF(); 
            $mpdf->SetDisplayMode('fullpage');
            $css  = file_get_contents("public/assets/css/cupom.css");
           // $html = file_get_contents("application/views/vendas/cupom.php");
            $mpdf->WriteHTML($css,1);
            $mpdf->WriteHTML($html);
            $mpdf->Output();           
exit;
       