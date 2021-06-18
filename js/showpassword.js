$(document).ready(function() {
    $(".hideshow").on('click', function(event) {
        event.preventDefault();
        if($('#password').attr("type") == "text"){
            $('#password').attr('type', 'password');
            $('.hideshow i').addClass( "fa-eye" );
            $('.hideshow i').removeClass( "fa-eye-slash" );
        }else if($('#password').attr("type") == "password"){
            $('#password').attr('type', 'text');
            $('.hideshow i').removeClass( "fa-eye" );
            $('.hideshow i').addClass( "fa-eye-slash" );
        }
    });
});