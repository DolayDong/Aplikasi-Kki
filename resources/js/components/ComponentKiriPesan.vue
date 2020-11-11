<template>
  <div class="container-fluid">
    <div class="col fixed-top" style="max-width: 25%; max-height: 40%; top: 2%">
      <div class="container-fluid">
        <h3>Teman Aktif</h3>
        <ul class="list-unstyled">
          <li class="media shadow-sm align-items-center p-2 page-link" v-for="teman in temans" style="cursor: pointer;" @click.prevent="pindahHalamanPesan(teman.teman.nama_teman)">
            <img
              :src="teman.teman.photo_profile"
              class="mr-3 photo-profile"
              
              :alt="teman.teman.nama_teman"
            />
            <div class="media-body">
              <h5 class="mt-0 mb-1">{{teman.teman.nama_teman}}</h5>
            </div>
            <div class="online" 
            v-if="teman.aktif"
            ></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data(){
    return {
      temans: {},
      aktifuser: false,
      dataId: {}
    }
  },
  mounted(){
    this.getListTeman();
  }, 
  methods: {
    cariteman(){
      return window.location.href = "/cariteman";
    },
    getListTeman(){
      axios.get('/api/' + this.user.id + '/listteman').then( response => {
        this.temans = response.data.data;
        console.log(this.temans);
      }).catch( error => {
        console.log("error : " + error); 
      });
    },
    pindahHalamanPesan(user){
      return window.location.href = "/pesan/" + user;
    }
  }
};
</script>