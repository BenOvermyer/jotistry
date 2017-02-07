<template>
    <div class="box" v-on:click="changeActive">
        <div class="card-block">
            <h4 class="title is-4">{{ title }}</h4>
            <h6 class="subtitle is-6">{{ updated_at }}</h6>
            <div class="content">
                <p>{{ summary }}</p>
            </div>
        </div>
        <span class="note-id">{{ id }}</span>
    </div>
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
        props: [ 'title', 'updated_at', 'summary', 'id' ]
    }
</script>