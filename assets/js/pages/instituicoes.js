var cadastrarInstituicao = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/novo.php');
}

var editarInstituicao = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/editar.php?id=' + id);
}

var removerInstituicao = function (id, nomeInstituicao) {
    swal({
        title: "Você tem certeza?",
        text: nomeInstituicao + " será deletada permanentemente!",
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
                        "idInstituicao": id
                    };

                    $.ajax({
                        url: "assets/actions/Instituicao_RemoverInstituicao.php",
                        type: "post",
                        data: postData,
                        dataType: 'json',
                        success: function (data) {
                            if (data.sucesso == true) {
                                $.notify({
                                    icon: 'pe-7s-check',
                                    message: "Instituição removida com sucesso!"
                                }, {
                                    type: 'success',
                                    timer: 1000
                                });
                                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/index.php');
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

var atualizaInstituicao = function (idInstituicao) {
    var inputNomeInstituicao = $('#inputNomeInstituicao').val();

    var postData = {
        "idInstituicao": idInstituicao,
        "inputNomeInstituicao": inputNomeInstituicao
    };

    $.ajax({
        url: "assets/actions/Instituicao_AtualizarInstituicao.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Instituição atualizada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/editar.php?id=' + idInstituicao);
            } else if (data.existente == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Ops, parece que algum dado digitado já é existente!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
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

var salvarInstituicao = function () {
    var inputNomeInstituicao = $('#inputNomeInstituicao').val();

    var postData = {
        "inputNomeInstituicao": inputNomeInstituicao
    };

    $.ajax({
        url: "assets/actions/Instituicao_NovaInstituicao.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Instituição cadastrada com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/index.php');
            } else if (data.existente == true) {
                $.notify({
                    icon: 'pe-7s-close-circle',
                    message: "Ops, parece que algum dado digitado já é existente!"
                }, {
                    type: 'warning',
                    timer: 1000
                });
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