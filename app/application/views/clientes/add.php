<?php $this->load->view('layout/navbar') ?>

<div class="content">
    <div class="container-fluid">
        <form action="" method="POST" name="form_cliente">
            <!-- Page title -->
            <div class="page-header">
                <div class="row align-items-center mw-100">
                    <div class="col">
                        <div class="mb-1">
                            <ol class="breadcrumb breadcrumb-alternate" aria-label="breadcrumbs">
                                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Clientes</a></li>
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
                                <a href="<?php echo base_url('clientes') ?>" class="btn btn-white">
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
            <?php if ($message = $this->session->flashdata('sucesso')) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-important alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="far fa-smile"></i>&nbsp; <?php echo $message; ?>
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($message = $this->session->flashdata('error')) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <i class="fas fa-exclamation-triangle"></i>&nbsp; <?php echo $message; ?>
                                </div>
                            </div>
                            <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-2">
                            <div class="custom-control custom-radio custom-control-inline mt-2">
                                <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                                <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?>>
                                <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    

                    <div class="pessoa_fisica">
                    <div class="row">
                        <!--Row1-->
                        <div class="form-group col-5 ">
                            <label class="form-label required">Nome</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_nome" placeholder="Nome" value="<?php echo set_value('cliente_nome') ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group col-5 ">
                            <label class="form-label">Sobrenome</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Sobrenome" value="<?php echo set_value('cliente_sobrenome') ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-2 ">
                            <label class="form-label">Data de aniversário</label>
                            <div class="input-icon">
                                <span class="input-icon-addon "><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                <input class="form-control" type="date" name="cliente_data_nascimento" placeholder="00-00-0000" id="datepicker-icon-prepend" value="<?php echo set_value('cliente_data_aniversario') ?>">
                            </div>
                        </div>
                    </div>
                    <!--Row1-->
                    <br>
                        <div class="row">
                            <!--Row2-->
                            <div class="col-2">
                                <label class="form-label">CPF</label>
                                <div>
                                    <input type="text" class="form-control input_cpf" name="cliente_cpf" placeholder="" value="<?php echo set_value('cliente_cpf') ?>">
                                </div>
                                <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-2">
                                <label class="form-label">RG</label>
                                <div>
                                    <input type="text" class="form-control input_rg" name="cliente_rg" placeholder="" value="<?php echo set_value('cliente_rg') ?>">
                                    <?php echo form_error('cliente_rg', '<small class="form-text text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <!--Row2-->
                        <br>
                    </div>

                    <div class="pessoa_juridica">
                    <div class="row">
                        <!--Row1-->
                        <div class="form-group col-5 ">
                            <label class="form-label required">Nome Fantasia</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_nome_fantasia" placeholder="Nome Fantasia" value="<?php echo set_value('cliente_nome_fantasia"') ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group col-5 ">
                            <label class="form-label">Razão Social</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_razao" placeholder="Razão Social" value="<?php echo set_value('cliente_razao') ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-2 ">
                            <label class="form-label">Data de Criação</label>
                            <div class="input-icon">
                                <span class="input-icon-addon "><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <line x1="11" y1="15" x2="12" y2="15"></line>
                                        <line x1="12" y1="15" x2="12" y2="18"></line>
                                    </svg>
                                </span>
                                <input class="form-control" type="date" name="cliente_data_nascimento" placeholder="00-00-0000" id="datepicker-icon-prepend" value="<?php echo set_value('cliente_data_aniversario') ?>">
                            </div>
                        </div>
                    </div>
                    <!--Row1-->
                    <br>
                        <div class="row">
                            <div class="col-2">
                            <label class="form-label">CNPJ</label>
                            <div>
                                <input type="text" class="form-control input_cnpj" name="cliente_cnpj" placeholder="" value="<?php echo set_value('cliente_cnpj') ?>">
                                <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            </div>
                            <div class="col-2">
                            <label class="form-label">Inscrição Estadual</label>
                            <div>
                                <input type="text" class="form-control input_ie" name="cliente_ie" placeholder="" value="<?php echo set_value('cliente_ie') ?>">
                                <?php echo form_error('cliente_ie', '<small class="form-text text-danger">', '</small>') ?>

                            </div>
                            </div>                      
                        </div>
                        <br>
                    </div>




                    <div class="row">
                        <div class="form-group col-6 ">
                            <label class="form-label">E-mail</label>
                            <div>
                                <input type="email" class="form-control" name="cliente_email" placeholder="E-mail" value="<?php echo set_value('cliente_email') ?>">
                                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group col-2">
                            <label class="form-label required">Telefone</label>
                            <div>
                                <input type="text" class="form-control input_telefone2" name="cliente_telefone" placeholder="(00)0000-0000" value="<?php echo set_value('cliente_telefone') ?>">
                                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-2">
                            <label class="form-label ">Celular</label>
                            <div>
                                <input type="text" class="form-control input_telefone2" name="cliente_celular" placeholder="(00)00000-0000" value="<?php echo set_value('cliente_celular') ?>">
                                <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group col-2">
                            <label class="form-label ">Ativo</label>
                            <select class="form-select" name="cliente_ativo">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
                    <br>



                    <div class="row">
                        <!--ROW3-->
                        <div class="row">
                            <label class="form-label">CEP</label>
                            <div class="col-2">
                                <input type="text" class="form-control input_cep" name="cliente_cep" id="cep" placeholder="CEP" value="<?php echo set_value('cliente_cep') ?>">
                            </div>
                            <div class="col-auto">
                                <a href="#" class="btn btn-white btn-icon" id="btn_cep" aria-label="Button">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--ROW3-->
                    <br>

                    <div class="row">
                        <!--ROW4-->
                        <div class="form-group col-4 ">
                            <label class="form-label ">Endereço</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_endereco" id="endereco" placeholder="Endereço" value="<?php echo set_value('cliente_endereco') ?>">
                                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-1 ">
                            <label class="form-label ">Numero</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_numero" placeholder="N°" value="<?php echo set_value('cliente_numero') ?>">
                                <?php echo form_error('cliente_numero', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-3 ">
                            <label class="form-label ">Bairro</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_bairro" id="bairro" placeholder="Bairro" value="<?php echo set_value('cliente_bairro') ?>">
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-3 ">
                            <label class="form-label  ">Cidade</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_cidade" id="cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade') ?>">
                                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group col-1">
                            <label class="form-label  ">UF</label>
                            <div>
                                <input type="text" class="form-control" name="cliente_estado" id="uf" placeholder="UF" value="<?php echo set_value('cliente_estado') ?>">
                                <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                    </div>
                    <!--ROW4-->
                    <br>

                    <div class="row">

                        <div class="form-group col-12">
                            <label class="form-label">Observação <span class="form-label-description">0/100</span></label>
                            <textarea class="form-control" name="cliente_obs" rows="4" placeholder="Observação.."><?php echo set_value('cliente_obs') ?></textarea>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </form>
        <!-- Content here -->
    </div>