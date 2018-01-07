<template>
    <div>
        <section class="main">
            <input id="toggle-all" class="toggle-all" type="checkbox">
            <label for="toggle-all">Mark all as complete</label>
            <ul v-for="(todo, index) in todos" class="todo-list" :key="todo.name">
                <!-- These are here just to show the structure of the list items -->
                <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
                <li :class="{completed: todo.completed, editing: todo.editing}">
                    <div class="view">
                        <input class="toggle" type="checkbox" :checked="todo.completed" @click="todo.completed = ! todo.completed">
                        <label v-text="todo.name"></label>
                        <button class="destroy" @click="deleteTodo(todo, index)"></button>
                    </div>
                    <input class="edit" :value="todo.name">
                </li>
            </ul>
        </section>
        <!-- This footer should hidden by default and shown when there are todos -->
        <footer class="footer">
            <!-- This should be `0 items left` by default -->
            <span class="todo-count" v-text="itemsLeft"></span>
            <!-- Hidden if no completed items are left ↓ -->
            <button class="clear-completed" @click="clearCompleted">Clear completed</button>
        </footer>
    </div>
</template>

<script>
    export default {
        props: ['todos'],
        data() {
            return {
                newTodo: '',
            }
        },
        computed: {
            activeTodos() {
                return this.todos.filter(todo => {
                    return ! todo.completed;
                });
            },
            completedTodos() {
                return this.todos.filter(todo => {
                    return todo.completed;
                });
            },
            itemsLeft() {
                let itemsCount = this.activeTodos.length;
                let items = itemsCount == 1 ? 'item' : 'items';

                return `${itemsCount} ${items} left`;
            }
        },
        methods: {
            deleteTodo(todo, index) {
                this.todos.splice(index, 1);
            },
            clearCompleted() {
                this.completedTodos.forEach(todo => {
                    let index = this.todos.indexOf(todo);

                    this.todos.splice(index, 1);
                });
            }
        }
    };
</script>