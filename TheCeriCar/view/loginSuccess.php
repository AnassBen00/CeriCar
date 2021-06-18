<div class="container" style="margin-top:15px;">
    <div class="col-lg">
    <div class="col-md-6 mx-auto"> 
    <div class="card card-body">
        <form id="login" method="POST"  action="" >

            <div class="form-group">
               
                <input type="text" class="form-control" id="identifiant" placeholder="Entrez votre Pseudo" name="identifiant" required="required" style="background-color:rgb(237, 237, 237);font-size: 18px;font-weight: 500;font-family: 'Trebuchet MS', serif">
            </div>
            <div class="form-group">
              
                    <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" style="background-color:rgb(237, 237, 237);font-size: 18px;font-weight: 500;font-family: 'Trebuchet MS', serif" required="required" minlength="8">
                            <div class="input-group-append">
                            <span class="input-group-text hideshow">
                                <i class="fa fa-eye"></i>
                            </span>
                            </div>
                        </div>
            </div>
            <div class="form-group" style="text-align:center;">
                <button type="submit" class="btn btn-info" style="font-size: 20px;font-weight: 600;font-family: 'Trebuchet MS', serif" >Se connecter</button>
            </div> 
            </form>
    </div>
    </div>
    </div>
</div>

<script>
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
</script>