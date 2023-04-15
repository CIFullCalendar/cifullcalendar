
var regex = new RegExp("(.+)");
var get_url = window.location.pathname.replace(regex, './tasks/');
			

$(document).ready(function(){
	/* The following code is executed once the DOM is loaded */
    var $tasks = $('#task-list');
    var $addtask = $('#task-new');
	
    $tasks.sortable({
        axis:'y',
        cursor: 'move',
        items: 'li.list-group-item',
        update:function(event,ui){
            // this is the item you just draged
            var item = ui.item;
            var container = item.parent();
            var reorder = [];
            container.children('li').each(function(i){
                // save the item id order in array
                reorder[i] = $(this).attr('id');
            });
            
            $.ajax({
                method:'post',
                url: get_url +"rearrange",
                // post the container id, draged item id, all items order 
                data:{ 
                    'item':item.attr('id'), 
                    'position':reorder,
					'hash':item.attr('hash')
                }
          
            });
			
			      console.log({ 
                    'item':item.attr('id'),
                    'position':reorder,
					'hash':item.attr('hash')
                });
        }
    }); 

	$addtask.on('click', function(e) {
		e.preventDefault();
		if (newList == true) {
			var theValue = $("#toDoItem").val();
			newListItem = '<li><span class="handle"> :: </span> <input class="listItem" value="' + theValue + '"><a class="removeListItem" style="display: none;" href="#"> X </a> </li>';
			newList = false;	
		} else {
			var theValue = $("#toDoItem").val();
		    newListItem = $('#theList li:last').clone();
			newListItem.find('input').attr('value', theValue); 
		}

		var theCount = $("#theList li").length + 1;
		if (theCount > 1) {
			$('#doClearAll').css('display','block');
		}

		$('#toDoItem').val('');
		$('#toDoItem').focus();
		$('#theList').append(newListItem);
		$('.sortable').sortable('destroy');
		$('.sortable').sortable({
			handle: '.handle'
		}); 
	});	
	
 
 
        var $window = $(window);
        var mobile = function(option) {
            if (option == 'reset') {
                $('[data-toggle^="shift"]').shift('reset');
                return true;
            }
            scrollToTop();
            $('[data-toggle^="shift"]').shift('init');
            return true;
        };
        $window.width() < 768 && mobile();
        var $resize, $width = $window.width();
        $window.resize(function() {
            if ($width !== $window.width()) {
                clearTimeout($resize);
                $resize = setTimeout(function() {
                    $window.width() < 767 && mobile();
                    $window.width() >= 768 && mobile('reset') && fixVbox();
                    $width = $window.width();
                }, 500);
            }
        });
        var fixVbox = function() {
            $('.vbox > footer').prev('section').addClass('w-f');
            $('.ie11 .vbox').each(function() {
                $(this).height($(this).parent().height());
            });
        }
        fixVbox(); 
 
	// A global variable, holding a jQuery object 
	// containing the current todo item:
	
	var currentTODO;
	
	// Configuring the delete confirmation dialog
	$("#dialog-confirm").dialog({
		resizable: false,
		height:130,
		modal: true,
		autoOpen:false,
		buttons: {
			'Delete item': function() {
				
				$.get("ajax.php",{"action":"delete","id":currentTODO.data('id')},function(msg){
					currentTODO.fadeOut('fast');
				})
				
				$(this).dialog('close');
			},
			Cancel: function() {
				$(this).dialog('close');
			}
		}
	});

	// When a double click occurs, just simulate a click on the edit button:
	$('.todo').on('dblclick', function(){
		$(this).find('a.edit').click();
	});
	
	// If any link in the todo is clicked, assign
	// the todo item to the currentTODO variable for later use.

	$('.todo').on('click', 'a', function(e){
									   
		currentTODO = $(this).closest('.todo');
		currentTODO.data('id',currentTODO.attr('id').replace('todo-',''));
		
		e.preventDefault();
	});

	// Listening for a click on a delete button:

	$('.todo').on('click', 'a.delete', function(){
		$("#dialog-confirm").dialog('open');
	});
	
	// Listening for a click on a edit button
	
	$('.todo').on('click', 'a.edit', function(){

		var container = currentTODO.find('.text');
		
		if(!currentTODO.data('origText'))
		{
			// Saving the current value of the ToDo so we can
			// restore it later if the user discards the changes:
			
			currentTODO.data('origText',container.text());
		}
		else
		{
			// This will block the edit button if the edit box is already open:
			return false;
		}
		
		$('<input type="text">').val(container.text()).appendTo(container.empty());
		
		// Appending the save and cancel links:
		container.append(
			'<div class="editTodo">'+
				'<a class="saveChanges" href="#">Save</a> or <a class="discardChanges" href="#">Cancel</a>'+
			'</div>'
		);
		
	});
	
	// The cancel edit link:
	
	$('.todo').on('click', 'a.discardChanges', function(){
		currentTODO.find('.text')
					.text(currentTODO.data('origText'))
					.end()
					.removeData('origText');
	});
	
	// The save changes link:
	
	$('.todo').on('click', 'a.saveChanges', function(){
		var text = currentTODO.find("input[type=text]").val();
		
		$.get("ajax.php",{'action':'edit','id':currentTODO.data('id'),'text':text});
		
		currentTODO.removeData('origText')
					.find(".text")
					.text(text);
	});
	
	
	// The Add New ToDo button:
	
	var timestamp=0;
	$('#addButton').click(function(e){

		// Only one todo per 5 seconds is allowed:
		if((new Date()).getTime() - timestamp<5000) return false;
		
		$.get("ajax.php",{'action':'new','text':'New Todo Item. Doubleclick to Edit.','rand':Math.random()},function(msg){

			// Appending the new todo and fading it into view:
			$(msg).hide().appendTo('.todoList').fadeIn();
		});

		// Updating the timestamp:
		timestamp = (new Date()).getTime();
		
		e.preventDefault();
	});
	
}); // Closing $(document).ready()
