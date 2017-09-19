/*!
 * CIFullcalendar bootstrap-table plugin 
 * @author: Sir.Dre
 * Docs & License: http://www.cifullcalendar.com
 * (c) 2016 CIFullcalendar 
 */
var allsessions_url = window.location.protocol + "//" 
			+ window.location.host
			+ window.location.pathname.replace('/index.php', '')
			+ "/get_allsessions";	  

var $table = $('#allsessions_dataTable'),
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
			url: allsessions_url, 
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
                field: 'session_id',
                values: ids
            });
            $remove.prop('disabled', true);
        }); 

    });

    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
			
			$params = {
				'session_id' : row.session_id,
				'hash' : (row.token) ? row.token : ''
			};

			$.ajax({
				url     : './sessionlist/del_selected/',
				type    : 'POST',
				data    : $params,           
				complete: function(data){
					console.log(row.session_id);
				}
			});	
            return row.session_id
        });
    }

    function responseHandler(res) {
        $.each(res.rows, function (i, row) {
            row.state = $.inArray(row.session_id, selections) !== -1;
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
            total += +(row.session_id);
        });
        return total;
    }
 
	function timestampFormatter(value, row) { 
		var now = moment.unix(row.last_activity); 
		var timestamp = now.format("MMM-DD-YYYY h:mm:ss a");
		return '<i class="fa fa-clock-o hidden-xs hidden-md"></i>&nbsp;' + timestamp + '';
	} 