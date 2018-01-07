
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

import Vue from 'vue';

new Vue({
    components: {
        AddTodo: require('./components/AddTodo'),
        TodoList: require('./components/TodoList')
    },
    el: '#app',
    data: {
        todos: []
    },
    methods: {
        fetchTodos() {
            this.todos = [
                {
                    name: "Test",
                    completed: true,
                },
                {
                    name: "Test 2",
                    completed: false,
                },
            ]
        },
        addTodo(todo) {
            this.todos.unshift(todo);
        }
    },
    created() {
        this.fetchTodos();
    }
});