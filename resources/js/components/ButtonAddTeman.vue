<template>
<div class="container-fluid p-0 m-0">
    <div v-if="user.name !== gw.name">
        <button class="btn btn-primary">Tambahkan Teman</button>
    </div>
    <div v-else>
        <button class="btn btn-primary">Edit Profile</button>
    </div>
</div>
</template>
<script>
export default {
    props: ["user", "gw"],
    mounted(){
        console.log(this.user);
        console.log(this.gw);
    },
    methods: {
        addTeman(){

        },
        hapusTeman(){

        }
    }
}
</script>