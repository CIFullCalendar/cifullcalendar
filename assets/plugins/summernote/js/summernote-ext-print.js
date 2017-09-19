/**
 * Super simple wysiwyg editor on Bootstrap v0.6.16
 * http://summernote.org/
 *
 * summernote.js
 * Copyright 2013-2015 Alan Hong. and other contributors
 * summernote may be freely distributed under the MIT license./
 *
 * Date: 2015-08-03T16:41Z
 */
(function (factory) {
  /* global define */
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(window.jQuery);
  }
}(function ($) {
  // Extends lang for print plugin.
  $.extend(true, $.summernote.lang, {
    'en-US': {
      print: {
        print: 'Print'
      }
    },
    'ko-KR': {
      print: {
        print: '인쇄'
      }
    },
    'pt-BR': {
      print: {
        print: 'Imprimir'
      }
    }
  });

  // Extends plugins for print plugin.
  $.extend($.summernote.plugins, {
    /**
     * @param {Object} context - context object has status of editor.
     */
    'print': function (context) {
      var self = this;

      // ui has renders to build ui elements.
      //  - you can create a button with `ui.button`
      var ui = $.summernote.ui;
      var $editor = context.layoutInfo.editor;
      var options = context.options;
      var lang = options.langInfo;

      // add print button
      context.memo('button.print', function () {
        // create button
        var button = ui.button({
          contents: '<i class="fa fa-print"/> ' + lang.print.print,
          tooltip: lang.print.print,
          click: function () {
            self.$printframe.contents().find('body').html(context.invoke('code'));
            setTimeout(function () {
              window.frames.summernotePrintFrame.window.focus();
              window.frames.summernotePrintFrame.window.print();
            }, 250);
          }
        });
        // create jQuery object from button instance.
        var $print = button.render();
        return $print;
      });

      this.initialize = function () {
        var $container = options.dialogsInBody ? $(document.body) : $editor;

        this.$printframe = $(
          '<iframe name="summernotePrintFrame"' +
          'width="0" height="0" frameborder="0" src="about:blank" style="display:none">' +
          '</iframe>');
        this.$printframe.appendTo($container);

        var $head = this.$printframe.contents().find('head');
        if (options.print && options.print.stylesheetUrl) {
          // Use dedicated styles
          var css = document.createElement('link');
          css.href = options.print.stylesheetUrl;
          css.rel = 'stylesheet';
          css.type = 'text/css';
          $head.append(css);
        } else {
          // Inherit styles from document
          $('style, link[rel=stylesheet]', document).each(function () {
            $head.append($(this).clone());
          });
        }
      };

      this.destroy = function () {
        this.$printframe.remove();
        this.$printframe = null;
      };
    }
  });
}));