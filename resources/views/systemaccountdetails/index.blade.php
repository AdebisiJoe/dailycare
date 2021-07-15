@extends('layouts.app')

@section('stylesheet')

<!-- DataTables CSS -->

<link href="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

<link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">

<!-- DataTables Responsive CSS -->

<link href="{{ asset('plugins/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

<style type="text/css">

  /*@media all {

    .page-break { display: none; }

  }*/





  @media print {

    .page-break { display: block; page-break-before: always; }

  }

</style>

@endsection

@section('content')



<section class="content">

    <div class="box box-default hidden-print">

        <div class="box-header with-border">

            <h3 class="box-title">Food Collection Reports</h3>

        </div><!-- /.box-header -->

        <div class="box-body">

          <div class="form-group">

            <label for="report-id" class="col-sm-2 control-label">Use Date </label>

            <div class="col-sm-10">

            <select id="use-date" onchange="useDate(this)" class="form-control" required="required">

                <option value="1" selected="selected">No</option>

                <option value="2">Yes</option>

            </select>

            </div>

            </div>

        <br>
        <br>
          <div class="form-group" id="select-date">

            <label for="" class="col-sm-2 control-label">Select Date </label>

            <div class="col-sm-10">

                <div class="input-group">

                <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                </div>

                <input type="text" class="form-control pull-right" id="date">

                </div>

                <!-- /.input group -->

            </div>

            </div>

          <br>

        </div>

        <!-- /.box-body -->

        <div class="box-footer">

          <button type="button" class="btn btn-success pull-left" onclick="generateReportForAmountGainedByDeduction()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Generate Amount Gained from Deduction Report</span></button>&nbsp;&nbsp;&nbsp;

          <button type="button" class="btn btn-success pull-left" onclick="generateReport()"><i class="fa fa-save"></i>&nbsp;<span id="spinner">Generate Report</span></button>

          <button type="button" class="btn btn-warning pull-right" onclick="printReport('reportForm')"><i class="fa fa-print"></i>&nbsp;Print Report</button>

        </div>

        <!-- /.box-footer -->

    </div>



    <div id="reportForm"></div>

</section>



<meta name="_token" content="{!! csrf_token() !!}" />

@endsection

@section('scripts')

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('plugins/daterangepicker/moment.js') }}"></script>

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('plugins/country_state/country_state.js') }}"></script>



<script type="text/javascript">
  $('#select-date').hide();

  function useDate(a) {
        var x = a.selectedIndex;
        if(x == 0){
          $('#select-date').hide();
        }else{
          $('#select-date').show();
        }
    }

  init('Nigeria','inputGroupCountry', 'inputGroupState');

  function loadState() {

    selectState('inputGroupCountry', 'inputGroupState');

  }

</script>



