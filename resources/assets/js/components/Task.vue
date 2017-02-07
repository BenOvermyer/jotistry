<template>
    <div class="task">
        <button class="save-task button is-primary">
            <span class="icon is-small"><i class="fa fa-save"></i></span> Save
        </button>
        <a class="complete-task" v-on:click="completeTask">
            <span class="icon is-small"><i class="fa" v-bind:class="checkState"></i></span>
        </a>
        <div contenteditable>{{ content }}</div>
        <span class="task-id">{{ id }}</span>
    </div>
</template>

<script>
    module.exports = {
        methods: {
            completeTask: function () {
                this.$emit( 'complete' );
            }
        },
        computed: {
            checkState: function () {
                return {
                    'fa-square-o': !this.is_completed,
                    'fa-check-square-o': this.is_completed
                }
            }
        },
        props: [ 'content', 'id', 'is_completed' ]
    }
</script>