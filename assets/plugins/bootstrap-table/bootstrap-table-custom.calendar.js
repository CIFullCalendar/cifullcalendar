/*!
 * CIFullcalendar bootstrap-table plugin 
 * @author: Sir.Dre
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2015 CIFullcalendar 
 */
var allevents_url = window.location.protocol + "//" 
			+ window.location.host
			+ window.location.pathname.replace('/index.php', '')
			+ "/get_allevents";	  

var $table = $('#allevents_dataTable'),
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
			url: allevents_url, 
            sidepagination: "server",
            pagination: true,
            handler:"responseHandler",
			search: true,
			showRefresh: true, 
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
                field: 'id',
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
				'id' : row.id,
				'hash' : (row.token) ? row.token : ''
			};

			$.ajax({
				url     : 'calendarlist/del_selected',
				cache   : true,
				type    : 'POST',
				data    : $params,           
				complete: function(data){
					console.log(row.id);
				}
			});	
            return row.id
        });
    }

    function responseHandler(res) {
        $.each(res.rows, function (i, row) {
            row.state = $.inArray(row.id, selections) !== -1;
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
            total += +(row.eid);
        });
        return total;
    }
 
    function alldayFormatter(value, row) {
        var icon = row.allDay == 'true' ? 'fa-sun-o' : 'fa-clock-o'

        return '<i class="fa ' + icon + '" ></i>';
    }    
	
	function shareFormatter(value, row) {
        var icon = row.gid < 0 ? 'fa-toggle-off' : row.gid == 0 ? 'fa-toggle-on' : 'fa-toggle-off'
        var name = row.gid < 0 ? 'public' : row.gid == 0 ? 'private' : 'public'
		
        return '<i class="fa ' + icon + '" ></i>' + name;
    }	
		
	function timestampFormatter(value, row) { 
		var now = moment(row.pubDate); 
		var timestamp = now.format("MMM-DD-YYYY h:mm:ss a");
		return '<i class="fa fa-clock-o hidden-xs hidden-md"></i>&nbsp;' + timestamp + '';
	} 	
	
	function editFormatter(value, row, index) {		 		
		return [
			'<a href="calendarlist/edit/'+ row.eid +'" class="btn btn-primary btn-xs" role="button" ><i class="fa fa-pencil"></i></a>' 
		].join('');
	}