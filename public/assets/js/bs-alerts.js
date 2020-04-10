  var alertTemplate = '<div class="alert alert-info shadow-lg page-alert" role="alert">\
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
  <span aria-hidden="true">×</span>\
  </button>\
  <div class="mt-2 alert-content"></div>\
  </div>\
  ';

  function makeAlert(content, className){
    var contentWrapper = document.createElement("div");
    $(contentWrapper).html(content);

    if (typeof(className) == "string"){
      $(contentWrapper).addClass("text-"+className);
    }

    if ($(".page-alert").length){
      var alertBox = $(".page-alert");
      $(alertBox).children(".alert-content").append("<hr class='m-2' />");
      $(alertBox).children(".alert-content").append(contentWrapper);
    }else{
      var alertBox = $(alertTemplate);
      $(alertBox).children(".alert-content").html(contentWrapper);
      $("body").prepend(alertBox)
    }
  }
