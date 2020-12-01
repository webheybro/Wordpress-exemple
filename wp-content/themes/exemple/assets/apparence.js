console.log("Apparence");
(function ($, log) {
  wp.customize("header_background", function (value) {
    value.bind(function (newVal) {
      $(".navbar").attr("style", "background: " + newVal + " !important");
    });
  });
})(jQuery, console.log);
