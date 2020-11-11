<template>
    <div
        class="modal fade"
        id="previewPesan"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Kirim ke {{ teman.name }}
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        id="btnTutupModal"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img
                        src=""
                        class="img-fluid"
                        alt="Responsive image"
                        id="preview"
                        :style="{display: display}"
                    />
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <form
                            v-on:submit.prevent="kirimPesan"
                            enctype="multipart/form-data"
                            id="formpesan"
                        >
                            <div class="form-row m-0 p-0">
                                <slot></slot>
                                <div class="col-sm-10">
                                    <textarea
                                        id="deskripsi"
                                        autocomplete="off"
                                        v-model="deskripsi"
                                        name="deskripsi"
                                        type="text"
                                        class="form-control"
                                        placeholder="Deskripsi..."></textarea>
                                </div>
                                <div class="col-md-2">
                                    <button
                                        class="btn btn-primary"
                                        style="width: 100%"
                                    ><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["teman", "user"],
    data() {
        return {
            deskripsi: "",
            display: "block"
        }
    },
    mounted(){
        console.log(this.teman);
        console.log(this.user);
    },
    methods: {
        kirimPesan(e){
                var form = new FormData(e.target);
                const pesangambar = document.querySelector("#pesangambar");
                form.append('pesangambar', test.files[0]);

                axios.post(`/api/pesan/${this.teman.id}/kirimpesan`, form, {
                    headers: {
                    'Content-Type': 'multipart/form-data',
                },
                params: {
                    api_token: this.user.api_token
                }  
            }).then( response => {
                const formPesan = document.querySelector("#formpesan");
                formPesan.reset();
                document.querySelector("#btnTutupModal").click();
                this.display = "none";
                document.querySelector("#deskripsi").value = "";

                this.$parent.$data.pesans.unshift(response.data.original);
                console.log(response.data);
            }).catch( error => {
                console.log(error);
            });
        }
    }
};
</script>
