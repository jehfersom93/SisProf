<?php
include_once '../assets/util/connect.php';

$idInstituicao = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sql = $mysqli->query("SELECT * FROM instituicao WHERE id=" . $idInstituicao);
while ($row = $sql->fetch_array()) {
    $nomeInstituicao = $row['nomeInstituicao'];
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Editar Instituição</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input disabled="" id="inputID" type="text" class="form-control" placeholder="ID" value="<?php echo $idInstituicao ?>">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nome Instituição *</label>
                                <input id="inputNomeInstituicao" type="text" class="form-control" placeholder="Nome da Instituição" value="<?php echo $nomeInstituicao ?>">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="atualizaInstituicao(<?php echo $idInstituicao ?>)">Atualizar Instituição</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
