function showLoader(Titulo) {
    $('#divLoader h4').html(Titulo);
    $('#divLoader').modal('show');
}
function closeLoader() {
    $('#divLoader').modal('hide');
}
function closeModal() {
    $('#myModal').modal('hide');
}
function showSubLoader(Titulo) {
    $('#divSubLoader h4').html(Titulo);
    $('#divSubLoader').modal('show');
}
function closeSubLoader() {
    $('#divSubLoader').modal('hide');
}
function showAlert(Titulo, Texto) {
    $('#divAlert h4').html(Titulo);
    if (typeof Texto === 'object') {
       //Loop
       var output = '<ul>';
       for (var key in Texto) {
           output += '<li>' + Texto[key] + '</li>';
       }
       output += '</ul>';
       $("#divAlert .modal-body").html(output);
    }
    else {
        $("#divAlert .modal-body").html(Texto);
    }
    $('#divAlert').modal('show');
}
function showSuccess(Titulo, Texto) {
    $('#divSuccess h4').html(Titulo);
    $("#divSuccess .modal-body").html(Texto);
    $('#divSuccess').modal('show');
}
function showConfirm(Titulo, Texto, Funcion, funcionCancelar) {
    $('#divConfirm h4').html(Titulo);
    $("#divConfirm .modal-body").html(Texto);
    $("#divConfirm .btn-default").on("click", function(){
        if (typeof (funcionCancelar) === 'function') {
            console.log('Cancelo');
            funcionCancelar();
        }
        $('#divConfirm').modal('hide');
    });

    $("#divConfirm .btn-primary").off("click");
    $("#divConfirm .btn-primary").on('click', function() {
        Funcion();
        $('#divConfirm').modal('hide');
    });
    $('#divConfirm').modal('show');
}

function loadModal(url, data) {
    $('#myModal .modal-content').html('');
    $.get(url, data, function(response) {
        $('#myModal .modal-content').append(response);
        setTimeout(function(){
            $('#myModal').modal('show');
        },500);
    });
    return  false;
}

function loadBigModal(url, data) {
    showLoader('Espera un momento...');
    $('#myBigModal .modal-content').html('');
    $.get(url, data, function(response) {
        closeLoader();
        $('#myBigModal .modal-content').append(response);
        setTimeout(function(){
            $('#myBigModal').modal('show');
        },500);
    });
    return  false;
}

function showModal(Texto) {
    $("#myModal .modal-content").html(Texto);
    $('#myModal').modal('show');
}

function showModalBig(Texto) {
    $("#myBigModal .modal-content").html(Texto);
    $('#myBigModal').modal('show');
}

function showConfirmB(Titulo, Texto, Funcion, FunctionCancelar, objeto) {
    $('#divConfirm h4').html(Titulo);
    $("#divConfirm .modal-body").html(Texto);
    $("#divConfirm .btn-default").on('click', function() {
        FunctionCancelar(objeto);
        $('#divConfirm').modal('hide');
    });

    $("#divConfirm .btn-primary").off('click');
    $("#divConfirm .btn-primary").on('click', function() {
        Funcion();
        $('#divConfirm').modal('hide');
    });
    $('#divConfirm').modal('show');
}
