<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Instituições Cadastradas</h4>
                <button type="button" class="btn btn-success btn-circle btn-fill botaoAdicionar" onclick="cadastrarInstituicao()">Cadastrar Instituição</button>
                <p class="category">Listagem completa de instituições cadastradas no sistema.</p>
            </div>
            <div class="content table-responsive">
                <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results = $mysqli->query("SELECT * FROM instituicao");
                        while ($row = $results->fetch_array()) {
                            $_id = $row["id"];
                            $nomeInstituicao = $row["nomeInstituicao"];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["nomeInstituicao"] ?></td>
                                <td>
                                    <?php
                                    $sql = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessorLogado . " ORDER BY idOpcaoAcesso ASC");
                                    while ($row = $sql->fetch_array()) {
                                        $idOpcaoAcesso = $row['idOpcaoAcesso'];
                                        if ($idOpcaoAcesso == 4) { ?>
                                            <button type='button' class='btn btn-primary btn-circle' onclick='editarInstituicao(<?php echo $_id ?>)'><i class='fa fa-pencil'></i></button>
                                        <?php }
                                        if ($idOpcaoAcesso == 5) { ?>
                                            <button type='button' class='btn btn-danger btn-circle' onclick='removerInstituicao(<?php echo $_id ?>, "<?php echo $nomeInstituicao ?>")'><i class='fa fa-remove'></i></button>
                                        <?php }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>ativarDataTable()</script>