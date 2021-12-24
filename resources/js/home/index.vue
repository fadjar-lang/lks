<template>
  <div>
    <Nav></Nav>
    <div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img :src="'http://127.0.0.1:8000/asset/asset4.jpg'" height="400px" class="d-block w-100">
        </div>
        <!-- <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div> -->
      </div>
    </div>

      <h1 class="text-center my-2">Produk Terbaik Kami</h1>


      <div class="row offset-1 my-4">
        <div v-for="barang in barangs" :key="barang.id_barang" class="card mx-4" style="width: 18rem;">
          <img :src="'http://127.0.0.1:8000/img/'+barang.foto" height="200px" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">{{barang.nama_barang}}</h5>
            <p class="card-text">{{barang.keterangan}}</p>
            <router-link :to="{name: 'detailhome', params:{id:barang.id_barang}}" class="btn btn-primary">Detail</router-link>
            <!-- <button id="tombol" @click.prevent="pesan(barang.id_barang)" class="btn btn-danger"><i class="fas fa-shopping-cart"></i></button> -->
            <VueLoadingButton id="tombol" :loading="isLoading" class="btn btn-danger" @click.native="pesan(barang.id_barang)"><i class="fas fa-shopping-cart"></i></VueLoadingButton>
          </div>
        </div>

        <!-- <div class="card mx-4" style="width: 18rem;">
          <img :src="'http://127.0.0.1:8000/asset/asset4.jpg'" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div> -->

        <!-- <div class="card mx-4" style="width: 18rem;">
          <img :src="'http://127.0.0.1:8000/asset/asset4.jpg'" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div> -->
      </div>

      


    </div>

  </div>
</template>

<script>
import Nav from '../components/Navbar.vue';
import VueLoadingButton from 'vue-loading-button';
export default {
  components: {Nav, VueLoadingButton},
  data(){
    return {
      isLoading: false,
      barangs: {},
      token: localStorage.getItem("token"),
      loggedIn: localStorage.getItem("loggedIn")
    }
  },

  methods: {
    getData(){
      axios.get('http://127.0.0.1:8000/api/index/barang').then((response) => {
        this.barangs = response.data.data;
      })
    },

    pesan(id){
      this.isLoading = true;
      if (!this.loggedIn) {
        this.$router.push({name: 'login'})
      }

      axios({
        method: "POST",
        url: `http://127.0.0.1:8000/api/barang/pesan/${id}`,
        headers: {
          Accept: 'application/json',
          "Content-Type": 'application/json',
          Authorization: "Bearer " + this.token
        }
      }).then((response) => {
        this.$toasted.show(response.data.message, {
          duration: 3000,
          type: 'success'
        });
        this.$router.push({name: 'cart'});
      })
    }
  },

  mounted(){
    this.getData();
  }
}
</script>

<style>

</style>