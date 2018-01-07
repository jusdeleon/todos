<template>
    <header class="header">
        <h1>todos</h1>
        <input class="new-todo" placeholder="What needs to be done?" autofocus v-model="todo" @keyup.enter="addTodo">
    </header>
</template>

<script>
    export default {
        data() {
            return {
                todo: '',
            }
        },
        methods: {
            addTodo() {
                if (this.todo == '') {
                    return;
                }

                this.$emit('new-todo', {
                    name: this.todo,
                    completed: false
                });

                this.todo = '';
            }
        }
    };
</script>