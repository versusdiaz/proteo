$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    login = $("#login").val();
    clave = $("#clave").val();
    var expresion = /^[a-z\d_]{4,15}$/i;
    var expresion2 = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    
    if(expresion.test(login) && expresion2.test(clave)){
        $.post("controllers/usuario.php?op=verificar",{"logina":login,"clavea":clave},function(data){
        if(data!="null"){
            $(location).attr("href","escritorio");
        }else{
             swal('Error!','Usuario y/o clave incorrectos','error');
        }
     })
    }else{
        swal('Error!','Usuario y Clave no cumplen los formatos','error');
        $("#login").val("");
        $("#clave").val("");
    }
});