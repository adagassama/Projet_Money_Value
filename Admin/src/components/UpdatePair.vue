<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">MODIFICATION DE PAIRE</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="from_id">From</label>
                            <input type="number" class="form-control" name="from_id" v-model="pair.from_id">
                                                 
                        </div>
                        <div class="form-group">
                            <label for="to_id">To</label>
                            <input type="number" class="form-control" name="to_id" v-model="pair.to_id" >

                        </div>
                        <div class="form-group">
                            <label for="conversion">Taux de conversion</label>
                            <input type="number" class="form-control" name="conversion" v-model="pair.conversion" >
                        </div>
                        <br>
                        <div class="form-group">
                            <button @click.prevent="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';
export default {
  setup() {
    const pair = reactive({
      from_id: '',
      to_id: '',
      conversion:'',
    });
    const validation = ref([]);
    const router = useRouter();
    const route = useRoute();
    
    onMounted(() => {
      axios
        .get(`http://localhost:8000/api/pairs/${route.params.id}`)
        .then((response) => {
            console.log(response);
          pair.from_id = response.data.data.from_id;
          pair.to_id = response.data.data.to_id;
          pair.conversion = response.data.data.conversion;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });
    function submit() {
        let from_id = pair.from_id;
        let to_id = pair.to_id;
        let conversion = pair.conversion;

        axios
            .put(`http://localhost:8000/api/pairs/${route.params.id}`, {
            from_id: from_id,
            to_id: to_id,
            conversion: conversion
            })
            .then((response) => {
                console.log(response);
                router.push({
                 name: 'admin',
                });
            })
            .catch((error) => {
            console.log(error);
        });
    }
    return {
      pair,
      validation,
      router,
      submit,
    };
  },
};
</script>
