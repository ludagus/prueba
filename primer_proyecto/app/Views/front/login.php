<div class="container mt-5 mb-5 d-flex justify-content-center" >
  <div class="card" style="width:50%">
    <div class="card-header text-center">
    
    <!-- mensaje de error-->
    <?php if(session()->getFlashData('msg')):?>
      <div class="alert alert-warning">
          <?= session()->getFlashData('msg')?>
      </div>
    <?php endif;?>

  <!--aca termina-->

    <h1 class="titulo">Iniciar Sesión</h1>
    <form method="post" action="<?php echo base_url('/enviarlogin')?>">
      <!--comienza formulario --> 
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
      </div>

      
      <input type="submit" value="ingresar" class="btn btn-success">

      <br>
          <span>¿Aún no se registró?
      <a class="nav-link" href="<?php echo base_url('/registro');?>"> Registrarse aquí </a>
          </span>
    </form>
  </div>
  </div>
</div>
