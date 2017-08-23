var cadastrarFormacao = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/novo.php');
}

var editarFormacao = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/editar.php?id=' + id);
}

var removerFormacao = function (id, nomeFormacao) {
    swal({
        title: "Você tem certeza?",
        text: nomeFormacao + " será deletada permanentemente!",
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
                        "idFormacao": id
                    };

                    $.ajax({
                        url: "assets/actions/Formacao_RemoverFormacao.php",
                        type: "post",
                        data: postData,
                        dataType: 'json',
                        success: function (data) {
                            if (data.sucesso == true) {
                                $.notify({
                                    icon: 'pe-7s-check',
                                    message: "Formação removida com sucesso!"
                                }, {
                                    type: 'success',
                                    timer: 1000
                                });
                                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/index.php');
                            } else if (data.em_uso == true) {
                                $.notify({
                                    icon: 'pe-7s-close-circle',
                                    message: "A formação selecionada não pode ser deletada porque está em uso!"
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

                    //swal("Deletado!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelado", "O item está à salvo, ufa!", "error");
                }
            });
}

var atualizaFormacao = function (idFormacao) {
    var inputNomeFormacao = $('#inputNomeFormacao').val();

    var postData = {
        "idFormacao": idFormacao,
        "inputNomeFormacao": inputNomeFormacao
    };

    $.ajax({
        url: "assets/actions/Formacao_AtualizarFormacao.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Formação atualizada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/editar.php?id=' + idFormacao);
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

var salvarFormacao = function () {
    var inputNomeFormacao = $('#inputNomeFormacao').val();

    var postData = {
        "inputNomeFormacao": inputNomeFormacao
    };

    $.ajax({
        url: "assets/actions/Formacao_NovaFormacao.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Formação cadastrada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/index.php');
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

var montaSelectFormacoes = function (idProfessor) {
    if (idProfessor == '') {
        idProfessor = 0;
    }
    $.ajax({
        url: "assets/util/JSONFormacoes.php?id=" + idProfessor,
        type: "get",
        dataType: 'json',
        success: function (data) {
            var obj = JSON.parse(JSON.stringify(data));
            var count = Object.keys(obj).length;
            var idFormacao = [];
            var nomeFormacao = [];
            var selecionado = [];

            for (var i = 0; i < count; i++) {
                idFormacao.push(JSON.stringify(obj[i].id).replace(/(")/g, ""));
                nomeFormacao.push(JSON.stringify(obj[i].nomeFormacao).replace(/(")/g, ""));
                selecionado.push(JSON.stringify(obj[i].selecionado).replace(/(")/g, ""));
            }

            var htmlStr = '';
            htmlStr += '<select id="selectFormacoes" multiple="multiple">';
            for (var i = 0; i < count; i++) {
                if (selecionado[i] == "true") {
                    htmlStr += '<option selected value="' + idFormacao[i] + '">' + nomeFormacao[i] + '</option>';
                } else {
                    htmlStr += '<option value="' + idFormacao[i] + '">' + nomeFormacao[i] + '</option>';
                }
            }
            htmlStr += '</select>';
            $('#divFormacoes').html(htmlStr);
            $('#selectFormacoes').multiselect({
                enableFiltering: true
            });
        },
    });
}

var salvarFormacaoModal = function () {
    var inputIDProfessor = $('#inputID').val();
    var inputNomeFormacao = $('#inputNomeFormacaoModal').val();

    var postData = {
        "inputNomeFormacao": inputNomeFormacao
    };

    $.ajax({
        url: "assets/actions/Formacao_NovaFormacao.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Formação cadastrada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $('#modalNovaFormacao').modal('hide');
                montaSelectFormacoes(inputIDProfessor);
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