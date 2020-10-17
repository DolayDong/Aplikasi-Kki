<template>
  <div class="container-fluid">
    <div class="card mb-2 shadow-sm" v-for="postingan in postingans" :idpost="postingan.postingan_id" id="postingan-container">
      <div class="card-body p-0" :user="postingan.user.nama">
        <li class="media align-items-center p-2">
          <img
          style="cursor: pointer;"
           v-on:click="profile"
           :src="postingan.user.photo_profile"
            class="mr-3 photo-profile"
            :alt="postingan.user.nama"
          />
          <div class="media-body">
            <h5 class="text-center">{{postingan.user.nama}}</h5>
          </div>
          <div><p>{{convertWaktu(postingan.waktu_diunggah)}}</p></div>
        </li>
      </div>
      <img
      style="cursor: pointer"
        :src="postingan.url_postingan"
        class="card-img-bottom"
        :alt="postingan.caption"
        v-on:click="detail"
      />
      <div class="card-body border border-primary border-top-0">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm">
              <svg
                width="1.5em"
                height="1.5em"
                viewBox="0 0 16 16"
                class="bi bi-suit-heart list-group-item-action"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 6.236l.894-1.789c.222-.443.607-1.08 1.152-1.595C10.582 2.345 11.224 2 12 2c1.676 0 3 1.326 3 2.92 0 1.211-.554 2.066-1.868 3.37-.337.334-.721.695-1.146 1.093C10.878 10.423 9.5 11.717 8 13.447c-1.5-1.73-2.878-3.024-3.986-4.064-.425-.398-.81-.76-1.146-1.093C1.554 6.986 1 6.131 1 4.92 1 3.326 2.324 2 4 2c.776 0 1.418.345 1.954.852.545.515.93 1.152 1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"
                />
              </svg>
            </div>
            <div class="col-sm">
              <svg
                v-on:click="coment"
                width="1.5em"
                height="1.5em"
                viewBox="0 0 16 16"
                class="bi bi-chat-left-text list-group-item-action"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"
                />
                <path
                  fill-rule="evenodd"
                  d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="container-fluid">
          <span class="text"
            >{{ postingan.caption }}</span
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      postingans: {},
    }
  },
  mounted() {
    this.getPostingan();
  },
  methods: {
    getPostingan(){
      axios.get('/api/postingans').then(response => {
        this.postingans = response.data.data;
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