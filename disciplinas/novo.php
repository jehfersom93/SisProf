<?php
include_once '../assets/util/connect.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Nova Disciplina</h4>
                <label style="display: inline-block; float: right; color: #1dc7ea">* Campos obrigatórios</label>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>ID</label>
                                <input disabled="" id="inputID" type="text" class="form-control" placeholder="ID">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-group">
                                <label>Nome Disciplina *</label>
                                <input id="inputNomeDisciplina" type="text" class="form-control" placeholder="Nome da Disciplina">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Descrição *</label>
                                <textarea id="textareaDescricaoDisciplina" rows="15" class="form-control" placeholder="Aqui você deve escrever a descrição da disciplina."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tags (separadas por vírgula)</label>
                                <input id="inputTagsDisciplina" type="text" class="form-control" placeholder="Tags da Disciplina">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>URL Imagem Pequena *</label>
                            <input type="file" id="thumbDisciplina" onchange="uploadThumbDisciplina()" style="display:none"/>
                            <div class="input-group" id="divInputThumbDisciplina">
                                <input id="inputUrlThumbDisciplina" type="text" class="form-control" placeholder="URL Imagem Pequena">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-fill" type="button" onclick="$('#thumbDisciplina').trigger('click');"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>URL Imagem Capa *</label>
                            <input type="file" id="fotoDisciplina" onchange="uploadFotoDisciplina()" style="display:none"/>
                            <div class="input-group" id="divInputFotoDisciplina">
                                <input id="inputUrlFotoDisciplina" type="text" class="form-control" placeholder="URL Imagem Capa">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-fill" type="button" onclick="$('#fotoDisciplina').trigger('click');"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>URL Site</label>
                                <input id="inputUrlSiteDisciplina" type="text" class="form-control" placeholder="URL Site">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="salvarDisciplina()">Cadastrar Disciplina</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
