$(function() {

    /* Bradcrumbs */ 
    $('#breadcrumbs').breadcrumbsGenerator();

    $('#breadcrumbs').find('li').addClass('breadcrumb-item');
    $('#breadcrumbs').find('a').removeClass('nav-link active');
    $('#breadcrumbs').attr('aria-current', 'page');

    /* Bradcrumbs */ 

    /* API IBGE - Seleção de regiões, estados e municípios */ 

    $('.select2').select2({
        language: "pt-BR"
    });

      $("#sltRegioes").change(()=>{

        if($("#sltRegioes").val() == -1){
            $("#sltEstados").html("<option value='-1'>Selecione uma Região</option>");
            $("#sltMunicipios").html("<option value='-1'>Selecione uma Região</option>");
            return;
        }

        var enderecoEstado = "https://servicodados.ibge.gov.br/api/v1/localidades/regioes/"+$("#sltRegioes").val()+"/estados"

        $.ajax({
            url: enderecoEstado,
            type: "GET",
            data: {
                orderBy: "nome"
            },
            success: (estados)=>{
                var i;
                var opcoes= "";
                for(i=0;i<estados.length;i++){
                    opcoes = opcoes + "<option value='"+estados[i].nome+"'>"+estados[i].nome+"</option>";
                }
                $("#sltEstados").html(opcoes);
                $("#sltEstados").trigger("change");
            }
        });
    });

    $("#sltEstados").change(()=>{

        if($("#sltEstados").val() == -1){
            $("#sltMunicipios").html("<option value='-1'>Selecione uma Região</option>");
            return;
        }

        var endereco = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/"+$("#sltEstados").val()+"/municipios"

        $.ajax({
            url: endereco,
            type: "GET",
            data: {
                orderBy: "nome"
            },
            success: (municipios)=>{
                var i;
                var opcoes= "";
                for(i=0;i<municipios.length;i++){
                    opcoes = opcoes + "<option value='"+municipios[i].nome+"'>"+municipios[i].nome+"</option>";
                }
                $("#sltMunicipios").html(opcoes);
                $("#sltEstados").trigger("change");
            }
        });
    }); 

    $.ajax({
        url: "https://servicodados.ibge.gov.br/api/v1/localidades/regioes",
        type: "GET",
        data: {
            orderBy: "nome"
        },
        success: (regioes)=>{
            var i;
            var opcoes= "<option value='-1'>Selecione uma Região</option>";
            for(i=0;i<regioes.length;i++){
                opcoes = opcoes + "<option value='"+regioes[i].nome+"'>"+regioes[i].nome+"</option>";
            }
            $("#sltRegioes").html(opcoes);
            $("#sltRegioes").trigger("change");
        }
    });


    $.ajax({
        url: "https://servicodados.ibge.gov.br/api/v1/localidades/estados",
        type: "GET",
        data: {
            orderBy: "nome"
        },
        success: (estados)=>{
            var i;
            var opcoes;
            for(i=0;i<estados.length;i++){
                opcoes = opcoes + "<option value='"+estados[i].nome+"'>"+estados[i].nome+"</option>";
            }
            $("#sltEstadosUnico").html(opcoes);
        }
    });

    $.ajax({
        url: "https://servicodados.ibge.gov.br/api/v1/localidades/municipios",
        type: "GET",
        data: {
            orderBy: "nome"
        },
        success: (municipios)=>{
            var i;
            var opcoes;
            for(i=0;i<municipios.length;i++){
                opcoes = opcoes + "<option value='"+municipios[i].nome+"'>"+municipios[i].nome+"</option>";
            }
            $("#sltMunicipiosUnico").html(opcoes);
        }
    });

    $.ajax({
        url: "https://servicodados.ibge.gov.br/api/v1/localidades/regioes",
        type: "GET",
        data: {
            orderBy: "nome"
        },
        success: (regioes)=>{
            var i;
            var opcoes;
            for(i=0;i<regioes.length;i++){
                opcoes = opcoes + "<option value='"+regioes[i].nome+"'>"+regioes[i].nome+"</option>";
            }
            $("#sltRegioesUnico").html(opcoes);
        }
    });


    

});