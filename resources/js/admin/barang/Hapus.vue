<template>
  <div>
    <button class="btn btn-danger" @click.prevent="hapus" ref="hapus">Hapus</button>
  </div>
</template>

<script>
export default {
  props: ['endpoint'],
  methods: {
    
    hapus(){
      let con = confirm('are you sure?');
      if (con == true) {
        axios.delete(`http://127.0.0.1:8000/api/barang/delete/${this.endpoint}`).then((response) => {
        this.$toasted.show(response.data.message, {
          type: 'success',
          duration: 3000
        });
        this.$refs.hapus.parentNode.parentNode.parentNode.remove();
      })
      }
    }
  }
}
</script>

<style>

</style>