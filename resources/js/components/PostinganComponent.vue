<template>
  <div class="container-fluid">
    <div class="card mb-2 shadow-sm"  v-for="postingan in postingans" :idpost="postingan.postingan.postingan_id" id="postingan-container">
      <div class="card-body p-0" :user="postingan.postingan.user_id">
        <li class="media align-items-center p-2">
          <img
          style="cursor: pointer;"
           v-on:click="profile"
           :src="postingan.teman.photo_profile"
            class="mr-3 photo-profile"
            :alt="postingan.teman.nama_teman"
          />
          <div class="media-body">
            <h5 class="text-center">{{postingan.teman.nama_teman}}</h5>
          </div>
          <div><p>{{convertWaktu(postingan.postingan.waktu_diunggah)}}</p></div>
        </li>
      </div>
      <img
      style="cursor: pointer"
        :src="postingan.postingan.url_postingan"
        class="card-img-bottom"
        :alt="postingan.postingan.caption"
        v-on:click="detail"
      />
      <div class="card-body border border-primary border-top-0">
        <div class="container-fluid">
          <div class="row">
            <like-komponent id="likekomponent" :mr-post="postingan.postingan.user_id" :post-id="postingan.postingan.postingan_id" :user-id="user"></like-komponent>
            <div class="col-sm">
              <i class="fa fa-comments-o fa-2x" aria-hidden="true" @click="coment" style="cursor: pointer;"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="container-fluid">
          <span class="text"
            >{{ postingan.postingan.caption }}</span
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data(){
    return {
      postingans: [],
      datatemans: {}
    }
  },
  mounted() {
    this.getPostingan();
  },
  methods: {
    getPostingan(){
      let postinganteman = [];
      axios.get('/api/' + this.user.id + '/listteman').then(response => {
        this.datatemans = response.data.data;
          for (let index = 0; index < this.datatemans.length; index++) {
            const element = this.datatemans[index];
            element.postingans.forEach(postingan => {
              this.postingans.unshift({
                "postingan": postingan, 
                "teman": element.teman});
            }); 
          }
      }).catch(error => {

      });
    },
    convertWaktu(timestamp){
      // time() dari php mengembalikan jumlah detik dari waktu epoch, fungsi new Date hanya menerima argument milisecond. maka dari itu kita convert second ke mili second dengan cara di kali 1000
      return new Date(timestamp * 1000).toDateString();
    },
    coment(event){
      const idpost = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.getAttribute('idpost');
      window.location.href = '/postingan/' + idpost;
    },
    detail(event){
      window.location.href = '/postingan/' + event.target.parentElement.getAttribute('idpost');
    },
    profile(event){
      window.location.href = '/user/' + event.target.parentElement.parentElement.getAttribute('user');
    }
  }
};
</script>