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
            success: function(data)
            {
                if(data === "err1")
                {
                    danger($response,"Erro ao fazer upload de arquivo");
                    setTimeout(clear,5000);
                    return;
                }
                else if(data === "err2")
                {
                    danger($response,"Erro ao salvar imagem no banco de dados");
                    setTimeout(clear,5000);
                    return;
                }
                else if (data === "size")
                {
                    danger($response,"Tamanho do arquivo deve ser de no máximo 2MB");
                    setTimeout(clear,5000);
                    return;
                }
                else if(data === "type")
                {
                    danger($response,"Tipo de arquivo não suportado. Tipos aceitos (PNG, GIF, JPEG)");
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