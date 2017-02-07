<template>
    <li>
        <div class="task-category" v-on:click="changeActive">
            <span class="icon is-small"><i class="fa fa-list"></i> </span>
            <span>{{ title }}</span>
        </div>
    </li>
</template>

<script>
    module.exports = {
        data: function() {
            return {
                isActive: false
            }
        },
        methods: {
            changeActive: function () {
                this.$emit( 'activate' );
            }
        },
        props: [ 'title', 'updated_at', 'id' ]
    }
</script>