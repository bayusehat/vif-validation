var viewModel = {
    test: ko.observable("test")
}

viewModel.ddlStatus = ko.observableArray([
    { text: "ENABLED", value: 1 },
    { text: "DISABLED", value: 0 },
])

viewModel.ajaxPost = function(url, data, fnOk, fnNok) {
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: "JSON",
        success: function(data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function(error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            } else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

viewModel.ajaxFilePost = function(url, formData, fnOk, fnNok) {
    $.ajax({
        url: url,
        data: formData,
        contentType: false,
        dataType: "JSON",
        mimeType: 'multipart/form-data',
        processData: false,
        type: 'POST',
        success: function(data) {
            if (typeof fnOk == "function") fnOk(data);
            koResult = "OK";
        },
        error: function(error) {
            if (typeof fnNok == "function") {
                fnNok(error);
            } else {
                alert("There was an error posting the data to the server: " + error.responseText);
            }
        }
    });
}

function swal_success(msg) {
    swal({
        title: "Success",
        text: msg,
        timer: 2500,
        showConfirmButton: false,
        type: 'success'
    });
}

function swal_failed(msg) {
    swal({
        title: "Failed",
        text: msg,
        timer: 2500,
        showConfirmButton: false,
        type: 'error'
    });
}

$(function() {
    // console.log('test');
})

AppViewModel = function() {
    return viewModel
}