<template>
    <div class="show-input" @click="toggleShowInput">
        <div v-show="showInput">
            <input @click.stop="" @keypress.enter="createTodo" type="text" placeholder="value" v-model="newItem">
            <button @click.stop="createTodo">Добавить</button>
        </div>
    </div>
    <div>
        <div class="todo__item"  @click="removeTodo(index)" v-for="(item, index) in todosLocal" :key="item.id">
            <div class="todo__item__value">{{ item.value }}</div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            newItem: '',
            todos: [],
            showInput: true,
            todosLocal: localStorage.getItem("todoList") ? JSON.parse(localStorage.getItem("todoList")) : []
        }
    },
    methods: {
        createTodo() {
            if (this.newItem) {
                const newTodo = {id: Date.now(), value: this.newItem};
                this.newItem = '';
                this.todosLocal.push(newTodo);
                localStorage.setItem('todoList', JSON.stringify(this.todosLocal))
             }
            
        },
        removeTodo(index) {
            this.todosLocal.splice(index, 1);
            localStorage.setItem('todoList', JSON.stringify(this.todosLocal))
        },
        toggleShowInput()  {
            if (this.showInput) {
                this.showInput = false;
            } else {
                this.showInput = true;
            }
        },
  }
}
</script>
<style>
    .show-input {
        display: flex;
        height: 60px;
        align-items: center;
        justify-content: flex-end;
        
    }
    input {
        width: 200px;
        height: 20px;
        margin-right: 10px;
    }
    .todo__item {
        width: 300px;
        font-size: 22px;
        margin-bottom: 10px;
        padding: 5px 0 5px 15px;
        border: 1px solid black;
        word-break: keep-all;
    }
    .todo__item__value {
        word-break: break-word;
    }
    
</style>