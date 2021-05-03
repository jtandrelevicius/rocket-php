<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="<?php echo base_url('/') ?>">
                <img src="<?php echo base_url('/public/assets/img/logo.png')?>" width="110" height="28" alt="Rocket" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications" aria-expanded="false">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                    </svg>
                    <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-body">
                            Sem notificações
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url(./static/avatars/003m.jpg)"></span>
                    <?php $user = $this->ion_auth->user()->row();?>
                    <?php $user_groups = $this->ion_auth->get_users_groups($user->id)->row();?>
                    <div class="d-none d-xl-block ps-2">
                        <div><?php echo $user->first_name;?>&nbsp;<?php echo $user->last_name?></div>
                        <div class="mt-1 small text-muted"><?php echo $user_groups->description ?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <?php if ($this->ion_auth->is_admin()) :?>
                    <a href="<?php echo base_url('empresa')?>" class="dropdown-item">Minha conta</a>
                    <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item">Configuração</a>
                    <a href="<?php echo base_url('login/logout')?>" class="dropdown-item">Sair</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <!--INICIO NAV-->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('dashboard')?>">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><svg class="icon icon-tabler icon-tabler-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="13" r="2"></circle>
                                <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                             </svg>
                        </span>
                            <span class="nav-link-title">
                                 Dashboard
                            </span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><ellipse cx="12" cy="6" rx="8" ry="3"></ellipse><path d="M4 6v6a8 3 0 0 0 16 0v-6" /><path d="M4 12v6a8 3 0 0 0 16 0v-6" /></svg>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Cadastro
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('clientes')?>">
                                Clientes
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('fornecedores')?>">
                                Fornecedor
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('vendedores') ?>">
                                Vendedores
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('usuarios') ?>">
                                Usuários
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="6" cy="19" r="2" /><circle cx="17" cy="19" r="2" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Vendas
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('vendas')?>">
                                Pedido de Venda
                            </a>
    
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" /><line x1="12" y1="12" x2="20" y2="7.5" /><line x1="12" y1="12" x2="12" y2="21" /><line x1="12" y1="12" x2="4" y2="7.5" /></svg>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Estoque
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('produtos')?>">
                                Produtos
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('categorias')?>">
                                Categorias
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('marcas')?>">
                                Marcas
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg  class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="16" height="16" rx="1" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="8" y1="4" x2="8" y2="8" /></svg>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Suprimentos
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('OrdemServico')?>">
                                Ordem de Serviços
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('servicos') ?>">
                                Serviços
                            </a>
                            <a class="dropdown-item" href="">
                                Inventario
                            </a>  
                           
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                               Financeiro
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('pagar') ?>">
                                Contas a Pagar
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('receber')?>">
                                Contas a Receber
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('pagamento')?>">
                                Forma de Pagamento
                            </a> 
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3v18h18" /><circle cx="9" cy="9" r="2" /><circle cx="19" cy="7" r="2" /><circle cx="14" cy="15" r="2" /><line x1="10.16" y1="10.62" x2="12.5" y2="13.5" /><path d="M15.088 13.328l2.837 -4.586" /></svg>
                            </span>
                            <span class="nav-link-title">
                               Relatórios
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('relatorios/pagar') ?>">
                                Contas a Pagar
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('relatorios/receber')?>">
                                Contas a Receber
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('relatorios/vendas')?>">
                                Vendas
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('relatorios/ordens_servicos')?>">
                                Ordens de Serviço
                            </a>
                        </div>
                    </li>
                   
                </ul>
                <div class="ms-md-auto ps-md-4 py-2 py-md-0 me-md-4 order-first order-md-last flex-grow-1 flex-md-grow-0">
                </div>
            </div>
        </div>
    </div>
</header>