@extends('layouts.master')

@section('content')
    <section class="todoapp">
        <!-- This section should be hidden by default and shown when there are todos -->
        <todos></todos>
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