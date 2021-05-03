<?php $this->load->view('layout/navbar') ?>

<div class="content">
  <div class="container-fluid">
    <form action="" method="POST" name="form_edit">
      <!-- Page title -->
      <div class="page-header">
        <div class="row align-items-center mw-100">
          <div class="col">
            <div class="mb-1">
              <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios') ?>">Listar Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#"><?php echo $titulo ?></a></li>
              </ol>
            </div>
            <h2 class="page-title">
              <span class="text-truncate"><?php echo $titulo ?></span>
            </h2>
          </div>
          <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
              <span class="d-none d-sm-inline">
                <a href="<?php echo base_url('usuarios') ?>" class="btn btn-white">
                  Cancelar
                </a>
              </span>

              <button type="submit" class="btn btn-primary d-none d-sm-inline-block">
                Salvar
              </button>

            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cadastros</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <!--Row1-->
            <div class="form-group col-4 ">
              <label class="form-label required">Nome</label>
              <div>
                <input type="text" class="form-control" name="first_name" placeholder="Nome" value="<?php echo $usuario->first_name ?>">
                <?php echo form_error('first_name', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-4 ">
              <label class="form-label required">Sobrenome</label>
              <div>
                <input type="text" class="form-control" name="last_name" placeholder="Nome" value="<?php echo $usuario->last_name ?>">
                <?php echo form_error('last_name', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
            <div class="form-group col-3 ">
              <label class="form-label required">Usuário</label>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Usuário" value="<?php echo $usuario->username ?>">
                <?php echo form_error('username', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>
          </div>
          <!--Row1-->
          <br>

          <div class="row">
            <div class="form-group col-6 ">
              <label class="form-label required">E-mail</label>
              <div>
                <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $usuario->email ?>">
                <?php echo form_error('email', '<small class="form-text text-danger">','</small>')?>
              </div>
            </div>


            <div class="form-group col-2">
              <label class="form-label">Ativo</label>
              <select class="form-select" name="active">
                <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : '' ?>>Não</option>
                <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : '' ?>>Sim</option>
              </select>

            </div>

            <div class="form-group col-3">
              <label class="form-label">Perfil</label>
              <select class="form-select" name="perfil">
                <option value="2" <?php echo ($perfil_user->id == 2) ? 'selected' : '' ?>>Vendedor</option>
                <option value="1" <?php echo ($perfil_user->id == 1) ? 'selected' : '' ?>>Administrador</option>
              </select>

            </div>
          </div>
          <br>

          <div class="row">
            <div class="form-group col-5 ">

              <label class="form-label">Senha</label>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Senha" value="">
              </div>
            </div>
          </div>

          <br>

          <input type="hidden" name="usuario_id" value="<?php echo ($usuario->id) ?>">

        </div>
      </div>
    </form>
    <!-- Content here -->
  </div>