<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Formações Cadastradas</h4>
                <button type="button" class="btn btn-success btn-circle btn-fill botaoAdicionar" onclick="cadastrarFormacao()">Cadastrar Formação</button>
                <p class="category">Listagem completa de formações cadastradas no sistema.</p>
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
                        $results = $mysqli->query("SELECT * FROM formacao");
                        while ($row = $results->fetch_array()) {
                            $_id = $row["id"];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["nomeFormacao"] ?></td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-circle' onclick='editarFormacao(<?php echo $_id ?>)'><i class='fa fa-pencil'></i></button>
                                    <button type='button' class='btn btn-danger btn-circle' onclick='removerFormacao(<?php echo $_id ?>, "<?php echo $row["nomeFormacao"] ?>")'><i class='fa fa-remove'></i></button>
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