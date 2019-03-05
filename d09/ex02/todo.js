var ft_list;
var cookie = [];

window.onload = function() {
	document.getElementById("new").addEventListener("click", newTodo);
	ft_list = document.getElementById("ft_list");
	var tmp = document.cookie;
	if (tmp) {
		cookie = JSON.parse(tmp);
		cookie.forEach(function (e) {
			addTodo(e);
		});
	}
};

window.onunload = function() {
	var todo = ft_list.children;
	var newCookie = [];
	for (var i = 0; i < todo.length; i++)
		newCookie.unshift(todo[i].innerHTML);
	document.cookie = JSON.stringify(newCookie);
};

function newTodo() {
	var todo = prompt("What do you have to do ?");
	if (todo)
		addTodo(todo);
}

function addTodo(todo) {
	var div = document.createElement("div");
	div.innerHTML = todo;
	div.addEventListener('click', removeTodo);
	ft_list.insertBefore(div, ft_list.firstChild);
}

function removeTodo() {
	if (confirm("Do you really want to delete this task ?"))
		this.remove();
}
