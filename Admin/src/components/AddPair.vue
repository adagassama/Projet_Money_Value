<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">AJOUT D'UNE NOUVELLE PAIRE</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="from_id">From</label>
                            <select
                                v-model="formData.from_id"
                                class="form-control" 
                                name="from_id">
                                <option v-for="currency in currencies" :key="currency.id" 
                                :value="currency.id">{{ currency.code }}</option>
                            </select>                          
                        </div>
                        <div class="form-group">
                            <label for="to_id">To</label>
                            <select
                                v-model="formData.to_id"
                                class="form-control" 
                                name="to_id">
                                <option v-for="currency in currencies" :key="currency.id" 
                                :value="currency.id">{{ currency.code }}</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="rates">Taux de conversion</label>
                            <input type="number" class="form-control" name="rates" v-model="formData.rates">
                        </div>
                        <br>
                        <div class="form-group">
                            <button @click.prevent="createPair" class="btn btn-primary">Ajouter</button>
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
                from_id: '',
                to_id: '',
                rates: ''
            },
            currencies: []
        }
    },
    methods: {
        createPair() {
            axios.post('http://127.0.0.1:8000/api/pairs', this.formData).then((response) => {
                console.log('Paire ajoutée avec succès!')
                this.$router.push('/admin')
                this.$toast.success('Paire ajoutée avec succès!')
            }).catch((error) => {
                console.log(error)
            });
        }
    },
    mounted() {
        //API Call
        axios.get("http://127.0.0.1:8000/api/currencies").then((res) => {
        this.currencies = res.data.data;
        console.log(this.currencies);
    });
  }
}
</script>

<style>
.container{
    padding-top: 100px;
}
</style>