<template>
    <div class="main">
        <div class="container-fluid" style="padding-top: 2.5%">
            <h4 class="page-title"><i class="lnr lnr-funnel"> </i> Profile: {{ user.name }}</h4>
            <div v-if="showAlertSuccess" id="" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-check-circle"></i> {{ alertSuccessMessage }}
            </div>
            <div v-if="showAlertError" class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> {{ alertErrorMessage }}
            </div>
            <form method="POST" @submit.prevent="update">
                <div class="form-group row">
                    <div class="col-md-8 col-md-offset-2">
                        Password: <input v-model="password" type="password" required class="form-control" />
                        <span v-if="errors.length > 0" class="invalid-feedback">
                            <strong>{{ errors[0] }}</strong>
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 col-md-offset-2">
                        Password Confirmation: <input v-model="passwordConfirmation" type="password" required class="form-control" />
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Edit.vue",

    data() {
        return {
            user: JSON.parse(localStorage.getItem('user')),
            password: '',
            passwordConfirmation: '',
            showAlertSuccess: false,
            showAlertError: false,
            alertSuccessMessage: '',
            alertErrorMessage: '',
            errors: [],
        }
    },

    watch: {
        showAlertSuccess: function(oldval, newval) {
            if(oldval != newval) {
                setTimeout(function() {
                    this.showAlertSuccess = false;
                    $(".alert").slideUp(300);
                }, 2500)
            }
        },

        showAlertError: function(oldval, newval) {
            if(oldval != newval) {
                setTimeout(function() {
                    this.showAlertError = false;
                    $(".alert").slideUp(300);
                }, 2500)
            }
        }
    },

    methods: {

        update() {
            let id = this.user.id
            let length = this.errors.length
            this.errors.splice(0, length)

            if(this.password != this.passwordConfirmation)
            {
                this.errors.push('Password is not the same')
                return;
            }

            if(this.password.length < 8)
            {
                this.errors.push('Password is too short')
                return;
            }

            let data = {
                'password': this.password
            }

            this.$http.put('/api/v1/users/' + id, data)
                .then(response => {
                    this.showAlertSuccess = true;
                    this.alertSuccessMessage = response.data.message
                    this.password = '';
                    this.passwordConfirmation = '';
                })
                .catch(error => {
                    this.errors.push()
                });
        }

    },
}
</script>
