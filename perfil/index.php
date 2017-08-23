<?php
include_once '../assets/util/connect.php';

$idProfessorLogado = "1"; // provisório
$sql = $mysqli->query("SELECT admProfessor FROM professor WHERE id=" . $idProfessorLogado);
while ($row = $sql->fetch_array()) {
    $admProfessor = $row['admProfessor'];
}

$idProfessor = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sql = $mysqli->query("SELECT * FROM professor WHERE id=" . $idProfessor);
while ($row = $sql->fetch_array()) {
    $nomeProfessor = $row['nomeProfessor'];
    $senhaProfessor = $row['senhaProfessor'];
    $facebookProfessor = $row['facebookProfessor'];
    $twitterProfessor = $row['twitterProfessor'];
    $googleProfessor = $row['googleProfessor'];
    $instagramProfessor = $row['instagramProfessor'];
    $linkedinProfessor = $row['linkedinProfessor'];
    $urlFotoProfessor = $row['urlFotoProfessor'];
    $urlCapaProfessor = $row['urlCapaProfessor'];
    $cssStyleProfessor = $row['cssStyleProfessor'];
    $urlCurriculumProfessor = $row['urlCurriculumProfessor'];
    $textoSobreProfessor = $row['textoSobreProfessor'];
    $cidadeProfessor = $row['cidadeProfessor'];
    $estadoProfessor = $row['estadoProfessor'];
    $enderecoProfessor = $row['enderecoProfessor'];
    $telefoneProfessor = $row['telefoneProfessor'];
    $emailProfessor = $row['emailProfessor'];
}

$sql = $mysqli->query("SELECT professor_instituicao.idInstituicao, professor_instituicao.cargoProfessor, professor_instituicao.atividadeProfessor, professor_instituicao.dataInicial, professor_instituicao.dataFinal, instituicao.nomeInstituicao FROM professor_instituicao INNER JOIN instituicao ON instituicao.id=professor_instituicao.idInstituicao WHERE professor_instituicao.idProfessor=" . $idProfessor);
while ($row = $sql->fetch_array()) {
    $idInstituicao = $row['idInstituicao'];
    $nomeInstituicao = $row['nomeInstituicao'];
    $cargoProfessor = $row['cargoProfessor'];
    $atividadeProfessor = $row['atividadeProfessor'];
    $dataInicial = $row['dataInicial'];
    $dataFinal = $row['dataFinal'];
}

