var cadastrarProfessor = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'professores/novo.php');
}

var editarProfessor = function (id) {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'perfil/index.php?id=' + id);
}

var removerProfessor = function (id, nomeProfessor) {
    swal({
        title: "Você tem certeza?",
        text: nomeProfessor + " será deletado permanentemente!",
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
                        "idProfessor": id
                    };

                    $.ajax({
                        url: "assets/actions/Professor_RemoverProfessor.php",
                        type: "post",
                        data: postData,
                        dataType: 'json',
                        success: function (data) {
                            if (data.sucesso == true) {
                                $.notify({
                                    icon: 'pe-7s-check',
                                    message: "Professor removido com sucesso!"
                                }, {
                                    type: 'success',
                                    timer: 1000
                                });
                                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'professores/index.php');
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
                    swal("Cancelado", "O professor está à salvo, ufa!", "error");
                }
            });
}

var salvarProfessor = function () {
    var selectInstituicao = $('#selectInstituicao').val();
    var inputEmail = $('#inputEmail').val();
    var inputNome = $('#inputNome').val();
    var inputTelefone = $('#inputTelefone').val();
    var selectEstado = $('#selectEstado').val();
    var selectCidade = $('#selectCidade').val();
    var inputEndereco = $('#inputEndereco').val();
    var inputCurriculo = $('#inputCurriculo').val();
    var inputFacebook = $('#inputFacebook').val();
    var inputTwitter = $('#inputTwitter').val();
    var inputGoogle = $('#inputGoogle').val();
    var inputInstagram = $('#inputInstagram').val();
    var inputLinkedin = $('#inputLinkedin').val();
    var inputUrlFotoPerfil = $('#urlFotoPerfil').val();
    var inputUrlImagemCapa = $('#urlImagemCapa').val();
    var inputSenha = $('#inputSenha').val();
    var inputConfirmarSenha = $('#inputConfirmarSenha').val();
    var inputCargo = $('#inputCargo').val();
    var inputDataInicial = $('#inputDataInicial').val();
    var inputDataFinal = $('#inputDataFinal').val();
    var inputAtividade = $('#inputAtividade').val();
    var textareaSobre = $('#textareaSobre').val();

    var selectFormacoes = {};
    $('#selectFormacoes :selected').each(function (i, selected) {
        selectFormacoes[i] = $(selected).val();
    });

    var selectDisciplinas = {};
    $('#selectDisciplinas :selected').each(function (i, selected) {
        selectDisciplinas[i] = $(selected).val();
    });

    var nomeValido = false;
    var emailValido = false;
    var senhaValida = false;
    var cidadeValida = false;
    var estadoValido = false;
    var cargoValido = false;
    var dataInicialValida = false;
    var atividadeValida = false;
    var formacaoValida = false;
    var disciplinaValida = false;
    var textareaSobreValido = false;

    if (inputNome != '') {
        nomeValido = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve preencher o campo 'Nome Completo'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (selectCidade != '') {
        cidadeValida = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve escolher uma cidade. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (selectEstado != '') {
        estadoValido = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve escolher um estado. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (inputCargo != '') {
        cargoValido = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve descrever suas atividades dentro da instituição no campo 'Atividades'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

//    (function () {
//        Date.prototype.paraYMD = dataParaYMD;
//        var dataParaYMD = function (_ano, _mes, _dia) {
//            var ano, mes, dia;
//            ano = String(_ano);
//            mes = String(_mes + 1);
//            if (mes.length == 1) {
//                mes = "0" + mes;
//            }
//            dia = String(_dia);
//            if (dia.length == 1) {
//                dia = "0" + dia;
//            }
//            return ano + "-" + mes + "-" + dia;
//        }
//    })();
    if (inputDataFinal != '' && inputDataInicial == '') {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve inserir sua data inicial na instituição no campo 'Data Inicial'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    } else if (inputDataInicial != '' && inputDataFinal != '') {
        dataInicialValida = true;
    } else if (inputDataInicial != '') {
        dataInicialValida = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve inserir sua data inicial na instituição no campo 'Data Inicial'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (selectFormacoes[0] != null) {
        formacaoValida = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve selecionar pelo menos uma formação acadêmica no campo 'Formações'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (selectDisciplinas[0] != null) {
        disciplinaValida = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve selecionar pelo menos uma disciplina no campo 'Disciplinas'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (inputAtividade != '') {
        atividadeValida = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve descrever suas atividades dentro da instituição no campo 'Atividades'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    if (textareaSobre != '') {
        textareaSobreValido = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve escrever uma descrição sobre seu perfil no campo 'Sobre Mim'. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
    }

    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (testEmail.test(inputEmail)) {
        emailValido = true;
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "O email digitado não é válido. Tente novamente."
        }, {
            type: 'warning',
            timer: 1000
        });
        inputEmail.focus;
    }

    if (inputSenha != '') {
        if (inputSenha.length < 8) {
            $.notify({
                icon: 'pe-7s-close-circle',
                message: "A senha deve possuir no mínimo 8 caracteres. Tente novamente."
            }, {
                type: 'warning',
                timer: 1000
            });
            inputSenha.focus;
        } else if (inputConfirmarSenha == '') {
            $.notify({
                icon: 'pe-7s-close-circle',
                message: "Você deve preencher o campo 'Confirmar Senha'."
            }, {
                type: 'warning',
                timer: 1000
            });
            inputConfirmarSenha.focus;
        } else if (inputSenha != inputConfirmarSenha) {
            $.notify({
                icon: 'pe-7s-close-circle',
                message: "As senhas digitadas não são iguais. Tente novamente."
            }, {
                type: 'warning',
                timer: 1000
            });
            inputConfirmarSenha.focus;
        } else {
            senhaValida = true;
        }
    } else {
        $.notify({
            icon: 'pe-7s-close-circle',
            message: "Você deve preencher o campo 'Senha'."
        }, {
            type: 'warning',
            timer: 1000
        });
        inputSenha.focus;
    }

    if (emailValido && senhaValida && nomeValido && cidadeValida && estadoValido && textareaSobreValido && atividadeValida && cargoValido && dataInicialValida && formacaoValida && disciplinaValida) {
        var postData = {
            "inputEmail": inputEmail,
            "inputNome": inputNome,
            "inputTelefone": inputTelefone,
            "idInstituicao": selectInstituicao,
            "selectEstado": selectEstado,
            "selectCidade": selectCidade,
            "inputEndereco": inputEndereco,
            "inputCurriculo": inputCurriculo,
            "inputUrlFotoPerfil": inputUrlFotoPerfil,
            "inputUrlImagemCapa": inputUrlImagemCapa,
            "inputFacebook": inputFacebook,
            "inputTwitter": inputTwitter,
            "inputGoogle": inputGoogle,
            "inputInstagram": inputInstagram,
            "inputLinkedin": inputLinkedin,
            "inputSenha": inputSenha,
            "inputCargo": inputCargo,
            "inputDataInicial": inputDataInicial,
            "inputDataFinal": inputDataFinal,
            "selectFormacoes": selectFormacoes,
            "selectDisciplinas": selectDisciplinas,
            "inputAtividade": inputAtividade,
            "textareaSobre": textareaSobre
        };

        $.ajax({
            url: "assets/actions/Professor_NovoProfessor.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    $.notify({
                        icon: 'pe-7s-check',
                        message: "Professor cadastrado com sucesso!"
                    }, {
                        type: 'success',
                        timer: 1000
                    });
                    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'professores/index.php');
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
}