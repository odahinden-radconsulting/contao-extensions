/**
 * Created by soifone on 10/26/15.
 */

jQuery.noConflict();

(function($){


    $.fn.bsSelector = function() {

        var type = $(document).find('#ctrl_type option:selected').val();

        switch (type) {
            case 'text':

                break;
            default:
                console.log("Type not supported. Showing default devices");
        }

        return $.each(this, function(){
            var self = $(this);

            var id = self.attr('id').replace('ctrl_', '').replace('column', 'container');
            var container = $('<div/>', {
                class: 'bootstrap-flow-container',
                id: id
            });

            var size = self.val();
            $(self).bsColumBuilder(container, size);
        });
    };





    $.fn.bsColumBuilder = function(container, size) {
        container.insertAfter(this);
        createColumns(container, size);
        return $.each(this, function() {
            $(this).on({
                change: function(e) {
                    createColumns(container, $(this).val());
                }
            });
        });

        function buildString() {
            if (0 == $.bootstrap.dataElements.length) {
                return  '<h3>' + $.bootstrap.defaultHeadline + '</h3>'
                    +   '<p>' + $.bootstrap.defaultText + '</p>';
            }

            return $.bootstrap.dataElements.join('');
        }

        function createColumns(container, size) {

            var v = buildString();

            var column = $('<div/>', {
                class: 'bootstrap-col col-' + size,
                html: v
            });

            container.html('');
            container.append(column);
        }
    };

    $.fn.bsOffset = function() {

        return $.each(this, function() {
            var self = $(this);
            var id = self.attr('id').replace('ctrl_', '').replace('offset', 'container');

            self.on('change', function() {
                var size = $(this).val()
                var column = $('#' + id).find('.bootstrap-col');

                column.removeClass('offset-0 offset-1 offset-2 offset-3 offset-4 offset-5 offset-6 offset-7 offset-8 offset-9 offset-10 offset-11');
                column.addClass('offset-' + size);
            });

        });
    }

    $.bootstrap = {
        defaultHeadline: 'Hello World',
        defaultText: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
        dataElements: [],
        interactiveElements: ''
    };

    $.fn.getTagName = function() {
        return this.prop("tagName").toLowerCase();
    };

    $.fn.dataCollector = function () {
        $.bootstrap.dataElements = [];
        return $.each(this, function() {
            switch ($(this).getTagName()) {
                case 'input':
                    $.bootstrap.dataElements.push('<h3>' + $(this).val() + '</h3>');
                    break;

                case 'textarea':
                    $.bootstrap.dataElements.push($(this).text());
                    break;
            }
        });
    };

    $.fn.buildHtml = function() {
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
            });
        });
    };
})(jQuery);

jQuery(document).ready(function($){
    /*$('select.bootstrap-select').bsSelector();
    $('.bootstrap-offset select').bsOffset();*/

    $('[id*="pal_bootstrap_legend_"]').backendWidget(['']);
});