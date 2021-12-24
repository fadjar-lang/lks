<template>
<div>
  <Navbar></Navbar>
  <div class="container mt-4">
    <img :src="'http://127.0.0.1:8000/img/'+barangs.foto" width="500px">
    <h1>{{barangs.nama_barang}}</h1>
    <h2>{{barangs.harga}}</h2>
    <p>{{barangs.keterangan}}</p>
  </div>
</div>
</template>

<script>
import Navbar from '../components/Navbar.vue';
export default {
  components: {Navbar},
  data(){
    return {
      barangs: {}
    }
  },

  methods: {
    getData(){
      axios.get(`http://127.0.0.1:8000/api/detail/barang/${this.$route.params.id}`).then((response) => {
        this.barangs = response.data.data;
      })
    }
  },

  mounted(){
    this.getData()
  }
}
</script>

<style>

</style>