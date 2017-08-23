var uploadThumbDisciplina = function () {
    var file_data = $('#thumbDisciplina').prop('files')[0];
    var form_data = new FormData();
    form_data.append('imagem', file_data);
    var htmlStr = '';
    htmlStr += "<input id='inputUrlThumbDisciplina' type='text' class='form-control' value='Carregando imagem...'>";
    htmlStr += '<span class="input-group-btn">';
    htmlStr += '<button class="btn btn-info btn-fill" type="button" onclick="$("#thumbDisciplina").trigger("click");"><i class="fa fa-upload" aria-hidden="true"></i></button>';
    htmlStr += '</span>';
    $('#divInputThumbDisciplina').html(htmlStr);
    $.ajax({
        url: 'assets/util/Upload_Imagem.php',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            if (data.sucesso == true) {
                var htmlStr = '';
                htmlStr += "<input id='inputUrlThumbDisciplina' type='text' class='form-control' placeholder='URL Imagem Pequena' value='painel/" + data.url + "'>";
                htmlStr += '<span class="input-group-btn">';
                htmlStr += '<button class="btn btn-info btn-fill" type="button" onclick="$("#thumbDisciplina").trigger("click");"><i class="fa fa-upload" aria-hidden="true"></i></button>';
                htmlStr += '</span>';
                $('#divInputThumbDisciplina').html(htmlStr);
            } else if (data.erro_salvar == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Erro ao salvar imagem no servidor!"
                }, {
                    type: 'danger',
                    timer: 1000
                });
            } else if (data.erro_formato == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Somente os formatos jpg, jpeg, e png são permitidos!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
            } else if (data.erro_vazio == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Nenhum arquivo selecionado! Tente novamente."
                }, {
                    type: 'warning',
                    timer: 1000
                });
            }
        }
    });
}

var uploadFotoDisciplina = function () {
    var file_data = $('#fotoDisciplina').prop('files')[0];
    var form_data = new FormData();
    form_data.append('imagem', file_data);
    var htmlStr = '';
    htmlStr += "<input id='inputUrlFotoDisciplina' type='text' class='form-control' value='Carregando imagem...'>";
    htmlStr += '<span class="input-group-btn">';
    htmlStr += '<button class="btn btn-info btn-fill" type="button" onclick="$("#fotoDisciplina").trigger("click");"><i class="fa fa-upload" aria-hidden="true"></i></button>';
    htmlStr += '</span>';
    $('#divInputFotoDisciplina').html(htmlStr);
    $.ajax({
        url: 'assets/util/Upload_Imagem.php',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            if (data.sucesso == true) {
                var htmlStr = '';
                htmlStr += "<input id='inputUrlFotoDisciplina' type='text' class='form-control' placeholder='URL Imagem Capa' value='painel/" + data.url + "'>";
                htmlStr += '<span class="input-group-btn">';
                htmlStr += '<button class="btn btn-info btn-fill" type="button" onclick="$("#fotoDisciplina").trigger("click");"><i class="fa fa-upload" aria-hidden="true"></i></button>';
                htmlStr += '</span>';
                $('#divInputFotoDisciplina').html(htmlStr);
            } else if (data.erro_salvar == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Erro ao salvar imagem no servidor!"
                }, {
                    type: 'danger',
                    timer: 1000
                });
            } else if (data.erro_formato == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Somente os formatos jpg, jpeg, e png são permitidos!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
            } else if (data.erro_vazio == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Nenhum arquivo selecionado! Tente novamente."
                }, {
                    type: 'warning',
                    timer: 1000
                });
            }
        }
    });
}

var cadastrarDisciplina = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/novo.php');
}

var editarDisciplina = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/editar.php?id=' + id);
}

var removerDisciplina = function (id, nomeDisciplina) {
    swal({
        title: "Você tem certeza?",
        text: nomeDisciplina + " será deletada permanentemente!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, delete isso!",
        cancelButtonText: "Não, cancele por favor!",
        closeOnConfirm: true,
        closeOnCancel: false
    },
            function (isConfirm) {
                if (isConfirm) {
                    var postData = {
                        "idDisciplina": id
                    };

                    $.ajax({
                        url: "assets/actions/Disciplina_RemoverDisciplina.php",
                        type: "post",
                        data: postData,
                        dataType: 'json',
                        success: function (data) {
                            if (data.sucesso == true) {
                                $.notify({
                                    icon: 'pe-7s-check',
                                    message: "Disciplina removida com sucesso!"
                                }, {
                                    type: 'success',
                                    timer: 1000
                                });
                                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/index.php');
                            } else if (data.em_uso == true) {
                                $.notify({
                                    icon: 'pe-7s-close-circle',
                                    message: "A disciplina selecionada não pode ser deletada porque está em uso!"
                                }, {
                                    type: 'warning',
                                    timer: 1000
                                });
                            } else if (data.erro_sql == true) {
                                $.notify({
                                    icon: 'pe-7s-close-circle',
                                    message: "Ops, parece que ocorreu um erro com o banco de dados, tente novamente."
                                }, {
                                    type: 'danger',
                                    timer: 1000
                                });
                            }
                        },
                    });
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelado", "O item está à salvo, ufa!", "error");
                }
            });
}

