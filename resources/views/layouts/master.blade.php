<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Todos</title>
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body>
	<div id="app">
		<section class="todoapp">
			<add-todo></add-todo>
			<!-- This section should be hidden by default and shown when there are todos -->
			<todo-list></todo-list>
		</section>
		<footer class="info">
			<p>Double-click to edit a todo</p>
			<p>Created by
				<a href="https://github.com/jusdeleon" target="_blank">Justin de Leon</a>
			</p>
			<p>Part of
				<a href="http://todomvc.com" target="_blank">TodoMVC</a>
			</p>
		</footer>
	</div>
	<script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>