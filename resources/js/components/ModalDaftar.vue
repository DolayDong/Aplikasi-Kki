<template>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Buat Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="email-daftar" class="col-sm-2 col-form-label">Email Login</label>
                        <div class="col-sm-10">
                        <input v-model="email" type="email" class="form-control" :class="invalid.email || errorregistrasi.email" id="email-daftar" required v-on:keyup="cek()">
                        <div class="invalid-feedback">
                            {{invalid.pesan}}
                        </div>
                        <div class="invalid-feedback">
                            {{errorregistrasi.pesan}}
                            {{errorregistrasi.pesan}}
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username-pengguna" class="col-sm-2 col-form-label">Username Pengguna</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" :class="invalid.username" id="username-pengguna" required v-model="username" v-on:keyup="cek()">
                         <div class="invalid-feedback">
                            {{invalid.pesan}}
                        </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-daftar" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="password-daftar" v-model="passwordkonfirmasi" v-on:keyup="cek()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-konfirmasi" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" :class="invalid.password" id="password-konfirmasi" required v-model="password" v-on:keyup="cek()">
                         <div class="invalid-feedback">
                            {{invalid.pesan}}
                        </div>
                        </div>
                    </div>
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status" :style="{display: displayLoading}">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="alert alert-danger" role="alert" v-if="errorregistrasi.invalid">
                            {{errorregistrasi.pesan}}
                        </div>
                        <div class="alert alert-success" role="alert" v-if="errorregistrasi.valid">
                            {{errorregistrasi.pesan}}
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" :style="{display: displayButton}" v-on:click="registrasi()" :disabled="cek()">Daftar</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: "ModalDaftar",
    data(){
        return {
            displayButton: 'block',
            username: undefined,
            email: undefined,
            password: undefined,
            passwordkonfirmasi: undefined,
            invalid: {},
            displayLoading: 'none',
            errorregistrasi: {}
        }
    },
    mounted(){
    },
    methods: {
        registrasi(){
            this.displayLoading = 'block';
            this.displayButton = 'none';
            axios.post("/api/registrasi", {
                username: this.username,
                email: this.email,
                password: this.password 
                }).then(response =>{
                    this.displayLoading = 'none';
                    this.errorregistrasi = {
                        valid: true,
                        pesan: "Selamat, akun berhasil didaftarkan! silahkan cek email yang telah kami kirim ke " + this.email + " untuk aktivasi akun"
                        } 
                    this.username = undefined;
                    this.passwordkonfirmasi = undefined;
                    this.password = undefined;
                    this.email = undefined;
                    this.invalid = {password: ''};
                    

                }).catch((err) => {
                    this.displayLoading = 'none';
                    if (err.response.data.error === "username") {
                         this.errorregistrasi = {
                            invalid: true,
                            pesan: err.response.data.message};
                    } 
                    if(err.response.data.error === "email") {
                        this.errorregistrasi = {
                            invalid: true,
                            pesan: err.response.data.message};
                    }
                });
        },
        cek(){
            if (this.username !== undefined && this.email !== undefined && this.password !== undefined && this.passwordkonfirmasi !== undefined) {
                if (this.email.indexOf("@") <= 0) {
                    this.invalid = {
                        email: 'is-invalid',
                        pesan: "email kehilangan karakter @"};
                    return true;
                } else {
                    if (this.email.charAt(this.email.length - 4) !== "." && this.email.charAt(this.email.length - 3) !== "." && this.email.charAt(this.email.length - 6) !== ".") {
                        this.invalid = {
                            email: 'is-invalid',
                            pesan: "email tidak valid"
                         };
                        return true;
                    } else {
                        if (this.username.length < 6) {
                            this.invalid = {
                                username: 'is-invalid',
                                pesan: "username harus lebih dari 6 karakter"
                            };
                            return true;
                        } else {
                            if (this.password.length < 6) {
                                this.invalid = {
                                    password: 'is-invalid',
                                    pesan: "password minimal harus memiliki 6 karakter"
                                    };
                                return true;
                            } else {
                                if (this.password !== this.passwordkonfirmasi) {
                                        this.invalid = {
                                            password: 'is-invalid',
                                            pesan: "password tidak sama"
                                            };
                                        return true;
                                    } else {
                                        this.invalid = {password: 'is-valid'};
                                        return false;
                                    }
                                }
                        }
                    }
                }
            } else {
                return true;
            }
        }
    }
}
</script>