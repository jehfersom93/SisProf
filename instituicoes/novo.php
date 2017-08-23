<?php
include_once '../assets/util/connect.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title" style="display: inline-block">Nova Instituição</h4>
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
                                <label for="inputNomeInstituicao">Nome Instituição *</label>
                                <input id="inputNomeInstituicao" type="text" class="form-control" placeholder="Nome da Instituição">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="salvarInstituicao()">Cadastrar Instituição</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
