<template>
  <div>
    <button ref="hapus" class="btn btn-danger" @click.prevent="hapus">Delete</button>
  </div>
</template>

<script>
export default {
  props: ['endpoint'],
  data(){
    return {
      token: localStorage.getItem("token"),
      loggedIn: localStorage.getItem("loggedIn")
    }
  },
  methods: {
    hapus(){
      const con = confirm('are you sure?');
      if (con == true) {
        axios({
          method: "DELETE",
          url: `http://127.0.0.1:8000/api/pesanan/hapus/${this.endpoint}`,
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
          this.$refs.hapus.parentNode.parentNode.remove();
        })
      }
    },


  }
}
</script>