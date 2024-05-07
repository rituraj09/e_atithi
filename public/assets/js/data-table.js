// npm package: datatables.net-bs5
// github link: https://github.com/DataTables/Dist-DataTables-Bootstrap5


$(document).ready(function() {
  new DataTable('#example', {
      layout: {
          topStart: {
              buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
              ]
          }
      }
  });
});

$(function() {
  'use strict';

  $(function() {
    $('#dataTableExample').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: ""
      },
      // dom: '<"html5buttons"B>17fgitp',
      // buttons: [
      //     {extend: 'copy'},
      //     {extend: 'csv'},
      //     {extend: 'excel', title: 'ExampleFile'},
      //     {extend: 'pdf', title: 'ExampleFile'},
      //     {extend: 'print',
      //         customize: function (win){
      //             $(win.document.body).addClass("white-bg"); 
      //             $(win.document.body).css('font-size', '10px');
              
      //             $(win.document.body).find('table')
      //             .addClass('compact')
      //             .css("font-size", "inherit");
      //         }
      //     }
      // ],
    });
    $('#dataTableExample').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });

});