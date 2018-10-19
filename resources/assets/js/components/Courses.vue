<!-- Here we use vue-tables-2 to be able to work with Laravel and Eloquent so we can work 
easily with filters and return data from the database -->
<template>
    <div>
        <!-- First we create a div where a message of processing will be shown to the user -->
        <div class="alert alert-primary text-center" v-if="processing">
            <i class="fas fa-cog fa-spin"></i>&nbsp; Processing request...
        </div>

        <!--  Here we use the vue server table with the reference table, to access the component -->
        <v-server-table ref="table" :columns="columns" :url="url" :options="options">

            <!--  Here we define a slot for the activate and deactive the   -->
            <div slot="activate_deactivate" slot-scope="props">
                <button
                    v-if="parseInt(props.row.status) === 1"
                    type="button"
                    class="btn btn-danger btn-block"
                    @click="updateStatus(props.row, 3)"
                >
                    <i class="fas fa-ban"></i>&nbsp; {{ labels.reject }}
                </button>
                
                <!-- -->
                <button
                    v-else
                    type="button"
                    class="btn btn-success btn-block"
                    @click="updateStatus(props.row, 1)"
                >
                    <i class="fas fa-thumbs-up"></i>&nbsp; {{ labels.approve }}
                </button>
            </div>

            <div slot="status" slot-scope="props">
                {{ formattedStatus(props.row.status) }}
            </div>

            <!--  Here we create another div with the slot filter__status to filter courses by status.  -->
            <div slot="filter__status" @change="filterByStatus">
                <select class="form-control" v-model="status">
                    <option selected value="0">Select One</option>
                    <option value="1">Published</option>
                    <option value="2">Pending</option>
                    <option value="3">Rejected</option>
                </select>
            </div>

        </v-server-table>
    </div>
</template>

<!-- Next we do the export default of the component courses -->
<script>
    // Here we use Event to look for courses in the database by state -->
    import {Event} from 'vue-tables-2';
    export default {
        name: "courses",
        // First we define the props.
        props: {
            // The labels will be an object and they will be required.
            labels: {
                type: Object,
                required: true
            },
            // Next we define the route to access the courses. This will be a string and will be required.
            route: {
                type: String,
                required: true
            }
        },
        // Next we define data, this will let us use the information inside the component.
        data () {
            return {
                processing: false, // Here the user will see a message while processing the petition.
                status: null, // Status will be null by default.
                url: this.route, // Here we will acces to the props route.
                // Next we define the columns with an array showing the data we will have available.
                columns: ['id', 'name', 'status', 'activate_deactivate'],
                // Next we define the options to customize the table.
                options: {
                    filterByColumn: true, // Filter by column.
                    perPage: 10, // 10 items by default.
                    perPageValues: [10, 25, 50, 100, 500], // Different results options in the dropdown.

                    // Next we define the headings of the table.
                    headings: {
                        id: 'ID', // Id.
                        name: this.labels.name, // Name.
                        status: this.labels.status, // Status.
                        activate_deactivate: this.labels.activate_deactivate, // Activate / Deactivate.
                        approve: this.labels.approve, // Approve.
                        reject: this.labels.reject, // Reject.
                    },
                    
                    // Next we define some custom filters.
                    customFilters: ['status'], // Here we add a customized filter for the column status.
                    sortable: ['id', 'name', 'status'], // Here we will be able to sort clicling on the ID, NAME and STATUS columns.
                    filterable: ['name'], // Here we will be able to filter by name. From the name column.

                    // Next we create the function requestFunction(). 
                    // Here with axios we will be able to make petitions to the server asking for data.
                    requestFunction: function (data) {
                        return window.axios.get(this.url, { // Here we access to the url in props.
                            params: data // Using params: data we send the information.
                        })
                        // If the is any error we use catch with a function using the event.
                        .catch(function (e) {
                            this.dispatch('error', e); // Then, we dispatch the error.
                        }.bind(this));
                    }
                }
            }
        },

        // Here we will define some methods that will be available to use in the component.
        methods: {
            // Filter by Status, with this we will be able to filter by course status (Published, Pending or Rejected).
            filterByStatus() {
                // When we make a petition to the server this will filter by status sending the current status of the course.
                parseInt(this.status) !== 0 ? Event.$emit('vue-tables.filter::status', this.status) : null;
            },

            // Next we create formattedStatus(). With this method we will be able to return the current status of the course.
            formattedStatus(status) {
                const statuses = [
                    null,
                    'Published',
                    'Pending',
                    'Rejected'
                ];
                return statuses[status];
            },

            // Next we define the method updateStatus(). With this method we will be able to approve or reject any course.
            updateStatus (row, newStatus) {
                this.processing = true; // First we make the processing true.
                // Next using setTimout to set a time of 1.5 seconds until the message dissapear.
                setTimeout(() => {
                    // Next we make an http petition..
                    this.$http.post(
                        '/admin/courses/updateStatus', // To this route.
                        {courseId: row.id, status: newStatus},
                        {
                            headers: {
                                'x-csrf-token': document.head.querySelector('meta[name=csrf-token]').content
                            }
                        }
                    )
                        // Here we execute the response from the server.
                        .then(response => {
                            // Here the table hets updated.
                            this.$refs.table.refresh();
                        })
                        // Here if you want to catch the error or exception.
                        .catch(error => {
                            // We run something here to show the error.
                        })
                        //Then we add the finally clausule and we stop the process.
                        .finally(() => {
                            this.processing = false;
                        });
                }, 1500); // Set the timer to 1.5 seconds.
            }
        }
    }
</script>
