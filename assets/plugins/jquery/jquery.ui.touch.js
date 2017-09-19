/**
* jQuery.UI.iPad plugin
* Copyright (c) 2010 Stephen von Takach
* licensed under MIT.
* 
* jQuery.UI.touch plugin for CIFullcalendar+
* Copyright (c) 2015 Sir.Dre
*/


$(function() {
	
	// Detect touch support
	$.support.touch = 'ontouchend' in document;

	// Ignore browsers without touch support
	if (!$.support.touch) {
		return;
	}
	//
	// Hook up touch events
	//
	if ($.support.touch) {
		document.addEventListener("touchstart", TouchHandler, false);
		document.addEventListener("touchmove", TouchHandler, false);
		document.addEventListener("touchend", TouchHandler, false);
		document.addEventListener("touchcancel", TouchHandler, false);
	}

});
 
var tapFinal = null;			// Holds last tapped element (so we can compare for double tap)
var tapValid = false;			// Are we still in the .6 second window where a double tap can occur
var tapTimeout = null;			// The timeout reference
var rightClickPending = true;	// Is a right click still feasible
var rightClickEvent = null;		// the original event
var holdTimeout = null;			// timeout reference
var cancelMouseUp = true;		// prevents a click from occuring as we want the context menu

function cancelTap() {
	tapValid = false;
} 
 
function cancelHold() {
	if (rightClickPending) {
		window.clearTimeout(holdTimeout);
		rightClickPending = false;
		rightClickEvent = null;
	}
}

function startHold(event) {
	
	// Ignore right clicking
	if (rightClickPending)
		return;

	rightClickPending = true; // We could be performing a right click
	rightClickEvent = (event.changedTouches)[0];
	holdTimeout = window.setTimeout("doRightClick();", 800);
}
 
function doRightClick() {
	rightClickPending = false;

	//
	// We need to mouse up (as we were down)
	// 
	simulateMouseEvent (rightClickEvent, "mouseup");

	//
	// emulate a right click
	// 
	simulateMouseEvent (rightClickEvent, "mousedown"); 

	//
	// Show a context menu
	// 
	simulateMouseEvent (rightClickEvent, "contextmenu");   

	//
	// Note:: I don't mouse up the right click here however feel free to add if required
	// 
	cancelMouseUp = true;
	rightClickEvent = null; // Release memory
}


//
// mouse over event then mouse down
//
function TouchStart(event) {
	var touches = event.changedTouches,
		first = touches[0],
		simulatedEvent = document.createEvent("MouseEvent");
	//
	// Mouse over first - I have live events attached on mouse over
	//
	simulateMouseEvent (first, "mouseover");  
 
	simulateMouseEvent (first, "mousedown"); 


	if (!tapValid) {
		tapFinal = first.target;
		tapValid = true;
		tapTimeout = window.setTimeout("cancelTap();", 600);
		startHold(event);
	
	}else {
		window.clearTimeout(tapTimeout);

		//
		// If a double tap is still a possibility and the elements are the same
		//	Then perform a double click
		//
		if (first.target == tapFinal) {
			tapFinal = null;
			tapValid = false; 
			 
			simulateMouseEvent (first, "click");
 
			simulateMouseEvent (first, "dblclick");
		}else {
			tapFinal = first.target;
			tapValid = true;
			event.preventDefault();
			tapTimeout = window.setTimeout("cancelTap();", 600);
			startHold(event);
		}
	}
}

function TouchHandler(event) {
	var type = "",
		button = 0; /*left*/
 		
	if (event.touches.length > 1)
		return;

	switch (event.type) {
		case "touchstart":
			if ($(event.changedTouches[0].target).is("select")) { 
				return;
			}
			TouchStart(event); /*We need to trigger two events here to support one touch drag and drop*/
			return false;
			break;

		case "touchmove":
			cancelHold();
			type = "mousemove";
			break;

		case "touchend":
			if (cancelMouseUp) {
				cancelMouseUp = false;
				return true;
			}
			cancelHold();
			type = "mouseup";
			break;

		default:
			return;
	}

	var touches = event.changedTouches,
		first = touches[0],
		simulatedEvent = document.createEvent("MouseEvent");

		simulateMouseEvent (first, type); 

	if (type == "mouseup" && tapValid && first.target == tapFinal) {	// This actually emulates the ipads default behaviour (which we prevented)
		event.preventDefault();
		simulateMouseEvent (first, "click");  
	}
	
}

/**
* Simulate a mouse event based on a corresponding touch event
* @param {Object} event A touch event
* @param {String} simulatedType The corresponding mouse event
*/
function simulateMouseEvent (event, simulatedType) {

    // Ignore multi-touch events
    if (event.length > 1) {
      return;
    }  

    var first = event,
        simulatedEvent = document.createEvent('MouseEvents');
    
    // Initialize the simulated mouse event using the touch event's coordinates
    simulatedEvent.initMouseEvent(
      simulatedType,    // type
      true,             // bubbles                    
      true,             // cancelable                 
      window,           // view                       
      1,                // detail                     
      first.screenX,    // screenX                    
      first.screenY,    // screenY                    
      first.clientX,    // clientX                    
      first.clientY,    // clientY                    
      false,            // ctrlKey                    
      false,            // altKey                     
      false,            // shiftKey                   
      false,            // metaKey                    
      0,                // button                     
      null              // relatedTarget              
    );

    // Dispatch the simulated event to the target element
    first.target.dispatchEvent(simulatedEvent);
}
