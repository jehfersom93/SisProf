var localhost = "/~jefersonrodrigues/sitecurso/painel/";
var paginaInicial = "/~jefersonrodrigues/sitecurso/index.php?id=1";
//var localhost = "/SitecursoPainel/";

var idProfessor = 1; // provisório

$(document).ready(function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'index/home.php');
    $("#inicio").attr("class", "active");
});

var ativarDataTable = function () {
    $('#tabelaDataTable').DataTable();
    $('#tabelaDataTable').DataTable({"iDisplayLength": 25, retrieve: true});
    $('div.dataTables_filter input').addClass('form-control-searchbox');
    $('div.dataTables_filter input').attr("placeholder", "Pesquisar...");
    $('div.dataTables_length select').addClass('form-control-datatable');
}

var desativaMenusActive = function () {
    $("#inicio").removeClass("active");
    $("#perfil").removeClass("active");
    $("#disciplinas").removeClass("active");
    $("#formacoes").removeClass("active");
    $("#projetos").removeClass("active");
    $("#professores").removeClass("active");
    $("#instituicoes").removeClass("active");
}

var menuSidebar_painel_inicio = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'index/home.php');
    desativaMenusActive();
    $("#inicio").attr("class", "active");
}

var menuSidebar_painel_perfil = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'perfil/index.php?id=' + idProfessor);
    desativaMenusActive();
    $("#perfil").attr("class", "active");
}

var menuSidebar_painel_disciplinas = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'disciplinas/index.php');
    desativaMenusActive();
    $("#disciplinas").attr("class", "active");
}

var menuSidebar_painel_formacoes = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'formacoes/index.php');
    desativaMenusActive();
    $("#formacoes").attr("class", "active");
}

var menuSidebar_painel_projetos = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'projetos/index.php');
    desativaMenusActive();
    $("#projetos").attr("class", "active");
}

var menuSidebar_painel_professores = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'professores/index.php');
    desativaMenusActive();
    $("#professores").attr("class", "active");
}

var menuSidebar_painel_instituicoes = function () {
    $("#dvConteudo").load($(location).attr('protocol') + '//' + $(location).attr('host') + localhost + 'instituicoes/index.php');
    desativaMenusActive();
    $("#instituicoes").attr("class", "active");
}

var menuSidebar_painel_logout = function () {
    $.ajax({
        url: "inc/logout.php",
        type: "get",
        dataType: 'json',
        success: function (data) {
            if (data.sucesso == true) {
                window.location = $(location).attr('protocol') + '//' + $(location).attr('host') + paginaInicial;
            }
        },
    });
}


