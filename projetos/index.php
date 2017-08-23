<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Projetos Cadastrados</h4>
                <button type="button" class="btn btn-success btn-circle btn-fill botaoAdicionar" onclick="cadastrarProjeto()">Cadastrar Projeto</button>
                <p class="category">Listagem completa de todos os seus projetos cadastrados no sistema.</p>
            </div>
            <div class="content table-responsive">
                <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Professor</th>
                            <th>Título</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results = $mysqli->query("SELECT professor_projeto.id,professor.nomeProfessor,professor_projeto.tituloProjeto,professor_projeto.descricaoProjeto FROM professor_projeto INNER JOIN professor ON professor_projeto.idProfessor=professor.id WHERE professor.id=" . $idProfessorLogado);
                        while ($row = $results->fetch_array()) {
                            $_id = $row["id"];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["nomeProfessor"] ?></td>
                                <td><?php echo $row["tituloProjeto"] ?></td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-circle' onclick='editarProjeto(<?php echo $_id ?>)'><i class='fa fa-pencil'></i></button>
                                    <button type='button' class='btn btn-danger btn-circle' onclick='removerProjeto(<?php echo $_id ?>, "<?php echo $row["tituloProjeto"] ?>")'><i class='fa fa-remove'></i></button>
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