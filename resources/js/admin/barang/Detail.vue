<template>
  <div class="container">
    <h1>Detail Barang</h1>
    <h1>{{barangs.nama_barang}}</h1>
    <h2>{{barangs.harga}}</h2>
    <p>{{barangs.keterangan}}</p>
    <img :src="'http://127.0.0.1:8000/img/'+barangs.foto" alt="">
  </div>
</template>

<script>
export default {
  data(){
    return {
      barangs: {}
    }
  },

  methods: {
    getData(){
      axios.get(`http://127.0.0.1:8000/api/barang/show/${this.$route.params.id}`).then((response) => {
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