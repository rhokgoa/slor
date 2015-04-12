$.get('data.json', function(data) {
	var obj = $.parseJSON(data);
	for (var i in obj){
		console.log(i.length);
	}
	alert( obj.length);
});
