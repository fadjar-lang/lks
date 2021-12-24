<template>
  <div>
    <div class="container">
      <h1>Tambah Barang</h1>
      <form @submit.prevent="add">
        <input type="text" v-model="post.nama_barang" class="form-control" placeholder="Nama Barang">
        <input type="text" v-model="post.harga" class="form-control mt-2" placeholder="Harga Barang">
        <input type="text" v-model="post.keterangan" class="form-control mt-2" placeholder="Keterangan">
        <label for="">Foto</label>
        <input type="file" v-on:change="fotoChange" class="form-control" >
        <label for="">File</label>
        <input type="file" v-on:change="fileChange" class="form-control">
        <br>
        <button type="submit" class="btn btn-success">Save</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
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
     fotoChange(e){
      this.post.foto = e.target.files[0];
    },

    fileChange(e){
      this.post.file = e.target.files[0];
    },

    add(){
      let input = new FormData();
      input.append("nama_barang", this.post.nama_barang);
      input.append("harga", this.post.harga);
      input.append("keterangan", this.post.keterangan);
      input.append("foto", this.post.foto);
      input.append("file", this.post.file);
      
      axios.post('http://127.0.0.1:8000/api/barang/store', input).then((response) => {
        this.$router.push({name: 'barang'});
        this.$toasted.show(response.data.message, {
          type: 'success',
          duration: 3000
        });

      })
    }
  }
}
</script>

<style>

</style>