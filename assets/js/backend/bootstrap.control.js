/**
 * Created by soifone on 10/26/15.
 */

jQuery.noConflict();

(function($){

    $.bootstrap = {
        defaultHeadline: 'Hello World',
        defaultText: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        dataElements: [],
        interactiveElements: '',
        columnClass: 'col-12 col-11 col-10 col-9 col-8 col-7 col-6 col-5 col-4 col-3 col-2 col-1 col-0',
        offsetClass: 'offset-11 offset-10 offset-9 offset-8 offset-7 offset-6 offset-5 offset-4 offset-3 offset-2 offset-1 offset-0'
    };

    $.fn.getTagName = function() {
        return this.prop("tagName").toLowerCase();
    };

    $.fn.dataCollector = function () {
        $.bootstrap.dataElements = [];
        return $.each(this, function() {
            switch ($(this).getTagName()) {
                case 'input':
                    if ('' ==  $(this).val()) {
                        return '';
                    }

                    $.bootstrap.dataElements.push('<h3>' + $(this).val() + '</h3>');
                    break;

                case 'textarea':
                    if ('' ==  $(this).text()) {
                        return '';
                    }

                    $.bootstrap.dataElements.push($(this).text());
                    break;
            }
        });
    };

    $.buildHtml = function() {
        if (0 == $.bootstrap.dataElements.length) {
            return  '<h3>' + $.bootstrap.defaultHeadline + '</h3>'
                +   '<p>' + $.bootstrap.defaultText + '</p>';
        }

        return $.bootstrap.dataElements.join('');
    }

    $.fn.insertContent = function() {
        $('#ctrl_headline, #ctrl_text').dataCollector();
        var html = $.buildHtml();
        $(this).find('.bootstrap-col').html(html);
    }

    $.fn.bsColumn = function() {
        return $.each(this, function() {
            var self = this;
            var container = $(self).closest('.tl_box');
            var size = $(this).val();
            $.setClasses(container, size, $.bootstrap.columnClass, 'col-');

            $(this).on({
                change: function(e) {
                    $.setClasses(container, $(this).val(), $.bootstrap.columnClass, 'col-');
                }
            });
        });
    };

    $.fn.bsOffset = function() {
        return $.each(this, function() {
            var self = this;
            var container = $(self).closest('.tl_box');
            var size = $(this).val();
            $.setClasses(container, size, $.bootstrap.offsetClass, 'offset-');

            $(this).on({
                change: function(e) {
                    $.setClasses(container, $(this).val(), $.bootstrap.offsetClass, 'offset-');
                }
            });
        });
    };

    $.setClasses = function(container, size, classes, type) {
        console.log(size);
        container.find('.bootstrap-col').removeClass(classes).addClass(type + size);
    };

    $.fn.backendWidget = function(options) {
        var token = $('input[name="REQUEST_TOKEN"]').val();

        return $.each(this, function() {

            var self = $(this);
            var size = $(this).attr('id').replace('pal_bootstrap_legend_', '');
            var request = $.ajax({
                url: 'system/modules/contao-extensions-bootstrap/assets/html/backend.bootstrap.container.' + size + '.html',
                data: {REQUEST_TOKEN: token},
                method: 'GET'
            });

            request.done(function(data){
                var d = $('<div/>').html(data);
                self.append(d);
                d.insertContent();

                $('select.bootstrap-select').bsColumn();
                $('.bootstrap-offset select').bsOffset();
            });
        });
    };
})(jQuery);

jQuery(document).ready(function($){
    $('[id*="pal_bootstrap_legend_"]').backendWidget(['']);
});