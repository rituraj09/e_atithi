// npm package: bootstrap-maxlength
// github link: https://github.com/mimo84/bootstrap-maxlength

$(function() {
    'use strict';
  
    $('#phoneNumber2').maxlength({
      warningClass: "badge mt-1 bg-success",
      limitReachedClass: "badge mt-1 bg-danger"
    });
  
    $('#defaultconfig-2').maxlength({
      alwaysShow: true,
      threshold: 20,
      warningClass: "badge mt-1 bg-success",
      limitReachedClass: "badge mt-1 bg-danger"
    });
  
    $('#phone').maxlength({
      alwaysShow: true,
      threshold: 10,
      warningClass: "badge mt-1 bg-success",
      limitReachedClass: "badge mt-1 bg-danger",
      separator: ' of ',
      preText: 'You have ',
      postText: ' chars remaining.',
      validate: true
    });
  
    $('#maxlength-textarea').maxlength({
      alwaysShow: true,
      warningClass: "badge mt-1 bg-success",
      limitReachedClass: "badge mt-1 bg-danger"
    });
  });