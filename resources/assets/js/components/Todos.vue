<template>
    <div>
        <header class="header">
            <h1>todos</h1>
            <input class="new-todo" placeholder="What needs to be done?" autofocus v-model="newTodo" @keyup.enter="addTodo">
        </header>
        <section class="main">
            <input id="toggle-all" class="toggle-all" type="checkbox">
            <label for="toggle-all">Mark all as complete</label>
            <ul v-for="(todo, index) in todos" class="todo-list" :key="todo.id">
                <li :class="{completed: todo.completed, editing: todo == editedTodo}">
                    <div class="view">
                        <input class="toggle" type="checkbox" :checked="todo.completed" @click="toggleCompleted(todo, index)">
                        <label v-text="todo.name" @dblclick="editTodo(todo)"></label>
                        <button class="destroy" @click="deleteTodo(todo, index)"></button>
                    </div>
                    <input class="edit" type="text"
                        v-model="todo.name"
                        v-todo-focus="editedTodo == todo"
                        @keyup.esc="cancelEdit(todo)"
                        @keyup.enter="updateTodo(todo, index)"
                    >
                </li>
            </ul>
        </section>
        <footer class="footer" v-if="todos.length">
            <span class="todo-count" v-text="itemsLeft"></span>
            <button v-show="completedTodos.length" class="clear-completed" @click="clearCompleted">Clear completed</button>
        </footer>
    </div>
</template>

<script>
export default {
  data() {
    return {
      newTodo: "",
      editedTodo: null,
      todos: []
    };
  },
  computed: {
    activeTodos() {
      return this.todos.filter(todo => {
        return !todo.completed;
      });
    },
    completedTodos() {
      return this.todos.filter(todo => {
        return todo.completed;
      });
    },
    itemsLeft() {
      let itemsCount = this.activeTodos.length;
      let items = itemsCount == 1 ? "item" : "items";

      return `${itemsCount} ${items} left`;
    }
  },
  methods: {
    fetchTodos() {
      axios.get("/api/todos").then(({ data }) => {
        this.todos = data.data;
      });
    },
    addTodo() {
      if (this.newTodo == "") {
        return;
      }

      axios.post("/api/todos", {
          name: this.newTodo
        })
        .then(({ data }) => {
          this.todos.unshift(data.data);
          this.newTodo = "";
        });
    },
    editTodo(todo) {
        this.beforeEdit = todo.name;
        this.editedTodo = todo;
    },
    cancelEdit(todo) {
        this.editedTodo = null;
        todo.name = this.beforeEdit;
    },
    updateTodo(todo, index) {
      axios.put(`/api/todos/${todo.id}`, {
          name: todo.name,
      }).then(({ data }) => {
        this.todos.splice(index, 1, data.data);
      });
    },
    toggleCompleted(todo, index) {
      axios.put(`/api/todos/${todo.id}/toggle`).then(({ data }) => {
        this.todos.splice(index, 1, data.data);
      });
    },
    deleteTodo(todo, index) {
      axios.delete(`/api/todos/${todo.id}`).then(({ data }) => {
        this.todos.splice(index, 1);
      });
    },
    clearCompleted() {
      axios.delete(`/api/todos/clear`).then(() => {
        this.fetchTodos();
      });
    }
  },
  created() {
    this.fetchTodos();
  },
  directives: {
    'todo-focus': function (el, binding) {
      if (binding.value) {
        el.focus()
      }
    }
  }
};
</script>