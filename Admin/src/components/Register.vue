<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Création Utilisateur</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name">
                            <p class="text-danger" v-text="errors.name"></p>
                        </div>
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
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer Password</label>
                            <input type="password" class="form-control" name="password_confirmation" v-model="formData.password_confirmation">
                            <p class="text-danger" v-text="errors.password_confirmation"></p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button @click="registerUser" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <router-link to="/login">Vous avez déjà un compte?</router-link>
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
        data() {
            return {
                formData: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                errors: {}
            }
        },
        methods: {
            registerUser(){
                axios.post('http://127.0.0.1:8000/api/register', this.formData).then((response) => {
                    this.formData.name = this.formData.email = this.formData.password = this.formData.password_confirmation = ''
                    this.errors = {}
                    this.$router.push('/')
                    this.$toast.success('Compte crée avec succès!')
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                    console.log(errors.response.data.errors)
                });
            }
        }   
    }
</script>
<style>
.container{
    padding-top: 100px;
}
</style>