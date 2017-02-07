require( './bootstrap' );

Vue.component(
    'note',
    require( './components/Note.vue' )
);

Vue.component(
    'task',
    require( './components/Task.vue' )
);

Vue.component(
    'task-category',
    require( './components/TaskCategory.vue' )
);

var notesPageExists = document.getElementById( 'notes-container' );
var tasksPageExists = document.getElementById( 'tasks-container' );

if ( notesPageExists ) {
    let notesApp = new Vue( {
        el: '#notes-container',
        data: {
            notes: [],
            activeNote: {
                title: '',
                body: '',
                id: 0
            },
            newNote: true
        },
        methods: {
            selectNote: function ( note ) {
                this.activeNote.title = note.title;
                this.activeNote.body = note.body;
                this.activeNote.id = note.id;

                this.newNote = false;

                this.notes.forEach( function ( item ) {
                    item.isActive = false;
                    if ( item.id == note.id ) {
                        item.isActive = true;
                    }
                } );
            },
            makeNewNote: function () {
                this.activeNote.title = '';
                this.activeNote.body = '';
                this.activeNote.id = 0;

                this.notes.forEach( function ( item ) {
                    item.isActive = false;
                } );

                this.newNote = true;
            },
            saveNewNote: function () {
                let newNote = {
                    title: this.activeNote.title,
                    body: this.activeNote.body
                };

                axios.post( '/api/notes?api_token=' + window.apiToken, newNote )
                    .then( function ( response ) {
                        newNote.id = response.data.id;
                        newNote.summary = response.data.summary;
                        newNote.created_at = response.data.created_at;
                        newNote.updated_at = response.data.updated_at;
                        notesApp.notes.unshift( newNote );
                    } );
            },
            updateNote: function () {
                let updatedNote = {
                    title: this.activeNote.title,
                    body: this.activeNote.body
                };

                axios.post( '/api/notes/' + this.activeNote.id + '?api_token=' + window.apiToken, updatedNote )
                    .then( function ( response ) {
                        notesApp.notes.forEach( function ( item ) {
                            if ( item.id == response.data.id ) {
                                item.summary = response.data.summary;
                                item.updated_at = response.data.updated_at;
                                item.title = response.data.title;
                                item.body = response.data.body;
                            }
                        } );
                    } );
            },
            deleteNote: function () {
                axios.delete( '/api/notes/' + this.activeNote.id + '?api_token=' + window.apiToken )
                    .then( function ( response ) {
                        notesApp.notes.forEach( function ( item, key ) {
                            if ( item.id == notesApp.activeNote.id ) {
                                notesApp.notes.splice( key, 1 );
                            }
                        } );
                        notesApp.makeNewNote();
                    } );
            }
        },
        mounted() {
            axios.get( '/api/notes?api_token=' + window.apiToken )
                .then( response => this.notes = response.data );
        }
    } );
} else if ( tasksPageExists ) {
    let tasksApp = new Vue( {
        el: '#tasks-container',
        data: {
            tasks: [],
            categories: [
                {
                    title: 'Inbox',
                    id: 0
                }
            ],
            currentCategory: {
                title: 'Inbox',
                id: 0
            },
            newCategory: '',
            newTask: ''
        },
        methods: {
            createNewCategory: function () {
                let data = {
                    title: tasksApp.newCategory
                };
                axios.post( '/api/taskCategories?api_token=' + window.apiToken, data )
                    .then( function ( response ) {
                        tasksApp.categories.push( response.data );
                        tasksApp.changeCategory( response.data );
                    } );
                tasksApp.newCategory = '';
            },
            createNewTask: function () {
                let data = {
                    content: tasksApp.newTask,
                    task_category_id: tasksApp.currentCategory.id
                };

                axios.post( '/api/tasks?api_token=' + window.apiToken, data )
                    .then( function ( response ) {
                        tasksApp.tasks.push( response.data );
                    } );

                tasksApp.newTask = '';
            },
            changeCategory: function ( category ) {
                tasksApp.currentCategory = category;
                axios.get( '/api/tasks/byCategory/' + tasksApp.currentCategory.id + '?api_token=' + window.apiToken )
                    .then( function ( response ) {
                        tasksApp.tasks = response.data;
                    } );
            },
            completeTask: function ( task ) {
                task.is_completed = true;

                axios.post( '/api/tasks/' + task.id + '?api_token=' + window.apiToken, task )
                    .then( function ( response ) {
                        tasksApp.tasks.forEach( function ( item, key ) {
                            if ( item.id == task.id ) {
                                tasksApp.tasks.splice( key, 1 );
                            }
                        } )
                    } )
            }
        },
        mounted() {
            axios.get( '/api/tasks/byCategory/0?api_token=' + window.apiToken )
                .then( function ( response ) {
                    tasksApp.tasks = response.data;
                } );
            axios.get( '/api/taskCategories?api_token=' + window.apiToken )
                .then( function ( response ) {
                    tasksApp.categories = tasksApp.categories.concat( response.data );
                } );
        }
    } );
}