var atualizaDisciplina = function (idDisciplina) {
    var inputNomeDisciplina = $('#inputNomeDisciplina').val();
    var textareaDescricaoDisciplina = $('#textareaDescricaoDisciplina').val();
    var inputTagsDisciplina = $('#inputTagsDisciplina').val();
    var inputUrlThumbDisciplina = $('#inputUrlThumbDisciplina').val();
    var inputUrlFotoDisciplina = $('#inputUrlFotoDisciplina').val();
    var inputUrlSiteDisciplina = $('#inputUrlSiteDisciplina').val();

    var postData = {
        "idDisciplina": idDisciplina,
        "inputNomeDisciplina": inputNomeDisciplina,
        "textareaDescricaoDisciplina": textareaDescricaoDisciplina,
        "inputTagsDisciplina": inputTagsDisciplina,
        "inputUrlThumbDisciplina": inputUrlThumbDisciplina,
        "inputUrlFotoDisciplina": inputUrlFotoDisciplina,
        "inputUrlSiteDisciplina": inputUrlSiteDisciplina,
    };

    $.ajax({
        url: "assets/actions/Disciplina_AtualizarDisciplina.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Disciplina atualizada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/editar.php?id=' + idDisciplina);
            } else if (data.campos == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Você precisa preencher todos os campos obrigatórios!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
            } else if (data.erro_sql == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Ops, parece que ocorreu um erro com o banco de dados, tente novamente."
                }, {
                    type: 'danger',
                    timer: 1000
                });
            }
        },
    });
}

var salvarDisciplina = function () {
    var inputNomeDisciplina = $('#inputNomeDisciplina').val();
    var textareaDescricaoDisciplina = $('#textareaDescricaoDisciplina').val();
    var inputTagsDisciplina = $('#inputTagsDisciplina').val();
    var inputUrlThumbDisciplina = $('#inputUrlThumbDisciplina').val();
    var inputUrlFotoDisciplina = $('#inputUrlFotoDisciplina').val();
    var inputUrlSiteDisciplina = $('#inputUrlSiteDisciplina').val();

    var postData = {
        "inputNomeDisciplina": inputNomeDisciplina,
        "textareaDescricaoDisciplina": textareaDescricaoDisciplina,
        "inputTagsDisciplina": inputTagsDisciplina,
        "inputUrlThumbDisciplina": inputUrlThumbDisciplina,
        "inputUrlFotoDisciplina": inputUrlFotoDisciplina,
        "inputUrlSiteDisciplina": inputUrlSiteDisciplina,
    };

    $.ajax({
        url: "assets/actions/Disciplina_NovaDisciplina.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Disciplina cadastrada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/index.php');
            } else if (data.campos == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Você precisa preencher todos os campos obrigatórios!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
            } else if (data.erro_sql == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Ops, parece que ocorreu um erro com o banco de dados, tente novamente."
                }, {
                    type: 'danger',
                    timer: 1000
                });
            }
        },
    });
}

var montaSelectDisciplinas = function (idProfessor) {
    if (idProfessor == '') {
        idProfessor = 0;
    }
    $.ajax({
        url: "assets/util/JSONDisciplinas.php?id=" + idProfessor,
        type: "get",
        dataType: 'json',
        success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            var count = Object.keys(obj).length;
            var idDisciplina = [];
            var nomeDisciplina = [];
            var selecionado = [];

            for (var i = 0; i < count; i++) {
                idDisciplina.push(JSON.stringify(obj[i].id).replace(/(")/g, ""));
                nomeDisciplina.push(JSON.stringify(obj[i].nomeDisciplina).replace(/(")/g, ""));
                selecionado.push(JSON.stringify(obj[i].selecionado).replace(/(")/g, ""));
            }

            var htmlStr = '';
            htmlStr += '<select id="selectDisciplinas" multiple="multiple">';
            for (var i = 0; i < count; i++) {
                if (selecionado[i] == "true") {
                    htmlStr += '<option selected value="' + idDisciplina[i] + '">' + nomeDisciplina[i] + '</option>';
                } else {
                    htmlStr += '<option value="' + idDisciplina[i] + '">' + nomeDisciplina[i] + '</option>';
                }
            }
            htmlStr += '</select>';
            $('#divDisciplinas').html(htmlStr);
            $('#selectDisciplinas').multiselect({
                enableFiltering: true
            });
        },
    });
}

var salvarDisciplinaModal = function () {
    var inputIDProfessor = $('#inputID').val();
    var inputNomeDisciplina = $('#inputNomeDisciplinaModal').val();
    var textareaDescricaoDisciplina = $('#textareaDescricaoDisciplinaModal').val();
    var inputTagsDisciplina = $('#inputTagsDisciplinaModal').val();
    var inputUrlThumbDisciplina = $('#inputUrlThumbDisciplinaModal').val();
    var inputUrlFotoDisciplina = $('#inputUrlFotoDisciplinaModal').val();
    var inputUrlSiteDisciplina = $('#inputUrlSiteDisciplinaModal').val();

    var postData = {
        "inputNomeDisciplina": inputNomeDisciplina,
        "textareaDescricaoDisciplina": textareaDescricaoDisciplina,
        "inputTagsDisciplina": inputTagsDisciplina,
        "inputUrlThumbDisciplina": inputUrlThumbDisciplina,
        "inputUrlFotoDisciplina": inputUrlFotoDisciplina,
        "inputUrlSiteDisciplina": inputUrlSiteDisciplina,
    };

    $.ajax({
        url: "assets/actions/Disciplina_NovaDisciplina.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Disciplina cadastrada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $('#modalNovaDisciplina').modal('hide');
                montaSelectDisciplinas(inputIDProfessor);
            } else if (data.campos == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Você precisa preencher todos os campos obrigatórios!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
            } else if (data.erro_sql == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Ops, parece que ocorreu um erro com o banco de dados, tente novamente."
                }, {
                    type: 'danger',
                    timer: 1000
                });
            }
        },
    });
}