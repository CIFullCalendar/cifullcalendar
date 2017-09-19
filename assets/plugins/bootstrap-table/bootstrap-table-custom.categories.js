/*!
 * CIFullcalendar bootstrap-table plugin 
 * @author: Sir.Dre
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2015 CIFullcalendar 
 */
  
	
var allcategory_url = window.location.protocol + "//" 
			+ window.location.host
			+ window.location.pathname.replace('/index.php', '')
			+ "/get_categories";	  

var $table = $('#categories_dataTable'),
	$remove = $('#remove-data'),
	selections = [];
		
		
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.      
		if (typeof jQuery === 'undefined') {
            throw 'bootstrap-table requires jQuery to be loaded first';
        } 
        factory(jQuery);
    }
})(function($) {

;; 	
 
        $table.bootstrapTable({ 
			method: 'get',
			url: allcategory_url, 
            sidepagination: "server",
            pagination: true,
            handler:"responseHandler",
			search: true,
			showRefresh: true,
			pagination: true,
			showColumns: true,
			pageSize: 5,
			pageList: [5, 10, 25, 50, 100, 200, 300, 500, 800, 900, 1000, 1500, 3000, 5000, 7000, 9000, 12000, 15000, 20000, 'ALL']  
        });
        // sometimes footer render error.
        setTimeout(function () {
            $table.bootstrapTable('resetView');
        }, 200); 
      
        $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table', function () {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);        
        });
      
        $remove.click(function () {
            var ids = getIdSelections();
            $table.bootstrapTable('remove', {
                field: 'category_id',
                values: ids
            });
            $remove.prop('disabled', true);
        });

		$('.color_picker').each( function() {
			$(this).minicolors({
				control: $(this).attr('data-control') || 'hue',
				defaultValue: $(this).attr('data-defaultValue') || '',
				inline: $(this).attr('data-inline') === 'true',
				letterCase: $(this).attr('data-letterCase') || 'lowercase',
				opacity: $(this).attr('data-opacity'),
				position: $(this).attr('data-position') || 'bottom left',
				change: function(hex, opacity) {
					if( !hex ) return;
					if( opacity ) hex += ', ' + opacity;
				},
				theme: 'bootstrap'
			});

		});		

   });

    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
			
			$params = {
				'category_id' : row.category_id,
				'hash' : (row.token) ? row.token : ''
			};

			$.ajax({
				url     : './categories/del_selected/',
				type    : 'POST',
				data    : $params,           
				complete: function(data){
					console.log(row.category_id);
				}
			});	
            return row.category_id
        });
    }

    function responseHandler(res) {
        $.each(res.rows, function (i, row) {
            row.state = $.inArray(row.category_id, selections) !== -1;
        });
        return res;
    }

    function detailFormatter(index, row) {
        var html = [];
        $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>');
        });
        return html.join('');
    }
  
    function totalNameFormatter(data) {
        return data.length;
    }

    function totalFormatter(data) {
        var total = 0;
        $.each(data, function (i, row) {
            total += +(row.category_id);
        });
        return total;
    }
  
	function operateFormatter(value, row, index) {		 		
		return [
			'<button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit_'+ row.category_id +'" data-placement="top" ><i class="fa fa-pencil"></i></button>  ',
			'<button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete_'+ row.category_id +'" data-placement="top" ><i class="fa fa-trash"></i></button>'
		].join('');
	}	