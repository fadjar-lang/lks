<template>
  <div class="container">
    <h1>Edit Barang</h1>
    <form @submit.prevent="update">
      <input type="text" v-model="post.nama_barang" class="form-control" >
      <input type="text" v-model="post.harga" class="form-control mt-2" >
      <input type="text" v-model="post.keterangan" class="form-control mt-2" >
      <input type="file" v-on:change="fotoChange" class="form-control mt-2">
      <input type="file" v-on:change="fileChange" class="form-control mt-2">
      <br>
      <button type="submit" class="btn btn-success">Update</button>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
      post: {
        nama_barang: '',
        harga: '',
        keterangan: '',
        foto: '',
        file: ''
      }
    }
  },

  methods: {
    barang(){
      axios.get(`http://127.0.0.1:8000/api/barang/show/${this.$route.params.id}`).then((respone) => {
        this.post = respone.data.data;
      })
    },

    fotoChange(e){
      this.post.foto = e.target.files[0];
    },

    fileChange(e){
      this.post.file = e.target.files[0];
    },

    update(){
      let input = new FormData();
      input.append("nama_barang", this.post.nama_barang);
      input.append("harga", this.post.harga);
      input.append("keterangan", this.post.keterangan);
      input.append("foto", this.post.foto);
      input.append("file", this.post.file);

      axios.post(`http://127.0.0.1:8000/api/barang/edit/${this.$route.params.id}`, input).then((respone) => {
        this.$router.push({name: 'barang'});
        this.$toasted.show(respone.data.message, {
          type: 'success',
          duration: 3000
        });

      })
    }
  },

  mounted(){
    this.barang();
  }
}
</script>

<style>

</style>