<template>
<div class="container-fluid p-0 m-0">
    <div v-if="user.name !== gw.name">
        <div v-if="!teman" class="btn btn-primary" @click="addTeman()">Ikuti</div>
        <div class="btn btn-warning" @click="hapusTeman()" v-else>Berhenti Mengikuti</div>
    </div>
    <div v-else>
        <button class="btn btn-primary">Edit Profile</button>
    </div>
</div>
</template>
<script>
export default {
    name: "ButtonAddTeman",
    props: ["user", "gw", "mengikuti", "datas"],
    data(){
        return{
           teman: false
        }
    },
    mounted(){
        if(this.mengikuti !== undefined){
            this.teman = this.mengikuti;
        }
        console.log(this.user);
    },
    methods: {
        addTeman(){
            axios.post('/api/' + this.user.id +'/tambah_teman',{
                api_token: this.gw.api_token
            }).then(response => {
                this.teman = true;
                console.log(response);
            }).catch( error => {
                console.log("error post add teman : " + error);
            });
        },
        hapusTeman(){
            axios.post('/api/' + this.user.id +'/hapus_teman',{
                api_token: this.gw.api_token
            }).then(response => {
                this.teman = false;
                console.log(response);
            }).catch( error => {
                console.log("error post hapus teman : " + error);
            });
        }
    }
}
</script>