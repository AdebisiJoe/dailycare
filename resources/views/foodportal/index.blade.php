@extends('layouts.app')
@section('stylesheets')
  <style type="text/css">
      @media print {
        .page-break { display: block; page-break-before: always; }
      }
  </style>
  <style type="text/css" href="{{asset('/plugins/toastr/toastr.min.css')}}"></style>
@endsection

@section('content')
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Food Portal</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div><!-- /.box-header -->

    <div class="box-body">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Country Store</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{url('/food-portal-create-country')}}" method="post">
        {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="inputGroupCountry" class="col-sm-2 control-label text-right"><span class="text-danger">*</span> Country</label>
              <div class="col-sm-10">
                  <select name="country" id="inputGroupCountry" onchange="loadState()" class="form-control"></select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Add Country</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
   </div>

   
   <div class="box-body">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Portal Manager</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal">
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>
                <th>Country</th>
                <th>Portal Status</th>
                <th>Portal Action</th>
              </tr>
                @if (empty($results))
                  <tr>
                    <td colspan = "4" text-align="center">No country created.</td>
                  </tr>
                @else
                    @foreach($results as $key => $result)
                    <tr>
                      <td> {{$key + 1}}</td>
                      <td> {{$result->country_name}} </td>
                      <td>
                        @if($result->status == 0)
                          {{"Closed"}}
                        @else
                         {{"Opened"}}
                        @endif 
                      </td>
                      <td>
                        @if($result->status == 0)
                          <a href="{{url('/foodportalopen')}}/{{ $result->id }}"  class="btn bg-yellow btn-flat margin">Open</button>
                        @elseif($result->status == 1)
                          <a href="{{url('/foodportalclose')}}/{{ $result->id }}"  class="btn bg-red btn-flat margin">Close</button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                @endif
            </table>
          </div>
          <!-- /.box-body -->
        </form>
      </div>
   </div>
 </div>
</section>

@endsection
@section('scripts')
<script src="{{ asset('plugins/country_state/country_state.js') }}"></script>

<script type="text/javascript">
  init('Nigeria','inputGroupCountry', 'inputGroupState');
  function loadState() {
    selectState('inputGroupCountry', 'inputGroupState'); 
  }

  function loadStates() {
    selectState('modal-inputGroupCountry', 'modal-inputGroupState'); 
  }
</script>


<!-- PRINT THIS SCRIPT -->
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
@endsection
