<?php
include_once '../assets/util/connect.php';

$sql = $mysqli->query("SELECT * FROM configuracoes");
while ($row = $sql->fetch_array()) {
    $capaPadrao = $row['capaPadrao'];
    $fotoPerfilPadrao = $row['fotoPerfilPadrao'];
}

$sql = $mysqli->query("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='professor'");
while ($row = $sql->fetch_array()) {
    $idNovoProfessor = $row['AUTO_INCREMENT'];
}
?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Novo Professor</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input disabled id="inputID" type="text" class="form-control" placeholder="ID" value="<?php echo $idNovoProfessor ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Instituição</label>
                                <select class="form-control" placeholder="Instituição" id="selectInstituicao">
                                    <?php
                                    $sql = $mysqli->query("SELECT * FROM instituicao");
                                    while ($row = $sql->fetch_array()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nomeInstituicao'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Endereço de E-mail *</label>
                                <input id="inputEmail" type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input id="inputNome" type="text" class="form-control" placeholder="Nome Completo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefone (opcional)</label>
                                <input id="inputTelefone" type="text" class="form-control" placeholder="Telefone">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Estado *</label>
                                <select class="form-control" placeholder="Estado" id="selectEstado" onchange="selectCarregaMunicipios()">
                                    <?php
                                    echo "<option></option>";
                                    $sql = $mysqli->query("SELECT uf FROM estado");
                                    while ($row = $sql->fetch_array()) {
                                        echo "<option value='" . $row['uf'] . "'>" . $row['uf'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cidade *</label>
                                <select class="form-control" placeholder="Cidade" id="selectCidade">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Endereço (opcional)</label>
                                <input id="inputEndereco" type="text" class="form-control" placeholder="Endereço">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--                        <div class="col-md-6">
                                                    <label>URL Imagem de Capa (opcional)</label>
                                                    <div class="input-group">
                        //<?php
//                        if (!is_null($urlCapaProfessor) && !empty($urlCapaProfessor)) {
//                            echo "<input type='text' class='form-control' value='" . $urlCapaProfessor . "'>";
//                        } else {
//                            echo "<input type='text' class='form-control' placeholder='Capa Padrão'>";
//                        }
//                        
                        ?>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-info btn-fill" type="button">Carregar Imagem</button>
                                                        </span>
                                                    </div>
                                                </div>-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>URL Currículo Lattes (opcional)</label>
                                <input id="inputCurriculo" type="text" class="form-control" placeholder="URL Currículo Lattes">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Senha *</label>
                                <input id="inputSenha" type="password" class="form-control" placeholder="Senha">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirmar Senha *</label>
                                <input id="inputConfirmarSenha" type="password" class="form-control" placeholder="Confirmar Senha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Atividade *</label>
                                <input id="inputAtividade" type="text" class="form-control" placeholder="Descreva suas atividades na instituição">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-6" id="inputsFormacoes">
                                    <label>Formações * <a href="javascript:;" data-toggle="modal" data-target="#modalNovaFormacao">(Não encontrou a sua? Clique aqui)</a></label>
                                    <label class="label label-info" style="color: white">Selecione todas as suas formações no campo abaixo.</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="divFormacoes" style="display: inline">
                                                <script>montaSelectFormacoes(0)</script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" id="inputsDisciplinas">
                                    <label>Disciplinas * <a href="javascript:;" data-toggle="modal" data-target="#modalNovaDisciplina">(Não encontrou a sua? Clique aqui)</a></label>
                                    <label class="label label-info" style="color: white">Selecione todas as suas disciplinas no campo abaixo.</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="divDisciplinas" style="display: inline">
                                                <script>montaSelectDisciplinas(0)</script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cargo *</label>
                                <input id="inputCargo" type="text" class="form-control" placeholder="Descreva seu cargo na instituição">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Inicial *</label>
                                <input id="inputDataInicial" type="date" class="form-control" placeholder="Data Inicial">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input id="inputDataFinal" type="date" class="form-control" placeholder="Data Final">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sobre mim *</label>
                                <textarea id="textareaSobre" rows="15" class="form-control" placeholder="Aqui você deve escrever sua descrição que aparecerá no seu site."></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="salvarProfessor()">Cadastrar Professor</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <input type="file" id="imagemCapa" onchange="uploadImagemCapa()" style="display:none"/>
                <input type="text" id="urlImagemCapa" value="" style="display: none" hidden=""/>
                <label onclick="$('#imagemCapa').trigger('click');" style="position:absolute; color: white; cursor: pointer; margin-left: 10px; margin-top: 10px">Editar Capa</label>
                <div id="divImagemCapa">
                    <?php
                    echo "<img src='" . $capaPadrao . "'/>";
                    ?>
                </div>
            </div>
            <div class="content">
                <div class="author">
                    <div id="divFotoPerfil">
                        <?php
                        echo "<img class='avatar border-gray' src='" . $fotoPerfilPadrao . "' alt='Editar Foto'/>";
                        ?>
                    </div>
                    <label id="uploadFotoTxt" onclick="$('#fotoPerfil').trigger('click');">Editar Foto</label>
                    <input type="file" id="fotoPerfil" onchange="uploadFotoPerfil()" style="display:none"/>
                    <input type="text" id="urlFotoPerfil" value="" style="display: none" hidden=""/><br>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Facebook URL (opcional)</label>
                            <input id="inputFacebook" type="text" class="form-control" placeholder="Facebook">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Twitter URL (opcional)</label>
                            <input id="inputTwitter" type="text" class="form-control" placeholder="Twitter">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Google URL (opcional)</label>
                            <input id="inputGoogle" type="text" class="form-control" placeholder="Google">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Instagram URL (opcional)</label>
                            <input id="inputInstagram" type="text" class="form-control" placeholder="Instagram">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>LinkedIn URL (opcional)</label>
                            <input id="inputLinkedin" type="text" class="form-control" placeholder="LinkedIn">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#inputTelefone').mask("(99) 9 9999-9999");
        $('#selectFormacoes').multiselect({
            enableFiltering: true
        });
        $('#selectDisciplinas').multiselect({
            enableFiltering: true
        });
    });
</script>
