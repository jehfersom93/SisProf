<?php
include_once '../assets/util/connect.php';
$idProfessorLogado = 1 // provisório
?>

<head>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<div class="row">
    <!--                    <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Estatísticas de Contato</h4>
                                    <p class="category">Dados atualizados recentemente</p>
                                </div>
                                <div class="content">
                                    <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>
    
                                    <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Open
                                            <i class="fa fa-circle text-danger"></i> Bounce
                                            <i class="fa fa-circle text-warning"></i> Unsubscribe
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="pe-7s-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="panel-number">
                            <?php
                            if ($sql = $mysqli->query("SELECT id FROM professor")) {
                                printf($sql->num_rows);
                            }
                            ?>
                        </div>
                        <div>Professores Cadastrados</div>
                    </div>
                </div>
            </div>
            <?php
            $sql = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessorLogado . " ORDER BY idOpcaoAcesso ASC");
            while ($row = $sql->fetch_array()) {
                $idOpcaoAcesso = $row['idOpcaoAcesso'];
                if ($idOpcaoAcesso == 1) {
                    ?>
                    <a href="javascript:;" onclick="menuSidebar_painel_professores()">
                        <?php
                        break;
                    } else {
                        ?>
                        <a href="javascript:;" onclick="$.notify({ icon: 'pe-7s-close-circle', message:'Você não possui acesso à esta página!'}, {type: 'danger',timer: 1000});">
                           <?php
                       }
                   }
                   ?>

                   <div class="panel-footer">
                        <span class="pull-left">Ver Detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="pe-7s-plugin fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="panel-number">
                            <?php
                            if ($sql = $mysqli->query("SELECT id FROM professor_projeto")) {
                                printf($sql->num_rows);
                            }
                            ?>
                        </div>
                        <div>Projetos Cadastrados</div>
                    </div>
                </div>
            </div>
            <a href="javascript:;" onclick="menuSidebar_painel_projetos()">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="pe-7s-study fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="panel-number">
                            <?php
                            if ($sql = $mysqli->query("SELECT id FROM formacao")) {
                                printf($sql->num_rows);
                            }
                            ?>
                        </div>
                        <div>Formações Cadastradas</div>
                    </div>
                </div>
            </div>
            <a href="javascript:;" onclick="menuSidebar_painel_formacoes()">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="pe-7s-note2 fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="panel-number">
                            <?php
                            if ($sql = $mysqli->query("SELECT id FROM disciplina")) {
                                printf($sql->num_rows);
                            }
                            ?>
                        </div>
                        <div>Disciplinas Cadastradas</div>
                    </div>
                </div>
            </div>
            <a href="javascript:;" onclick="menuSidebar_painel_disciplinas()">
                <div class="panel-footer">
                    <span class="pull-left">Ver Detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!--    <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Acessos</h4>
                    <p class="category">Atualizado à cada 24 horas</p>
                </div>
                <div class="content">
                    <div id="chartHours" class="ct-chart"></div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Open
                            <i class="fa fa-circle text-danger"></i> Click
                            <i class="fa fa-circle text-warning"></i> Click Second Time
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Atualizado 3 minutos atrás
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


    <!--    <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Tarefas</h4>
                    <p class="category">Seu quadro de tarefas</p>
                </div>
                <div class="content">
                    <div class="table-full-width">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Sign contract for "What are conference organizers afraid of?"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                        </label>
                                    </td>
                                    <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                    </td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Read "Following makes Medium better"</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox">
                                            <input type="checkbox" value="" data-toggle="checkbox">
                                        </label>
                                    </td>
                                    <td>Unfollow 5 enemies from twitter</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <div class="footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> Updated 3 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</div>

<div class="row">
    <!--                    <div class="col-md-6">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title">2014 Sales</h4>
                                    <p class="category">All products including Taxes</p>
                                </div>
                                <div class="content">
                                    <div id="chartActivity" class="ct-chart"></div>
    
                                    <div class="footer">
                                        <div class="legend">
                                            <i class="fa fa-circle text-info"></i> Tesla Model S
                                            <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                        </div>
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-check"></i> Data information certified
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->


</div>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>