<?php
include_once 'assets/util/connect.php';

include("inc/seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

$idProfessorLogado = $_SESSION['usuarioID'];
//$idProfessorLogado = 1;
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>SisProf</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Light Bootstrap Table core CSS    -->
        <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

        <!--     Fonts and icons     -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

        <!-- DataTable -->
        <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="assets/css/datatable.css" rel="stylesheet" />

        <!-- Bootstrap Select -->
        <link href="assets/css/bootstrap-multiselect.css" rel="stylesheet" />
        
        <!-- Sweetalert -->
        <link href="assets/css/sweetalert.css" rel="stylesheet" />

        <!-- Páginas -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/pages/index.css" rel="stylesheet" />
        <link href="assets/css/pages/perfil.css" rel="stylesheet" />
        
    </head>
    <body>

        <!-- Modals -->
        <div class="modal fade" id="modalNovaFormacao" tabindex="0" role="dialog" aria-labelledby="modalNovaFormacao" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nova Formação</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label">Nome:</label>
                                <input id="inputNomeFormacaoModal" type="text" class="form-control" id="recipient-name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="salvarFormacaoModal()">Cadastrar Formação</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalNovaDisciplina" tabindex="0" role="dialog" aria-labelledby="modalNovaDisciplina" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nova Disciplina</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label">Nome:</label>
                                <input id="inputNomeDisciplinaModal" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Descrição:</label>
                                <textarea rows="5" id="textareaDescricaoDisciplinaModal" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Tags:</label>
                                <input id="inputTagsDisciplinaModal" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">URL Imagem Pequena:</label>
                                <input id="inputUrlThumbDisciplinaModal" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">URL Imagem Capa:</label>
                                <input id="inputUrlFotoDisciplinaModal" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">URL Site:</label>
                                <input id="inputUrlSiteDisciplinaModal" type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="salvarDisciplinaModal()">Cadastrar Disciplina</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="sidebar" data-color="azure" data-image="assets/img/sidebar-4.jpg">

                <!--
            
                    Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
                    Tip 2: you can also add an image using data-image tag
            
                -->

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="index.php" class="simple-text">
                            SisProf
                        </a>
                    </div>

                    <ul class="nav">
                        <li id="inicio">
                            <a href="javascript:;" onclick="menuSidebar_painel_inicio()">
                                <i class="pe-7s-graph"></i>
                                <p>Painel</p>
                            </a>
                        </li>
                        <li id="perfil">
                            <a href="javascript:;" onclick="menuSidebar_painel_perfil()">
                                <i class="pe-7s-user"></i>
                                <p>Seu Perfil</p>
                            </a>
                        </li>
                        <li id="disciplinas">
                            <a href="javascript:;" onclick="menuSidebar_painel_disciplinas()">
                                <i class="pe-7s-note2"></i>
                                <p>Disciplinas</p>
                            </a>
                        </li>
                        <li id="formacoes">
                            <a href="javascript:;" onclick="menuSidebar_painel_formacoes()">
                                <i class="pe-7s-study"></i>
                                <p>Formações</p>
                            </a>
                        </li>
                        <li id="projetos">
                            <a href="javascript:;" onclick="menuSidebar_painel_projetos()">
                                <i class="pe-7s-plugin"></i>
                                <p>Projetos</p>
                            </a>
                        </li>
                        <!--                        <li id="mensagens">
                                                    <a href="javascript:;" onclick="">
                                                        <i class="pe-7s-paperclip"></i>
                                                        <p>Mensagens (Em breve)</p>
                                                    </a>
                                                </li>-->
                        <?php
                        $sql = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessorLogado . " ORDER BY idOpcaoAcesso ASC");
                        while ($row = $sql->fetch_array()) {
                            $idOpcaoAcesso = $row['idOpcaoAcesso'];
                            if ($idOpcaoAcesso == 1) {
                                ?>
                                <li id="professores">
                                    <a href="javascript:;" onclick="menuSidebar_painel_professores()">
                                        <i class="pe-7s-users"></i>
                                        <p>Professores</p>
                                    </a>
                                </li>
                                <?php
                            }
                            if ($idOpcaoAcesso == 2) {
                                ?>
                                <li id="instituicoes">
                                    <a href="javascript:;" onclick="menuSidebar_painel_instituicoes()">
                                        <i class="pe-7s-culture"></i>
                                        <p>Instituições</p>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default navbar-fixed">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                                <span class="sr-only">Navegação</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="javascript:;" onclick="menuSidebar_painel_inicio()">Painel</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <li>
                                    <a href="javascript:;" onclick="menuSidebar_painel_inicio()" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-dashboard"></i>
                                        <p class="hidden-lg hidden-md">Painel</p>
                                    </a>
                                </li>

                                <!--                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="fa fa-globe"></i>
                                                                        <b class="caret hidden-sm hidden-xs"></b>
                                                                        <span class="notification hidden-sm hidden-xs">5</span>
                                                                        <p class="hidden-lg hidden-md">
                                                                            5 Notifications
                                                                            <b class="caret"></b>
                                                                        </p>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#">Notification 1</a></li>
                                                                        <li><a href="#">Notification 2</a></li>
                                                                        <li><a href="#">Notification 3</a></li>
                                                                        <li><a href="#">Notification 4</a></li>
                                                                        <li><a href="#">Another notification</a></li>
                                                                    </ul>
                                                                </li>-->
                                <!--                                <li>
                                                                    <a href="">
                                                                        <i class="fa fa-search"></i>
                                                                        <p class="hidden-lg hidden-md">Busca</p>
                                                                    </a>
                                                                </li>-->
                            </ul>

                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="javascript:;" onclick="menuSidebar_painel_logout()" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-sign-out"></i>
                                        <p class="hidden-lg hidden-md">Sair</p>
                                    </a>
                                </li>
                                <!--                                <li>
                                                                    <a href="">
                                                                        <p>Sua Conta</p>
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <p>
                                                                            Dropdown
                                                                            <b class="caret"></b>
                                                                        </p>
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#">Action</a></li>
                                                                        <li><a href="#">Another action</a></li>
                                                                        <li><a href="#">Something</a></li>
                                                                        <li><a href="#">Another action</a></li>
                                                                        <li><a href="#">Something</a></li>
                                                                        <li class="divider"></li>
                                                                        <li><a href="#">Separated link</a></li>
                                                                    </ul>
                                                                </li>-->
                                <li class="separator hidden-lg hidden-md"></li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                        <div id="dvConteudo"></div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
<!--                        <nav class="pull-left">
                            <ul>
                                <li>
                                    <a href="../index.php">
                                        Seu site
                                    </a>
                                </li>
                            </ul>
                        </nav>-->
                        <p class="copyright pull-right">
                            &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://kraft.ads.cnecsan.edu.br/~matheuscavallini/">Matheus Cavallini</a>
                        </p>
                    </div>
                </footer>

            </div>
        </div>


    </body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Framework para validação de campos -->
    <script src="assets/js/jquery.maskedinput.min.js"></script>

    <!-- DataTable -->
    <script src="assets/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap Select -->
    <script src="assets/js/bootstrap-multiselect.js"></script>
    
    <!-- Sweetalert -->
    <script src="assets/js/sweetalert.min.js"></script>

    <!-- Páginas -->
    <script src="assets/js/pages/index.js"></script>
    <script src="assets/js/pages/perfil.js"></script>
    <script src="assets/js/pages/professores.js"></script>
    <script src="assets/js/pages/instituicoes.js"></script>
    <script src="assets/js/pages/projetos.js"></script>
    <script src="assets/js/pages/disciplina.js"></script>
    <script src="assets/js/pages/formacoes.js"></script>

</html>
