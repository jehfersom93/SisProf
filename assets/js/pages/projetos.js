var cadastrarProjeto = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/novo.php');
}

var editarProjeto = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/editar.php?id=' + id);
}

var removerProjeto = function (id, tituloProjeto) {
    swal({
        title: "Você tem certeza?",
        text: tituloProjeto + " será deletado permanentemente!",
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
                        "idProjeto": id
                    };

                    $.ajax({
                        url: "assets/actions/Projeto_RemoverProjeto.php",
                        type: "post",
                        data: postData,
                        dataType: 'json',
                        success: function (data) {
                            if (data.sucesso == true) {
                                $.notify({
                                    icon: 'pe-7s-check',
                                    message: "Projeto removido com sucesso!"
                                }, {
                                    type: 'success',
                                    timer: 1000
                                });
                                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/index.php');
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

var salvarProjeto = function (idProfessor) {
    var inputTituloProjeto = $('#inputTituloProjeto').val();
    var textareaDescricaoProjeto = $('#textareaDescricaoProjeto').val();

    var postData = {
        "inputTituloProjeto": inputTituloProjeto,
        "textareaDescricaoProjeto": textareaDescricaoProjeto,
        "idProfessor": idProfessor
    };

    $.ajax({
        url: "assets/actions/Projeto_NovoProjeto.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Projeto cadastrado com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/index.php');
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

var atualizarProjeto = function (idProjeto) {
    var inputTituloProjeto = $('#inputTituloProjeto').val();
    var textareaDescricaoProjeto = $('#textareaDescricaoProjeto').val();

    var postData = {
        "inputTituloProjeto": inputTituloProjeto,
        "textareaDescricaoProjeto": textareaDescricaoProjeto,
        "idProjeto": idProjeto
    };

    $.ajax({
        url: "assets/actions/Projeto_AtualizarProjeto.php",
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Projeto atualizado com sucesso!"
                }, {
                    type: 'success',
                    timer: 1000
                });
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/index.php');
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