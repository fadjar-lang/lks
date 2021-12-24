<template>
  <div>
    <div class="container mt-3">
      <form>
        <input type="text" v-model="users.email" class="form-control" placeholder="Email">
        <br>
        <input type="password" v-model="users.password" class="form-control" placeholder="Password">
        <br>
        <!-- <button type="submit" class="btn btn-primary">Login</button> -->
        <VueLoadingButton :loading="isLoading" @click.native="login" :styled="true">Login</VueLoadingButton>
      </form>
    </div>
  </div>
</template>

<script>
import VueLoadingButton from 'vue-loading-button';
export default {
  components: {VueLoadingButton},
  data(){
    return {
      isLoading: false,
      users: {},
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
    }
  },

  methods: {
    login(){
      this.isLoading = true;
      if (this.users.email && this.users.password) {
        axios.post('http://127.0.0.1:8000/api/login', {email: this.users.email, password: this.users.password}).then((response) => {
          this.$toasted.show(response.data.message, {
            duration: 3000,
            type: 'success'
          });
          localStorage.setItem("loggedIn", "true");
          localStorage.setItem("token", response.data.token);
          this.$router.push({name: 'barang'});
        })
      }
    }
  },

  mounted(){
    if (this.loggedIn) {
      this.$router.push({name: 'login'});
    }
  }
}
</script>