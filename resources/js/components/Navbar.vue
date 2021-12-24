<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link active" aria-current="page" :to="{name: 'home'}">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" :to="{name: 'cart'}"><i class="fas fa-shopping-cart"></i><span class="ml-5 badge bg-success">{{angka}}</span></router-link>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link active">Login</a>
            </li>
          </ul>
        </div>
      </div>
  </nav>
  </div>
</template>

<script>
export default {
  data(){
    return {
      token: localStorage.getItem("token"),
      loggedIn: localStorage.getItem("loggedIn"),
      angka: {}
    }
  },

  methods: {
    count(){
      axios({
        method: "GET",
        url: 'http://127.0.0.1:8000/api/pesanan',
        headers: {
          Accept: 'application/json',
          "Content-Type": 'application/json',
          Authorization: "Bearer " +this.token
        }
      }).then((response) => {
        this.angka = response.data.data
      })
    }
  },

  mounted(){
    this.count()
  }
}
</script>