@extends('layouts.master')

@section('content')
    <section class="todoapp">
        <add-todo @new-todo="addTodo"></add-todo>
        <!-- This section should be hidden by default and shown when there are todos -->
        <todo-list :todos="todos"></todo-list>
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
@endsection