<script type="text/javascript">

  /*

   * printThis v1.9.0

   * @desc Printing plug-in for jQuery

   * @author Jason Day

   *

   * Resources (based on) :

   *              jPrintArea: http://plugins.jquery.com/project/jPrintArea

   *              jqPrint: https://github.com/permanenttourist/jquery.jqprint

   *              Ben Nadal: http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm

   *

   * Licensed under the MIT licence:

   *              http://www.opensource.org/licenses/mit-license.php

   *

   * (c) Jason Day 2015

   *

   * Usage:

   *

   *  $("#mySelector").printThis({

   *      debug: false,               * show the iframe for debugging

   *      importCSS: true,            * import page CSS

   *      importStyle: false,         * import style tags

   *      printContainer: true,       * grab outer container as well as the contents of the selector

   *      loadCSS: "path/to/my.css",  * path to additional css file - us an array [] for multiple

   *      pageTitle: "",              * add title to print page

   *      removeInline: false,        * remove all inline styles from print elements

   *      printDelay: 333,            * variable print delay

   *      header: null,               * prefix to html

   *      footer: null,               * postfix to html

   *      base: false,                * preserve the BASE tag, or accept a string for the URL

   *      formValues: true            * preserve input/form values

   *      canvas: false               * copy canvas elements (experimental)

   *      doctypeString: '...'        * enter a different doctype for older markup

   *  });

   *

   * Notes:

   *  - the loadCSS will load additional css (with or without @media print) into the iframe, adjusting layout

   */

  ;

  (function($) {

      var opt;

      $.fn.printThis = function(options) {

          opt = $.extend({}, $.fn.printThis.defaults, options);

          var $element = this instanceof jQuery ? this : $(this);



          var strFrameName = "printThis-" + (new Date()).getTime();



          if (window.location.hostname !== document.domain && navigator.userAgent.match(/msie/i)) {

              // Ugly IE hacks due to IE not inheriting document.domain from parent

              // checks if document.domain is set by comparing the host name against document.domain

              var iframeSrc = "javascript:document.write(\"<head><script>document.domain=\\\"" + document.domain + "\\\";</s" + "cript></head><body></body>\")";

              var printI = document.createElement('iframe');

              printI.name = "printIframe";

              printI.id = strFrameName;

              printI.className = "MSIE";

              document.body.appendChild(printI);

              printI.src = iframeSrc;



          } else {

              // other browsers inherit document.domain, and IE works if document.domain is not explicitly set

              var $frame = $("<iframe id='" + strFrameName + "' name='printIframe' />");

              $frame.appendTo("body");

          }





          var $iframe = $("#" + strFrameName);



          // show frame if in debug mode

          if (!opt.debug) $iframe.css({

              position: "absolute",

              width: "0px",

              height: "0px",

              left: "-600px",

              top: "-600px"

          });



          // $iframe.ready() and $iframe.load were inconsistent between browsers

          setTimeout(function() {



              // Add doctype to fix the style difference between printing and render

              function setDocType($iframe,doctype){

                  var win, doc;

                  win = $iframe.get(0);

                  win = win.contentWindow || win.contentDocument || win;

                  doc = win.document || win.contentDocument || win;

                  doc.open();

                  doc.write(doctype);

                  doc.close();

              }

              if(opt.doctypeString){

                  setDocType($iframe,opt.doctypeString);

              }



              var $doc = $iframe.contents(),

                  $head = $doc.find("head"),

                  $body = $doc.find("body"),

                  $base = $('base'),

                  baseURL;



              // add base tag to ensure elements use the parent domain

              if (opt.base === true && $base.length > 0) {

                  // take the base tag from the original page

                  baseURL = $base.attr('href');

              } else if (typeof opt.base === 'string') {

                  // An exact base string is provided

                  baseURL = opt.base;

              } else {

                  // Use the page URL as the base

                  baseURL = document.location.protocol + '//' + document.location.host;

              }



              $head.append('<base href="' + baseURL + '">');



              // import page stylesheets

              if (opt.importCSS) $("link[rel=stylesheet]").each(function() {

                  var href = $(this).attr("href");

                  if (href) {

                      var media = $(this).attr("media") || "all";

                      $head.append("<link type='text/css' rel='stylesheet' href='" + href + "' media='" + media + "'>");

                  }

              });



              // import style tags

              if (opt.importStyle) $("style").each(function() {

                  $(this).clone().appendTo($head);

              });



              // add title of the page

              if (opt.pageTitle) $head.append("<title>" + opt.pageTitle + "</title>");



              // import additional stylesheet(s)

              if (opt.loadCSS) {

                 if( $.isArray(opt.loadCSS)) {

                      jQuery.each(opt.loadCSS, function(index, value) {

                         $head.append("<link type='text/css' rel='stylesheet' href='" + this + "'>");

                      });

                  } else {

                      $head.append("<link type='text/css' rel='stylesheet' href='" + opt.loadCSS + "'>");

                  }

              }



              // print header

              if (opt.header) $body.append(opt.header);



              if (opt.canvas) {

                  // add canvas data-ids for easy access after the cloning.

                  var canvasId = 0;

                  $element.find('canvas').each(function(){

                      $(this).attr('data-printthis', canvasId++);

                  });

              }



              // grab $.selector as container

              if (opt.printContainer) $body.append($element.outer());



              // otherwise just print interior elements of container

              else $element.each(function() {

                  $body.append($(this).html());

              });



              if (opt.canvas) {

                  // Re-draw new canvases by referencing the originals

                  $body.find('canvas').each(function(){

                      var cid = $(this).data('printthis'),

                          $src = $('[data-printthis="' + cid + '"]');



                      this.getContext('2d').drawImage($src[0], 0, 0);



                      // Remove the mark-up from the original

                      $src.removeData('printthis');

                  });

              }



              // capture form/field values

              if (opt.formValues) {

                  // loop through inputs

                  var $input = $element.find('input');

                  if ($input.length) {

                      $input.each(function() {

                          var $this = $(this),

                              $name = $(this).attr('name'),

                              $checker = $this.is(':checkbox') || $this.is(':radio'),

                              $iframeInput = $doc.find('input[name="' + $name + '"]'),

                              $value = $this.val();



                          // order matters here

                          if (!$checker) {

                              $iframeInput.val($value);

                          } else if ($this.is(':checked')) {

                              if ($this.is(':checkbox')) {

                                  $iframeInput.attr('checked', 'checked');

                              } else if ($this.is(':radio')) {

                                  $doc.find('input[name="' + $name + '"][value="' + $value + '"]').attr('checked', 'checked');

                              }

                          }



                      });

                  }



                  // loop through selects

                  var $select = $element.find('select');

                  if ($select.length) {

                      $select.each(function() {

                          var $this = $(this),

                              $name = $(this).attr('name'),

                              $value = $this.val();

                          $doc.find('select[name="' + $name + '"]').val($value);

                      });

                  }



                  // loop through textareas

                  var $textarea = $element.find('textarea');

                  if ($textarea.length) {

                      $textarea.each(function() {

                          var $this = $(this),

                              $name = $(this).attr('name'),

                              $value = $this.val();

                          $doc.find('textarea[name="' + $name + '"]').val($value);

                      });

                  }

              } // end capture form/field values



              // remove inline styles

              if (opt.removeInline) {

                  // $.removeAttr available jQuery 1.7+

                  if ($.isFunction($.removeAttr)) {

                      $doc.find("body *").removeAttr("style");

                  } else {

                      $doc.find("body *").attr("style", "");

                  }

              }



              // print "footer"

              if (opt.footer) $body.append(opt.footer);



              setTimeout(function() {

                  if ($iframe.hasClass("MSIE")) {

                      // check if the iframe was created with the ugly hack

                      // and perform another ugly hack out of neccessity

                      window.frames["printIframe"].focus();

                      $head.append("<script>  window.print(); </s" + "cript>");

                  } else {

                      // proper method

                      if (document.queryCommandSupported("print")) {

                          $iframe[0].contentWindow.document.execCommand("print", false, null);

                      } else {

                          $iframe[0].contentWindow.focus();

                          $iframe[0].contentWindow.print();

                      }

                  }



                  // remove iframe after print

                  if (!opt.debug) {

                      setTimeout(function() {

                          $iframe.remove();

                      }, 1000);

                  }



              }, opt.printDelay);



          }, 333);



      };



      // defaults

      $.fn.printThis.defaults = {

          debug: false,           // show the iframe for debugging

          importCSS: true,        // import parent page css

          importStyle: false,     // import style tags

          printContainer: true,   // print outer container/$.selector

          loadCSS: "",            // load an additional css file - load multiple stylesheets with an array []

          pageTitle: "",          // add title to print page

          removeInline: false,    // remove all inline styles

          printDelay: 333,        // variable print delay

          header: null,           // prefix to html

          footer: null,           // postfix to html

          formValues: true,       // preserve input/form values

          canvas: false,          // Copy canvas content (experimental)

          base: false,            // preserve the BASE tag, or accept a string for the URL

          doctypeString: '<!DOCTYPE html>' // html doctype

      };



      // $.selector container

      jQuery.fn.outer = function() {

          return $($("<div></div>").html(this.clone())).html();

      }

  })(jQuery);

