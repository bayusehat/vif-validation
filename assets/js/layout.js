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

function swal_confirm_delete(callback) {
    swal({
      title: "Are you sure?",
      text: "Your will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: "Yes, delete it!",
      reverseButtons: true,
      // customClass: {
      //       confirmButton: 'btn btn-success',
      //       cancelButton: 'btn btn-danger'
      //   },
        // cancelButtontonsStyling: false,
      // closeOnConfirm: false
    }).then(function(res) {
        if (res.value) {
            callback()
        }
    });
}

function swal_confirm(callback) {
    swal({
        title: 'Are you sure?',
        text: "",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then(function(result) {
        if(result.value)
            {
                callback()
            }else{
        } 
    })
}

$(function() {
    // console.log('test');
})

AppViewModel = function() {
    return viewModel
}