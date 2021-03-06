$( function(){
    $("#form-upload").submit( function(e){
        e.preventDefault();
        
        var form = document.getElementById("form-upload");
        var formdata = new FormData(form);

        $response = $("#rsp");

        $.ajax({
            url: "?p=upload",
            type: "POST",
            data: formdata,
            dataType: "html",
            processData: false,
            contentType: false,
            beforeSend:function()
            {
                $(".btn").val("processando...").attr("disabled",true);
            },
            success: function(data)
            {
                if(data === "err1")
                {
                    danger($response,"Erro ao fazer upload de arquivo");
		    ativarBotao();
                    setTimeout(clear,5000);
                    return;
                }
                else if(data === "err2")
                {
                    danger($response,"Erro ao salvar imagem no banco de dados");
		    ativarBotao();
                    setTimeout(clear,5000);
                    return;
                }
                else if (data === "size")
                {
                    danger($response,"Tamanho do arquivo deve ser de no máximo 2MB");
		    ativarBotao();
                    setTimeout(clear,5000);
                    return;
                }
                else if(data === "type")
                {
                    danger($response,"Tipo de arquivo não suportado. Tipo aceito (JPEG)");
		    ativarBotao();
                    setTimeout(clear,5000);
                    return;
                }
                else{
                    $("body").html(data);
                    $("#rsp").html("Imagem salva com sucesso!").css({
                        backgroundColor: "lightgreen",
                        padding: "10px",
                        color: "white"
                    });

                    setTimeout(clear,5000);
                }

            },
            error: function()
            {
                console.log("Error interno")
            }
        });

        return false;
    });
});

function clear()
{
    $("#rsp").html("").css("padding","0px");
}

function danger(element, text)
{
    element.html(text).css({
        backgroundColor: "red",
        padding: "10px",
        color: "white"
    });
}

function sucesso(el, text)
{
    el.html(text).css({
        backgroundColor: "lightgreen",
        padding: "10px",
        color: "white"
    });
}

function apagar(n)
{
    $response = $("#rsp");

    $.ajax({
        url: "/?p=delete&n="+n,
        type: "GET",
        dataType: "html",        
        success:function(data){
        
            if(data == "d1")
            {
                danger($response, "Error ao deletar upload do servidor");
                return;
            }
            else if(data == "d2")
            {
                danger($response,"Error ao deletar a imagem do banco de dados");
                return;
            }
            else{
                // document.location.href = "/";
                setTimeout(sucesso($response,"Imagem deletada com sucesso!"),2000);
                $("body").html(data);
            }
        },
        error: function()
        {
            alert("Error interno");
        }
    });
}

function girarImagem(direcao)
{
    nome_imagem = $("#nome_imagem").val();
    id_imagem = $("#id").val();
    $.ajax({
        url: "?p=girarImagem&direcao=" + direcao + "&nome_imagem=" + nome_imagem + "&n=" +id_imagem,
        type: "GET",
        dataType: "html",
        async:true,
        success: function(data)
        {   
            $("body").html(data);
            console.log(data)
        },
        error: function()
        {
            alert("Error interno");
        }
    });
}

function ativarBotao()
{
	$(".btn").attr("disabled",false).val('Salvar');
}