</script>

<script type="text/javascript">

$(function() {

    $('#date').daterangepicker({
        locale: {
          format: 'YYYY/MM/DD'
        }
    });
});

</script>



<script type="text/javascript">

  function printReport(divName) {
    $("#" + divName).printThis({
      "importStyle": true,
      "loadCSS": "{{ asset('bootstrap/css/bootstrap.min.css') }}",
    });
  }

  function generateReport() {

    var e = document.getElementById("use-date");
    var strUser = e.options[e.selectedIndex].value;
    if(strUser == 2){
        var date = $('#date').val();
        $.ajax({
            url: '{{ url("/")}}/admin-operation/members-financial-records-with-date',
            type: 'get',
            data: 'date=' + date,
            dataType: 'html',

            beforeSend: function() {
                $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Generating Report...');
            },

            complete: function() {
                $('#spinner').html('Generate Report');
            },
            success: function(data) {
                $('#reportForm').html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }else{
        $.ajax({
            url: '{{ url("/")}}/admin-operation/members-financial-records',
            type: 'get',
            dataType: 'html',

            beforeSend: function() {
                $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Generating Report...');
            },
            complete: function() {
                $('#spinner').html('Generate Report');
            },
            success: function(data) {
                $('#reportForm').html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

  }


  function generateReportForAmountGainedByDeduction() {
    $.ajax({
        url: '{{ url("/")}}/admin-operation/amount-gained-by-deduction',
        type: 'get',
        dataType: 'html',

        beforeSend: function() {
            $('#spinner').html('<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> Generating Report...');
        },
        complete: function() {
            $('#spinner').html('Generate Report');
        },
        success: function(data) {
            $('#reportForm').html(data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

</script>

@endsection
