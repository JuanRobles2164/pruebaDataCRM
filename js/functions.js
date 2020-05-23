function getUser(){
    $.ajax({
        url: 'views/tabla.php',
        type: 'GET',
        data: {
            'operation': 'getchallenge',
            'username' : 'prueba'
        },
        success: function(response) {
            $("#user_content").html(response);
        }, 
        error: function(response){
            alert('Error al traer la información');
        }
    });
}