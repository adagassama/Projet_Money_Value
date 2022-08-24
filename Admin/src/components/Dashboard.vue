<template>
  
    <h1>Vue 3 Crud</h1>
    
   <div class="container" style="margin-top:30px">
    <table class="table table-hover table-bordered" id="example">
      <thead>
        <tr>
          <th>ID</th>
          <th>FROM</th>
          <th>TO</th>
          <th>RATE</th>
          <th>UPDATE</th>
          <th>DELETE</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pair in pairs" :key="pair.id">
          <td>{{pair.id}}</td>
          <td>{{pair.from.code}}</td>
          <td>{{pair.to.code}}</td>
          <td>{{pair.conversion}}</td>
          <td>OK</td>
          <td>OK</td>
        </tr>
        
      </tbody>
    </table>
  </div>
 
</template>
<script>
//Bootstrap and jQuery libraries
//import "bootstrap/dist/css/bootstrap.css";
import 'bootstrap/dist/css/bootstrap.min.css';
import "bootstrap-vue/dist/bootstrap-vue.css";
import axios from 'axios';
export default {
 
  mounted(){
    //API Call
    axios
    .get("http://127.0.0.1:8000/api/pairs")
    .then((res)=>
    {
      this.pairs = res.data.data;
      console.log(this.pairs)
     
    })
  },
  data: function() {
        return {
            pairs:[]
        }
    },
}
</script>