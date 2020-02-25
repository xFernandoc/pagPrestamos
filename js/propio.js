$(document).ready(function(){
    var llave = true;
    $("#ver").on("click",function(){
        if (llave) {
            $("#ver").removeClass("fa-eye-slash");
            $("#ver").addClass("fa-eye")
            $("#clave").attr("type","text");
            llave=false;
        }else{
            $("#ver").removeClass("fa-eye")
            $("#ver").addClass("fa-eye-slash");
            $("#clave").attr("type","password");
            llave=true;
        }
        $("#clave").focus();
    });
});