$sql = $mysqli->query("SELECT * FROM configuracoes");
while ($row = $sql->fetch_array()) {
    $capaPadrao = $row['capaPadrao'];
    $fotoPerfilPadrao = $row['fotoPerfilPadrao'];
}
?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Editar Perfil</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input disabled id="inputID" type="text" class="form-control" placeholder="ID" value="<?php echo $idProfessor ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Instituição</label>
                                <select disabled class="form-control" placeholder="Instituição" id="selectInstituicao">
                                    <?php
                                    $sql = $mysqli->query("SELECT * FROM instituicao");
                                    while ($row = $sql->fetch_array()) {
                                        if ($row['id'] == $idInstituicao) {
                                            echo "<option selected value='" . $row['id'] . "'>" . $row['nomeInstituicao'] . "</option>";
                                        } else {
                                            echo "<option value='" . $row['id'] . "'>" . $row['nomeInstituicao'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Endereço de E-mail *</label>
                                <input id="inputEmail" type="email" class="form-control" placeholder="Email" value="<?php echo $emailProfessor ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input id="inputNome" type="text" class="form-control" placeholder="Nome Completo" value="<?php echo $nomeProfessor ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefone (opcional)</label>
                                <input id="inputTelefone" type="text" class="form-control" placeholder="Telefone" value="<?php echo $telefoneProfessor ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Estado *</label>
                                <select class="form-control" placeholder="Estado" id="selectEstado" onchange="selectCarregaMunicipios()">
                                    <?php
                                    $sql = $mysqli->query("SELECT uf FROM estado");
                                    while ($row = $sql->fetch_array()) {
                                        if ($row['uf'] == $estadoProfessor) {
                                            echo "<option selected value='" . $row['uf'] . "'>" . $row['uf'] . "</option>";
                                            $ufSelecionada = $estadoProfessor;
                                        } else {
                                            echo "<option value='" . $row['uf'] . "'>" . $row['uf'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cidade *</label>
                                <select class="form-control" placeholder="Cidade" id="selectCidade">
                                    <?php
                                    if (!is_null($ufSelecionada) && !empty($ufSelecionada)) {
                                        $sql = $mysqli->query("SELECT nome FROM municipio WHERE uf='" . $ufSelecionada . "'");
                                        while ($row = $sql->fetch_array()) {
                                            if ($cidadeProfessor == $row['nome']) {
                                                echo "<option selected value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                                            } else {
                                                echo "<option value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Endereço (opcional)</label>
                                <input id="inputEndereco" type="text" class="form-control" placeholder="Endereço" value="<?php echo $enderecoProfessor ?>">
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
                                <input id="inputCurriculo" type="text" class="form-control" placeholder="URL Currículo Lattes" value="<?php echo $urlCurriculumProfessor ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Senha Atual</label>
                                <input disabled id="inputSenhaAtual" type="text" class="form-control" placeholder="Senha Atual" value="<?php echo $senhaProfessor ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nova Senha (opcional)</label>
                                <input id="inputNovaSenha" type="password" class="form-control" placeholder="Nova Senha">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirmar Senha (opcional)</label>
                                <input id="inputConfirmarSenha" type="password" class="form-control" placeholder="Confirmar Senha">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Atividade *</label>
                                <input id="inputAtividade" type="text" class="form-control" placeholder="Descreva suas atividades na instituição" value="<?php echo $atividadeProfessor ?>">
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
                                                <script>montaSelectFormacoes(<?php echo $idProfessor ?>)</script>
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
                                                <script>montaSelectDisciplinas(<?php echo $idProfessor ?>)</script>
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
                                <input id="inputCargo" type="text" class="form-control" placeholder="Descreva seu cargo na instituição" value="<?php echo $cargoProfessor ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Inicial *</label>
                                <input id="inputDataInicial" type="date" class="form-control" placeholder="Data Inicial" value="<?php echo $dataInicial ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input id="inputDataFinal" type="date" class="form-control" placeholder="Data Final" value="<?php echo $dataFinal ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Sobre mim *</label>
                                <textarea id="textareaSobre" rows="15" class="form-control" placeholder="Aqui você deve escrever sua descrição que aparecerá no seu site."><?php echo $textoSobreProfessor ?></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="atualizaPerfil(<?php echo $idProfessor ?>)">Atualizar Perfil</button>
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
                <label onclick="$('#imagemCapa').trigger('click');" id="lblEditarCapa" style="position:absolute; color: white; cursor: pointer; margin-left: 10px; margin-top: 10px">Editar Capa</label>
                <div id="divImagemCapa">
                    <?php
                    if (!is_null($urlCapaProfessor) && !empty($urlCapaProfessor)) {
                        echo "<img src='" . $urlCapaProfessor . "' alt='" . $nomeProfessor . "'/>";
                    } else if ($urlCapaProfessor == $capaPadrao) {
                        echo "<img src='" . $capaPadrao . "'/>";
                    } else {
                        echo "<img src='" . $capaPadrao . "'/>";
                    }
                    ?>
                </div>
            </div>
            <div class="content">
                <div class="author">
                    <div id="divFotoPerfil">
                        <?php
                        if (!is_null($urlFotoProfessor) && !empty($urlFotoProfessor)) {
                            echo "<img class='avatar border-gray' src='" . $urlFotoProfessor . "' alt='" . $nomeProfessor . "'/>";
                        } else {
                            echo "<img class='avatar border-gray' src='" . $fotoPerfilPadrao . "' alt='Editar Foto'/>";
                        }
                        ?>
                    </div>
                    <label id="uploadFotoTxt" onclick="$('#fotoPerfil').trigger('click');">Editar Foto</label>
                    <input type="file" id="fotoPerfil" onchange="uploadFotoPerfil()" style="display:none"/>
                    <input type="text" id="urlFotoPerfil" value="" style="display: none" hidden=""/><br>
                    <h4 class="title"><?php echo $nomeProfessor ?><br />
                        <small><?php echo $emailProfessor ?></small>
                    </h4>
                </div>
                <p class="description text-center"> <?php echo $cargoProfessor ?> <br>
                    <?php echo $cidadeProfessor ?> <br>
                    <?php echo $telefoneProfessor ?>
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Facebook URL (opcional)</label>
                            <input id="inputFacebook" type="text" class="form-control" placeholder="Facebook" value="<?php echo $facebookProfessor ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Twitter URL (opcional)</label>
                            <input id="inputTwitter" type="text" class="form-control" placeholder="Twitter" value="<?php echo $twitterProfessor ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Google URL (opcional)</label>
                            <input id="inputGoogle" type="text" class="form-control" placeholder="Google" value="<?php echo $googleProfessor ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Instagram URL (opcional)</label>
                            <input id="inputInstagram" type="text" class="form-control" placeholder="Instagram" value="<?php echo $instagramProfessor ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>LinkedIn URL (opcional)</label>
                            <input id="inputLinkedin" type="text" class="form-control" placeholder="LinkedIn" value="<?php echo $linkedinProfessor ?>">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <?php
                if (!is_null($facebookProfessor) && !empty($facebookProfessor)) {
                    echo "<button onclick='window.location = '" . $facebookProfessor . "' class='btn btn-simple'><i class='fa fa-facebook-square'></i></button>";
                }
                if (!is_null($twitterProfessor) && !empty($twitterProfessor)) {
                    echo "<button onclick='window.location = '" . $twitterProfessor . "' class='btn btn-simple'><i class='fa fa-twitter'></i></button>";
                }
                if (!is_null($googleProfessor) && !empty($googleProfessor)) {
                    echo "<button onclick='window.location = '" . $googleProfessor . "' class='btn btn-simple'><i class='fa fa-google-plus-square'></i></button>";
                }
                if (!is_null($instagramProfessor) && !empty($instagramProfessor)) {
                    echo "<button onclick='window.location = '" . $instagramProfessor . "' class='btn btn-simple'><i class='fa fa-instagram'></i></button>";
                }
                if (!is_null($linkedinProfessor) && !empty($linkedinProfessor)) {
                    echo "<button onclick='window.location = '" . $linkedinProfessor . "' class='btn btn-simple'><i class='fa fa-linkedin-square'></i></button>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    if ($admProfessor) {

        while ($row = $sql->fetch_array()) {
            
        }
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Opções de Acesso</h4>
                    <p class="category">Quadro de opções de acesso do professor.</p>
                </div>
                <div class="content">
                    <div class="table-full-width">
                        <table class="table">
                            <tbody>
                                <?php
                                $sql = $mysqli->query("SELECT * FROM opcoes_acesso ORDER BY descricaoAcesso ASC");
                                while ($row = $sql->fetch_array()) {
                                    $idOpcaoAcesso = $row['id'];
                                    $descricaoAcesso = $row['descricaoAcesso'];
                                    echo "<tr>";
                                    echo "<td>";
                                    $sql2 = $mysqli->query("SELECT * FROM professor_opcoes_acesso WHERE idProfessor=" . $idProfessor . " AND idOpcaoAcesso=" . $row['id']);
                                    if ($sql2->num_rows > 0) {
                                        while ($row2 = $sql2->fetch_array()) {
                                            if ($idOpcaoAcesso == $row2['idOpcaoAcesso']) {
                                                echo "<label onclick='opcaoAcesso(" . $idProfessor . "," . $row2['idOpcaoAcesso'] . ")' class='checkbox'>";
                                                echo "<input id='opcaoAcesso" . $row2['idOpcaoAcesso'] . "' type='checkbox' data-toggle='checkbox' checked=''>";
                                                //echo "<input id='opcaoAcesso" . $row2['idOpcaoAcesso'] . "' type='checkbox' checked>";
                                                echo "</label>";
                                            }
                                        }
                                    } else {
                                        echo "<label onclick='opcaoAcesso(" . $idProfessor . "," . $idOpcaoAcesso . ")' class='checkbox'>";
                                        echo "<input id='opcaoAcesso" . $idOpcaoAcesso . "' type='checkbox' data-toggle='checkbox'>";
                                        //echo "<input id='opcaoAcesso" . $idOpcaoAcesso . "' type='checkbox'>";
                                        echo "</label>";
                                    }
                                    echo "</td>";
                                    echo "<td>" . $descricaoAcesso . "";
                                    echo "<td class='td-actions text-right'></td>";
                                    echo "</tr>";
                                    ?>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="footer">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-lock"></i> A manipulação de acesso é feita somente por administradores.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

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
