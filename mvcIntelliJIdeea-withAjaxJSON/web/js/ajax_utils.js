


function startGame(puzzle, callbackFunction){
	$.getJSON(
		"ImageController",
		{ action: 'startGame', puzzle:puzzle},
		callbackFunction
	);
}


function move(selected1, selected2, callbackFunction){
	$.getJSON(
		"ImageController",
		{ action: 'move', selected1:selected1, selected2:selected2},
		callbackFunction
	);
}

function checkFinish(callbackFunction){
	$.getJSON(
		"ImageController",
		{ action: 'checkFinish'},
		callbackFunction
	);
}