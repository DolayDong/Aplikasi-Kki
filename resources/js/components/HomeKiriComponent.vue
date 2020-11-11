<template>
  <div class="container-fluid">
    <div class="col fixed-top" style="max-width: 25%; max-height: 40%; top: 2%">
      <div class="container-fluid">
        <h3>Teman Aktif</h3>
        <ul class="list-unstyled">
          <li class="media shadow-sm align-items-center p-2 page-link" :key="teman.id" v-for="teman in temans" style="cursor: pointer;" @click.prevent="pindahHalamanPesan(teman.teman.nama_teman)">
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
    <div
      class="col fixed-bottom list-group-item-action"
      style="max-width: 25%; max-height: 40%; bottom: 2%"
    >
      <div class="container-fluid">
        <span class="badge badge-pill badge-primary" style="width: 100%" @click="cariteman()">
          <svg
            width="3em"
            height="3em"
            viewBox="0 0 16 16"
            class="bi bi-search"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"
            />
            <path
              fill-rule="evenodd"
              d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"
            />
          </svg>
          Cari Teman
        </span>
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
        console.log(this.temans)
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