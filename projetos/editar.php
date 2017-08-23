<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = 1; // provisório

$idProjeto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$sql = $mysqli->query("SELECT professor.nomeProfessor FROM professor_projeto INNER JOIN professor ON professor.id=professor_projeto.idProfessor WHERE professor.id=" . $idProfessorLogado);
while ($row = $sql->fetch_array()) {
    $nomeProfessor = $row['nomeProfessor'];
}

$sql = $mysqli->query("SELECT * FROM professor_projeto WHERE id=" . $idProjeto);
while ($row = $sql->fetch_array()) {
    $tituloProjeto = $row['tituloProjeto'];
    $descricaoProjeto = $row['descricaoProjeto'];
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Editar Projeto</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Professor</label>
                                <input disabled="" id="inputNomeProfessor" type="text" class="form-control" value="<?php echo $nomeProfessor ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Título *</label>
                                <input id="inputTituloProjeto" type="text" class="form-control" placeholder="Título do Projeto" value="<?php echo $tituloProjeto ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição *</label>
                                <textarea id="textareaDescricaoProjeto" rows="15" class="form-control" placeholder="Aqui você deve escrever a descrição do projeto que aparecerá no seu site."><?php echo $descricaoProjeto ?></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="atualizarProjeto(<?php echo $idProjeto ?>)">Atualizar Projeto</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
