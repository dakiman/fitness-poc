<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make a reservation</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <v-date-picker
                                    mode="single"
                                    :value="null"
                                    color="red"
                                    is-dark
                                    is-inline
                                    v-model="selectedDate"
                                />
                            </div>
                            <div class="col-md-7">
                                <div class="form">
                                    <div class="form-group">
                                        <label for="nameInput">Name</label>
                                        <input :class="{ 'is-invalid' : errors.phoneNumber }" v-model="name" type="text" class="form-control" id="nameInput"
                                               placeholder="Name">
                                        <!--                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input v-model="email" type="email" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email
                                            with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNumberInput">Phone Number</label>
                                        <input @focus="errors.phoneNumber = undefined" v-model="phoneNumber" type="text" :class="{ 'is-invalid' : errors.phoneNumber }" class=" form-control"
                                               id="phoneNumberInput" placeholder="Phone Number">
                                        <div v-if="errors.phoneNumber">
                                            <small v-for="error in errors.phoneNumber" id="phoneNumberError" class="form-text text-muted">{{error}}</small>
                                        </div>
                                    </div>
                                    <div class="form-group form-check">
                                        <!--                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">-->
                                        <!--                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>-->
                                    </div>
                                    <button :class="{ 'btn-danger' : loading }" @click="createReservation" type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedDate: null,
                name: '',
                email: '',
                phoneNumber: '',
                loading: false,
                errors: {},
            }
        },
        mounted() {

        },
        methods: {
            printDate() {
                console.log(this.$data);
            },
            createReservation() {
                this.loading = true;
                axios
                    .post('/reserve', this.$data)
                    .then(response => {
                        console.log(response);
                        this.loading = false;
                        alert('Sucess!')
                    })
                    .catch(error => {
                        console.log(error.response.data.errors);
                        this.loading = false;
                        this.errors = error.response.data.errors;
                    })
            }
        }
    }
</script>
