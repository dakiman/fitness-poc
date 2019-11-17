<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        Make a reservation

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-5">

                                <v-date-picker
                                    :value="null"
                                    color="red"
                                    is-dark
                                    is-inline
                                    mode="single"
                                    v-model="selectedDate"
                                />

                            </div>

                            <div class="col-md-7">
                                <div v-if="!hasSelectedDate">
                                    Please select a date to continue...
                                </div>
                                <div class="form">
                                    <transition name="fade">
                                        <div v-if="hasSelectedDate">
                                            <b-form-group description="Please tell us who you are" id="nameInput"
                                                          label="Name">
                                                <b-form-input :class="{ 'is-invalid' : errors.name }"
                                                              @focus="errors.name = undefined"
                                                              trim type="text"
                                                              v-model="name"></b-form-input>
                                                <div v-if="errors.name">
                                                    <small class="form-text  text-danger" id="nameError"
                                                           v-for="error in errors.name">{{error}}
                                                    </small>
                                                </div>
                                            </b-form-group>
                                        </div>
                                    </transition>

                                    <transition name="fade">
                                        <div v-if="hasEnteredName">
                                            <b-form-group description="Your email lets us contact you regarding your reservation"
                                                          id="inputEmail"
                                                          label="Email address">
                                                <b-form-input :class="{ 'is-invalid' : errors.email }"
                                                              @focus="errors.email = undefined" trim
                                                              type="email" v-model="email"></b-form-input>
                                                <div v-if="errors.email">
                                                    <small class="form-text text-danger" id="emailError"
                                                           v-for="error in errors.email">{{error}}
                                                    </small>
                                                </div>
                                            </b-form-group>
                                        </div>
                                    </transition>

                                    <transition name="fade">
                                        <div v-if="hasEnteredEmail">
                                            <b-form-group description="We will never share you phone number with anyone"
                                                          id="phoneNumberInput"
                                                          label="Phone Number">
                                                <b-form-input :class="{ 'is-invalid' : errors.phoneNumber }"
                                                              @focus="errors.phoneNumber = undefined"
                                                              id="phoneNumberInput" type="text"
                                                              v-model="phoneNumber"></b-form-input>
                                                <div v-if="errors.phoneNumber">
                                                    <small class="form-text text-danger" id="phoneNumberError"
                                                           v-for="error in errors.phoneNumber">{{error}}
                                                    </small>
                                                </div>
                                            </b-form-group>
                                        </div>
                                    </transition>

                                    <div v-if="hasFilledForm">
                                        <b-button :class="{ 'btn-secondary' : loading , 'btn-success' : isFinished }"
                                                  :disabled='isFinished' @click="createReservation"
                                                  class="btn btn-primary btn-block"
                                                  type="submit">
                                            <b-spinner small v-if="loading"></b-spinner>
                                            <span v-if="!isFinished">Submit </span>
                                            <span v-if="isFinished">✔ Reservation Successful! </span>
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
                isFinished: false,
                errors: {},
            }
        },
        mounted() {

        },
        methods: {
            createReservation() {
                this.loading = true;
                axios
                    .post('/reservations', this.$data)
                    .then(response => {
                        this.loading = false;
                        this.isFinished = true;
                    })
                    .catch(error => {
                        this.loading = false;
                        this.errors = error.response.data.errors;
                    })
            }
        },
        computed: {
            hasSelectedDate: function () {
                return !!this.selectedDate;
            },
            hasEnteredName: function () {
                return this.name.length > 2;
            },
            hasEnteredEmail: function () {
                return this.email.match("[^@]+@[^\.]+\..+");
                // return this.email.includes('@');
            },
            hasEnteredPhone: function () {
                return this.phoneNumber.length > 7
            },
            hasFilledForm: function () {
                return !!this.hasSelectedDate
                    && !!this.hasEnteredName
                    && !!this.hasEnteredEmail
                    && !!this.hasEnteredPhone
            }
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 1.25s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
