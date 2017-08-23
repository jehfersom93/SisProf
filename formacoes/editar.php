<?php
include_once '../assets/util/connect.php';

$idFormacao = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sql = $mysqli->query("SELECT * FROM formacao WHERE id=" . $idFormacao);
while ($row = $sql->fetch_array()) {
    $nomeFormacao = $row['nomeFormacao'];
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Editar Formação</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input disabled="" id="inputID" type="text" class="form-control" placeholder="ID" value="<?php echo $idFormacao ?>">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nome Formação *</label>
                                <input id="inputNomeFormacao" type="text" class="form-control" placeholder="Nome da Formação" value="<?php echo $nomeFormacao ?>">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="atualizaFormacao(<?php echo $idFormacao ?>)">Atualizar Formação</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
