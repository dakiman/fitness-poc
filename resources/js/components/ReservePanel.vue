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

                                    <div>
                                        <b-form-group label="Name" id="nameInput" description="Please tell us who you are">
                                            <b-form-input @focus="errors.name = undefined" v-model="name" type="text" :class="{ 'is-invalid' : errors.name }" trim></b-form-input>
                                            <div v-if="errors.name">
                                                <small v-for="error in errors.name" id="nameError" class="form-text  text-danger">{{error}}</small>
                                            </div>
                                        </b-form-group>
                                    </div>

                                    <div>
                                        <b-form-group label="Email address" id="inputEmail" description="We will never share you email with anyone">
                                        <b-form-input @focus="errors.email = undefined" v-model="email" type="email" :class="{ 'is-invalid' : errors.email }" trim></b-form-input>
                                            <div v-if="errors.email">
                                                <small v-for="error in errors.email" id="emailError" class="form-text text-danger">{{error}}</small>
                                            </div>
                                        </b-form-group>
                                    </div>

                                    <div>
                                        <b-form-group label="Phone Number" id="phoneNumberInput" description="We will never share you phone number with anyone">
                                        <b-form-input @focus="errors.phoneNumber = undefined" v-model="phoneNumber" type="text" :class="{ 'is-invalid' : errors.phoneNumber }" id="phoneNumberInput"> </b-form-input>
                                            <div v-if="errors.phoneNumber">
                                            <small v-for="error in errors.phoneNumber" id="phoneNumberError" class="form-text text-danger">{{error}}</small>
                                            </div>
                                        </b-form-group>
                                    </div>

                                    <div >
                                    <b-button :class="{ 'btn-danger' : loading }" @click="createReservation" type="submit" class="btn btn-primary">
                                        <b-spinner small v-if="loading"></b-spinner>
                                          Submit
                                    </b-button>
                                    </div>
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
                    .post('/reservations', this.$data)
                    .then(response => {
                        console.log(response);
                        this.loading = false;
                        alert('Success!')
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
