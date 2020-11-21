$(document).ready(function(){

    $("#trash").on("click", function(e){
        if(confirm("Seguro qeu lo quieres eliminar?")){

            let id = $(this).data("id");
            alert($(this).attr('id'))
        }
    });
 });