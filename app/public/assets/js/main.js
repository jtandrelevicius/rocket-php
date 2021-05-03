$(document).ready( function () {
    $('.input_date').mask('00/00/0000');
    $('.input_cep').mask('00000-000');
    $('.input_telefone1').mask('0000-0000');
    $('.input_telefone2').mask('(00) 00000-0000');
    $('.input_cpf').mask('000.000.000-00', {reverse: true});
    $('.input_rg').mask('000.000-000', {reverse: true});
    $('.input_cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.input_ie').mask('00.000.000-0', {reverse: true});
    $('.input_moeda').mask('000.000.000.000.000,00', {reverse: true});
    $('.input_dinheiro2').mask("#.##0,00", {reverse: true});
} );


$("#btn_cep").on("click", function(){
    //alert('teste');
    var numeroCep = $("#cep").val();
    var url       = "https://viacep.com.br/ws/"+ numeroCep +"/json";

    $.ajax({
        url:      url,
        type:     "get",
        dataType: "json",

        success:function(dados){

            $("#endereco").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#uf").val(dados.uf);
            $("#ibge").val(dados.ibge);

            //console.log(dados);

        }
    })

    //alert(numeroCep);
});

$(document).ready(function ($) {

    var pessoa_fisica = $('#pessoa_fisica');
    var pessoa_juridica = $('#pessoa_juridica');

    if (pessoa_fisica.is(":checked")) {

        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();
    }

    if (pessoa_juridica.is(":checked")) {

        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();
    }

    pessoa_fisica.click(function () {

        $('.pessoa_juridica').hide();
        $('.pessoa_fisica').show();

    });

    pessoa_juridica.click(function () {

        $('.pessoa_fisica').hide();
        $('.pessoa_juridica').show();

    });

});