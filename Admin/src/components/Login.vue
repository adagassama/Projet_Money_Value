<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Connexion</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" v-model="formData.email">
                            <p class="text-danger" v-text="errors.email"></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" v-model="formData.password">
                            <p class="text-danger" v-text="errors.password"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button @click="login" class="btn btn-primary">Connecter</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <router-link to="/register">Créer un nouveau compte!</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
    export default {
        data(){
            return {
                formData: {
                    email: '',
                    password: '',
                    device_name: 'browser'
                },
                errors: {}
            }
        },
        methods: {
            login(){
                axios.post('http://127.0.0.1:8000/api/login', this.formData).then((response) => {
                    console.log(response)
                    localStorage.setItem('token', response.data.token)
                    this.$router.push('/admin')
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }
        }
    }
</script>
<style>
.container{
    padding-top: 100px;
}
</style>