<template>
  <div class="container" id="loginMain">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
              <img src="/img/ctk-logo.png" width="200" height="74" alt="California Ticket King">
          </div>
          <br/>
          <div class="col-sm-12 col-md-12 col-lg-12">
            <form @submit.prevent="authenticate" id="loginForm">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="authError">
                {{ authError }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <input id="email" type="email" class="form-control" v-model="form.email" name="email" placeholder="E-Mail Address" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                      </span>
                  </div>
                  <input id="password" type="password" class="form-control" v-model="form.password" name="password" placeholder="Password" required>
                </div>
              </div>

              <div class="form-group">
                <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember">Remember Me
                  </label>
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-sign-in"></i> Login
                </button>

                <a class="btn btn-link" href="">
                    Forgot Your Password?
                </a>
              </div>
              <hr>
              <div class="form-group">
                <a class="btn btn-secondary" href="/register">
                    <i class="fa fa-sign-in"></i> Create Account
                </a>
              </div>
            </form>        
          </div>  
        </div>

      </div>
    </div>
  </div>
</template>

<style>
body{
  background-image: url("/img/traffic-background.jpg");
  background-size: cover;
  background-repeat: no-repeat;
}
</style>

<style scoped>
.card {
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}

.card {
  height: 65%;
  min-width: 400px;
  max-width: 550px;
  padding: 40px;
}
.error{
    text-align: center;
}
</style>


<script>
  import {login} from '../../helpers/auth';

  export default {
    name: "login",
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            error: null
        }
    },
    created: function(){
        // document.querySelector('body').style.backgroundColor = 'blue';
    },
    methods: {
        authenticate(){
            this.$store.dispatch('login');

            login(this.$data.form)
                .then((res) => {
                    this.$store.commit("loginSuccess", res);
                    this.$router.go({
                        path: '/',
                        force: true
                    });
                })
                .catch((error) => {
                    this.$store.commit("loginFailed", {error});
                });
        }
    },
    computed: {
        authError(){
            return this.$store.getters.authError;
        }
    }
}
</script>
