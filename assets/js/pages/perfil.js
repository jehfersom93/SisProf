var uploadFotoPerfil = function () {
    var file_data = $('#fotoPerfil').prop('files')[0];
    var form_data = new FormData();
    form_data.append('imagem', file_data);
    var htmlStr = '';
    htmlStr += "<img class='avatar border-gray' src='assets/img/loading.gif'/>";
    $('#divFotoPerfil').html(htmlStr);
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
                htmlStr += "<img class='avatar border-gray' src='" + data.url + "'/>";
                $('#divFotoPerfil').html(htmlStr);
                $('#urlFotoPerfil').val(data.url);
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

var uploadImagemCapa = function () {
    var file_data = $('#imagemCapa').prop('files')[0];
    var form_data = new FormData();
    form_data.append('imagem', file_data);
    $("#lblEditarCapa").text("Carregando...");
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
                htmlStr += "<img src='" + data.url + "'/>";
                $('#divImagemCapa').html(htmlStr);
                $('#urlImagemCapa').val(data.url);
                $("#lblEditarCapa").text("Editar Capa");
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

var selectCarregaMunicipios = function () {
    //$('#selectCidade').removeAttr("disabled");
    $.ajax({
        url: "assets/util/JSONMunicipiosPorUF.php?uf=" + $('#selectEstado').val(),
        type: "get",
        async: false,
        dataType: 'json',
        success: function (cidades) {
            var objCidades = JSON.parse(JSON.stringify(cidades));
            var count = Object.keys(objCidades).length;
            var nomeCidade = [];

            var htmlString = '';
            for (var i = 0; i < count; i++) {
                nomeCidade.push(JSON.stringify(objCidades[i].nome).replace(/(")/g, ""));
                htmlString += "<option value='" + nomeCidade[i] + "'>" + nomeCidade[i] + "</option>";
            }
            $('#selectCidade').html(htmlString);

            if ($('#selectEstado').val() == "RS") {
                $("#selectCidade").val("Santo Ângelo");
            }
        }
    });
}

var atualizaPerfil = function (idProfessor) {
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
    var inputNovaSenha = $('#inputNovaSenha').val();
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

    if (inputNovaSenha != '') {
        if (inputNovaSenha.length < 8) {
            $.notify({
                icon: 'pe-7s-close-circle',
                message: "A nova senha deve possuir no mínimo 8 caracteres. Tente novamente."
            }, {
                type: 'warning',
                timer: 1000
            });
            inputNovaSenha.focus;
        } else if (inputConfirmarSenha == '') {
            $.notify({
                icon: 'pe-7s-close-circle',
                message: "Você deve preencher o campo 'Confirmar Senha'."
            }, {
                type: 'warning',
                timer: 1000
            });
            inputConfirmarSenha.focus;
        } else if (inputNovaSenha != inputConfirmarSenha) {
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
        senhaValida = true;
    }

    if (emailValido && senhaValida && nomeValido && cidadeValida && estadoValido && textareaSobreValido && atividadeValida && cargoValido && dataInicialValida && formacaoValida && disciplinaValida) {
        var postData = {
            "idProfessor": idProfessor,
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
            "inputNovaSenha": inputNovaSenha,
            "inputCargo": inputCargo,
            "inputDataInicial": inputDataInicial,
            "inputDataFinal": inputDataFinal,
            "selectFormacoes": selectFormacoes,
            "selectDisciplinas": selectDisciplinas,
            "inputAtividade": inputAtividade,
            "textareaSobre": textareaSobre
        };

        $.ajax({
            url: "assets/actions/Professor_AtualizarPerfil.php",
            type: "post",
            data: postData,
            dataType: 'json',
            success: function (data) {
                if (data.sucesso == true) {
                    $.notify({
                        icon: 'pe-7s-check',
                        message: "Perfil atualizado com sucesso!"
                    }, {
                        type: 'success',
                        timer: 1000
                    });
                    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'perfil/index.php?id=' + idProfessor);
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

var opcaoAcesso = function (idProfessor, idOpcaoAcesso) {
    var postData = {
        "idOpcaoAcesso": idOpcaoAcesso
    };

    $.ajax({
        url: "assets/actions/Professor_OpcoesAcesso.php?id=" + idProfessor,
        type: "post",
        data: postData,
        dataType: 'json',
        success: function (data) {
            if (data.sucesso_on == true) {
                //$('#opcaoAcesso' + idOpcaoAcesso).attr("checked");
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'perfil/index.php?id=' + idProfessor);
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Acesso atualizado no banco de dados."
                }, {
                    type: 'success',
                    timer: 100
                });
            } else if (data.sucesso_off = true) {
                //$('#opcaoAcesso' + idOpcaoAcesso).removeAttr("checked");
                $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'perfil/index.php?id=' + idProfessor);
                $.notify({
                    icon: 'pe-7s-check',
                    message: "Acesso atualizado no banco de dados."
                }, {
                    type: 'success',
                    timer: 100
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