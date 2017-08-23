<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Professores Cadastrados</h4>
                <button type="button" class="btn btn-success btn-circle btn-fill botaoAdicionar" onclick="cadastrarProfessor()">Cadastrar Professor</button>
                <p class="category">Listagem completa de professores cadastrados no sistema.</p>
            </div>
            <div class="content table-responsive">
                <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results = $mysqli->query("SELECT id,nomeProfessor,emailProfessor,telefoneProfessor,enderecoProfessor FROM professor");
                        while ($row = $results->fetch_array()) {
                            $_id = $row["id"];
                            $nomeProfessor = $row["nomeProfessor"];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["nomeProfessor"] ?></td>
                                <td><?php echo $row["emailProfessor"] ?></td>
                                <td><?php echo $row["telefoneProfessor"] ?></td>
                                <td><?php echo $row["enderecoProfessor"] ?></td>
                                <td>
                                    <?php
                                    $sql = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessorLogado . " ORDER BY idOpcaoAcesso ASC");
                                    while ($row = $sql->fetch_array()) {
                                        $idOpcaoAcesso = $row['idOpcaoAcesso'];
                                        if ($idOpcaoAcesso == 3) { ?>
                                            <button type="button" class="btn btn-primary btn-circle" onclick="editarProfessor(<?php echo $_id ?>)"><i class="fa fa-pencil"></i></button>
                                        <?php }
                                        if ($idOpcaoAcesso == 6) { ?>
                                            <button type='button' class='btn btn-danger btn-circle' onclick='removerProfessor(<?php echo $_id ?>, "<?php echo $nomeProfessor ?>")'><i class='fa fa-remove'></i></button>
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