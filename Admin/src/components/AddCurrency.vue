<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">AJOUT D'UNE NOUVELLE DEVISE</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" v-model="formData.name">
                        </div>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" v-model="formData.code">
                        </div>
                        <div class="form-group">
                            <label for="symbol">Symbol</label>
                            <input type="text" class="form-control" name="symbol" v-model="formData.symbol">
                        </div>
                        <br>
                        <div class="form-group">
                            <button @click.prevent="create" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import axios from "axios";
export default {
    data() {
        return {
            formData: {
                name: '',
                code: '',
                symbol: '',
            }
        }
    },
    methods: {
        // Ajout d'une nouvelle devise
        create() {
            axios.post('http://127.0.0.1:8000/api/currencies', this.formData).then((response) => {
                this.$router.push('/admin')
                this.$toast.success('Devise ajoutée avec succès!')
            }).catch((error) => {
                console.log(error)
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