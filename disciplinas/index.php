<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Disciplinas Cadastradas</h4>
                <button type="button" class="btn btn-success btn-circle btn-fill botaoAdicionar" onclick="cadastrarDisciplina()">Cadastrar Disciplina</button>
                <p class="category">Listagem completa de disciplinas cadastradas no sistema.</p>
            </div>
            <div class="content table-responsive">
                <table id="tabelaDataTable" class="display nowrap dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Tags</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results = $mysqli->query("SELECT * FROM disciplina");
                        while ($row = $results->fetch_array()) {
                            $_id = $row["id"];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row["id"] ?></td>
                                <td><?php echo $row["nomeDisciplina"] ?></td>
                                <td><?php echo $row["tagsDisciplina"] ?></td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-circle' onclick='editarDisciplina(<?php echo $_id ?>)'><i class='fa fa-pencil'></i></button>
                                    <button type='button' class='btn btn-danger btn-circle' onclick='removerDisciplina(<?php echo $_id ?>, "<?php echo $row["nomeDisciplina"] ?>")'><i class='fa fa-remove'></i></button>
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