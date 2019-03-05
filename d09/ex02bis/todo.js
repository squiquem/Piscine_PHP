var ft_list;
var cookie = [];

$(document).ready(function() {
	$('#new').click(newTodo);
	$('#ft_list div').click(removeTodo);
	ft_list = $('#ft_list');
	var tmp = document.cookie;
	if (tmp) {
		cookie = JSON.parse(tmp);
		cookie.forEach(function (e) {
			addTodo(e);
		});
	}
});

$(window).unload(function() {
	var todo = ft_list.children();
	var newCookie = [];
	for (var i = 0; i < todo.length; i++)
		newCookie.unshift(todo[i].innerHTML);
	document.cookie = JSON.stringify(newCookie);
});

function newTodo() {
	var todo = prompt("What do you have to do ?");
	if (todo)
		addTodo(todo);
}

function addTodo(todo) {
	ft_list.prepend($('<div>' + todo + '</div>').click(removeTodo));
}

function removeTodo() {
	if (confirm("Do you really want to delete this task ?"))
		this.remove();
}
