<template>
  <div>
    <Nav></Nav>
    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="pesanan in pesanans" :key="pesanan.id_pesanan">
            <td>{{pesanan.nama_barang}}</td>
            <td>{{pesanan.jumlah_harga}}</td>
            <Hapus :endpoint="pesanan.id_pesanan"></Hapus>
          </tr>
          <br>
            <td class="mt-3"> <strong>Harga Total: Rp. {{sum}}</strong> </td>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Nav from '../components/Navbar.vue';
import Hapus from './Deletepesan.vue';
export default {
  components: {Nav, Hapus},

  data(){
    return {
      token: localStorage.getItem("token"),
      loggedIn: localStorage.getItem("loggedIn"),
      pesanans: {},
      sum: {},
    }
  },

  methods: {
    getData(){
      axios({
        method: "GET",
        url: 'http://127.0.0.1:8000/api/pesanan/detail',
        headers: {
          Authorization: "Bearer " + this.token,
          Accept: 'application/json',
          "Content-Type": 'apllication/json',
        }
      }).then((response) => {
        this.pesanans = response.data.data;
      })
    },

    sumData(){
       axios({
        method: "GET",
        url: 'http://127.0.0.1:8000/api/pesanan/jumlah',
        headers: {
          Authorization: "Bearer " + this.token,
          Accept: 'application/json',
          "Content-Type": 'apllication/json',
        }
      }).then((response) => {
        this.sum = response.data.data;
      })
    },

  },

  mounted(){
    this.getData();
    this.sumData();
  }
}
</script>