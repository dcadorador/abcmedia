<template>
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle">
            <div class="auth-box ">
                <div class="left">
                    <div class="content text-left">
                        <div class="header">
                            <p class="lead">Register</p>
                        </div>

                        <form method="POST" @submit.prevent="register">
                            <div class="form-group text-left">
                                <label for="name" class="control-label sr-only">Name</label>
                                <input name="name" type="text" class="form-control" v-model="user.name" placeholder="Name">
                                <span v-if="errors.length > 0" class="invalid-feedback">
                                        <strong>{{ errors[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group text-left">
                                <label for="email" class="control-label sr-only">E-mail Address</label>
                                <input name="email" type="email" class="form-control" v-model="user.email" placeholder="Email">
                            </div>
                            <div class="form-group text-left">
                                <label for="password" class="control-label sr-only">Password</label>
                                <input name="password" class="form-control" v-model="user.password" type="password" placeholder="Password">
                                <span v-if="passwordErrors.length > 0" class="invalid-feedback">
                                        <strong>{{ passwordErrors[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group text-left">
                                <label for="passwordConfirmation" class="control-label sr-only">Password Confirmation</label>
                                <input name="passwordConfirmation" class="form-control" v-model="user.passwordConfirmation" type="password" placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-danger btn-0lg btn-block">
                                Register
                            </button>
                        </form><br/>
                        <a href="/login" class="btn btn-info btn-0lg btn-block">
                            Login
                        </a>
                    </div>
                </div>
                <div class="right">
                    <div class="overlay"></div>
                    <div class="content text not-mid">
                        <h1 class="heading text-center">Welcome to Sample Application</h1>
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
            user: {
              name: '',
              email: '',
              password: '',
              passwordConfirmation: '',
            },
            errors: [],
            passwordErrors: [],
        }
    },

    computed: {

    },

    methods: {

        register() {

            let length = this.errors.length
            this.errors.splice(0, length)

            let password_error_length = this.passwordErrors.length
            this.passwordErrors.splice(0, password_error_length)

            if(this.user.password != this.user.passwordConfirmation)
            {
                this.passwordErrors.push('Password is not the same')
                return;
            }

            if(this.user.password.length < 8)
            {
                this.passwordErrors.push('Password is too short')
                return;
            }

            let data = {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password
            }

            this.$http.post('/api/v1/register', data)
            .then(response => {
                this.$router.push({
                    name: 'login'
                })
            })
            .catch(error => {
                this.errors.push(error.message)
            });

        },

    }
}
</script>
