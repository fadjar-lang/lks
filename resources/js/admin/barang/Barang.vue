<template>
  <div>
    <Nav></Nav>
    <div class="container">
      <router-link class="btn btn-success mt-2" :to="{name: 'addbarang'}">Tambah Data</router-link>
      <table class="table table-striped mt-2">
        <thead>
          <tr>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="barang in barangs" :key="barang.id_barang">
            <td>{{barang.nama_barang}}</td>
            <td>{{barang.harga}}</td>
            <td>{{barang.keterangan}}</td>
            <td>
              <img :src="'http://127.0.0.1:8000/img/'+barang.foto" width="200px">
            </td>
            <td><router-link class="btn btn-primary" :to="{name: 'editbarang', params: {id: barang.id_barang}}">Edit</router-link> 
                <router-link class="btn btn-success" :to="{name: 'detailbarang', params: {id: barang.id_barang}}">Detail</router-link>
                <Hapus :endpoint="barang.id_barang"></Hapus>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Nav from './../../components/Navigation.vue';
import Hapus from './Hapus.vue';
export default {
  components: {Hapus, Nav},
  data(){
    return {
      statusModal: false,
      barangs: {},
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
    }
  },

  methods: {

    barang(){
      let head = {
        Accept: 'application/json',
        "Content-Type": 'application/json',
        Authorization: "Bearer " +this.token
      };

      axios.get('http://127.0.0.1:8000/api/barang', {headers: head}).then((response) => {
        this.barangs = response.data.data;
      })
    },
    
    addData(){
      let input = new FormData();
      input.append("nama_barang", this.post.nama_barang);
      input.append("harga", this.post.harga);
      input.append("keterangan", this.post.keterangan);
      input.append("foto", this.post.foto);
      input.append("file", this.post.file);

      axios.post('http://127.0.0.1:8000/api/barang/store', input).then((response) => {
        $("#modal").modal("hide");
        this.$toasted.show(response.data.message, {
          type: 'success',
          duration: 3000
        });
      })
    }

  },

  mounted(){
    this.barang();
    if (!this.loggedIn) {
      this.$router.push({name: 'login'});
    }
  }
}
</script>