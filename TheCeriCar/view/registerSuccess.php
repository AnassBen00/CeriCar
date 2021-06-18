<div class="container-fluid bg-light py-3">
            <div class="col-lg"> 
            <div class="col-md-6 mx-auto"> 
            <div class="card card-body"> 
              <?php if($context->success) { ?>
              <div class="alert alert-success" role="alert">
                Votre compte a été enregistré veuillez <a href="?action=login">vous connecter</a>
              </div>
             <?php } ?>
                  <form method="POST">
                    <input type="hidden" name="action" value="register">
                    <div class="form-row">
                      <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" placeholder="Entrez votre nom" name="prenom" required="required">
                      </div>
                      <div class="col">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" placeholder="Entrez votre prénom" name="nom" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="identifiant">Pseudo</label>
                      <input type="text" class="form-control" id="identifiant" placeholder="Choisissez un identifiant" name="identifiant" required="required">
                    </div>
                    <div class="form-group">
                      <label for="password">Mot de passe</label>
                          <div class="input-group">
                                  <input type="password" name="password" placeholder="Entrez un mot de passe" class="form-control" required="required" minlength="8">

                                  <div class="input-group-append">
                                    <span class="input-group-text hideshow">               
                                      <i class="fa fa-eye"></i>     
                                    </span>       
                                  </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Minimum 8 caractères.</small> 
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmer</button>
                  </form>
            </div>
            </div>      
            </div>
</div>