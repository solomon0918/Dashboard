<template>
  <div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
              <img src="/img/ctk-logo.png" width="200" height="74" alt="California Ticket King">
          </div>
          <br/>
          <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="" id="loginForm">
              <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <input id="email" type="email" class="form-control" name="email" placeholder="E-Mail Address" required autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                      </span>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
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

.card {
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}

.card {
  height: 60%;
  min-width: 300px;
  max-width: 500px;
  padding: 40px;
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
    methods: {
        authenticate(){
            this.$store.dispatch('login');

            login(this.$data.form)
                .then((res) => {
                    this.$store.commit("loginSuccess", res);
                    this.$router.push({ path: '/' });
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
