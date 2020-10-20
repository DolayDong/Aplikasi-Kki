<template>
    <div class="col-sm">
        <i class="fa fa-heart-o fa-2x" aria-hidden="true" style="cursor: pointer;" @click="sukai" v-if="!menyukai"></i>
        <i class="fa fa-heart fa-2x" aria-hidden="true" style="cursor: pointer; color: red;" v-else @click="batalSuka"></i>
    </div>
</template>
<script>

export default {
    data(){
        return {
            menyukai: undefined
        }
    },
    props: ["mrPost", "postId", "userId"],
    mounted(){
        this.cekSuka();
    },
    methods: {
        sukai(){
            axios.post(`/api/${this.postId}/like`, {
                api_token: this.userId.api_token,
                postingan_id: this.postId,
                teman_id: this.userId,
                user_id: this.mrPost
            }).then(response => {
                this.menyukai = true;
            }).catch(error => {
                console.log("error : " + error);
            });
        },
        cekSuka(){
            axios.get(`/api/${this.postId}/islike`, {
                params: {
                    api_token: this.userId.api_token
                }
            }).then(response => {
                this.menyukai = response.data.menyukai;
            }).catch(error => {
                console.log("error cek suka: " + error);
            })
        },
        batalSuka(){
           axios.post(`/api/${this.postId}/unlike`, {
                api_token: this.userId.api_token,
            }).then(response => {
                this.menyukai = false;
            }).catch(error => {
                console.log("error : " + error);
            });
        }
    }
};
</script>
