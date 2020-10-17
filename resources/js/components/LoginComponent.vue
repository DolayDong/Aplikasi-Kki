<template>
  <div class="container shadow-sm p-5 my-5">
    <div class="row my-auto">
      <div class="col-8 text-center my-auto">
        <div class="text-center align-items-center">
          <h1 class="align-content-center">Selamat Datang</h1>
          <p class="justify-content-center">
            Bagikan pengalaman hebat anda dengan teman dekat disini
          </p>
        </div>
      </div>
      <div class="col-4 shadow-lg">
        <form class="p-5" method="post" action="/login">
          <!-- slot untuk token csrf -->
          <slot> </slot>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="username-login">Username</label>
              <input
                type="text"
                class="form-control"
                :class="errorsvalidasi.class"
                id="username-login"
                name="username-login"
                v-model="datalogin.username"
                v-on:keyup="validasi()"
              />
              <div class="invalid-feedback">
                {{ errorsvalidasi.email }}
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="password-login">Password</label>
              <input
                type="password"
                class="form-control"
                name="password-login"
                id="password-login"
                v-model="datalogin.password"
                v-on:keyup="validasi()"
              />
              <div class="valid-feedback"></div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="custom-control custom-checkbox text-center">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  name="rememberme"
                  id="rememberme"
                />
                <label class="custom-control-label" for="rememberme"
                  >Ingat saya</label
                >
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <button
                type="submit"
                class="btn btn-primary w-100"
                :disabled="validasi()"
              >
                Login
              </button>
            </div>
            <div class="col-md-12 mb-3">
              <button
                v-on:click.prevent
                class="btn btn-primary w-100"
                data-toggle="modal"
                data-target="#staticBackdrop"
              >
                Daftar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginComponent",
  data() {
    return {
      datalogin: {
        username: undefined,
        password: undefined,
      },
      errorsvalidasi: {},
    };
  },
  mounted() {
    console.log(this.datalogin.username);
  },
  methods: {
    validasi() {
      if (this.datalogin.username !== undefined) {
        if (this.datalogin.username.indexOf("@") <= 0) {
          this.errorsvalidasi = {
            class: "is-invalid",
            email: "email kehilangan karakter @",
          };
          return true;
        } else {
          if (
            this.datalogin.username.charAt(
              this.datalogin.username.length - 4
            ) !== "." &&
            this.datalogin.username.charAt(
              this.datalogin.username.length - 3
            ) !== "." &&
            this.datalogin.username.charAt(
              this.datalogin.username.length - 6
            ) !== "."
          ) {
            this.errorsvalidasi = {
              class: "is-invalid",
              email: "harap memasukkan email valid!",
            };
            return true;
          } else {
            this.errorsvalidasi = {
              class: "is-valid",
              email: "",
            };
            if (
              this.datalogin.password !== undefined &&
              this.datalogin.password.length > 5
            ) {
              return false;
            } else {
              return true;
            }
          }
        }
      } else {
        return true;
      }
    },
  },
};
</script>
