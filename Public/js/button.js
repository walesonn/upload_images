$(function(){
    $("#email").blur(function(){
        alert("blur");
    })
    $("#formLogin").submit(function(e){
        e.preventDefault();

        $.ajax({
            url: "/",
            type: "POST",
            dataType: "html",
            data: $(this).serialize(),
            beforeSend: function()
            {
                $("#btnLogin").attr("disabled",true);
            },
            success: function(data)
            {
                document.location.href = "http://localhost/?p=painel";
                console.log(data)
            },
            error: function()
            {
                alert("Error interno!");
            }
        });
        return false;
    });
});