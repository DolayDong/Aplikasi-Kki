<template>
  <div class="container-fluid">
    <div class="card mb-2 shadow-sm" id="postingan-container">
      <div class="card-body p-0">
        <li class="media align-items-center p-2">
          <div class="media-body">
            <h5 class="text-center">{{ user.name }}</h5>
          </div>
        </li>
      </div>
      <img
        style="cursor: pointer; max-height: 400px"
        :src="postingan.url_image"
        class="card-img-bottom"
        alt="postingan.caption"
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
          </div>
        </div>
      </div>
      <div
        class="card-body border border-left-0 border-right-0 border-top-0 border-primary"
      >
        <div class="container-fluid">
          <span class="text">{{ postingan.caption }}</span>
        </div>
      </div>
      <h4 class="text text-bold">Komentar</h4>
      <div class="container-fluid">
        <div class="media" v-for="comment in comments">
          <img
            :src="comment.user.url_image"
            class="mr-3 photo-profile"
            :alt="comment.user.name"
          />
          <div class="media-body">
            <h5 class="my-0 py-1 text text-primary text-bold">
              {{ comment.user.name }}
            </h5>
            <i class="text text-bold p-0 m-0"> {{ comment.body }}</i>
          </div>
        </div>

      </div>
      <div class="container-fluid">
        <form id="formcomment">
          <div class="mb-3">
            <label for="komentari">Komentari</label>
            <textarea
            v-on:keyup="validasi()"
              class="form-control"
              id="komentari"
              placeholder="tulis komentar disini..."
              v-model="komentar"
            ></textarea>
            <div class="invalid-feedback">
              Please enter a message in the textarea.
            </div>
            <button @click.prevent="komentari" class="btn btn-primary mt-2" :disabled="cek">
              Kirim Komentar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user", "postingan", "gw"],
  data() {
    return {
      comments: {},
      komentar: undefined,
      cek: true
    };
  },
  mounted() {
    this.getComments();
  },
  methods: {
    getComments() {
      axios
        .get("/api/postingan/" + this.postingan.id + "/comments")
        .then((response) => {
          this.comments = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    komentari() {
      axios
        .post("/api/postingans/" + this.postingan.id + "/comment", {
          api_token: this.gw.api_token,
          body: this.komentar,
        })
        .then((response) => {
            document.querySelector('#formcomment').reset();
            this.komentar = undefined
            this.comments.unshift(response.data);
          console.log(response);
        })
        .catch((error) => {
          console.log("error post: " + error);
        });
    },
    validasi(){
        if(this.komentar !== undefined) {
            if(this.komentar.length !== 0){
                this.cek = false;
            } else {
                this.cek = true;
            }
            } 
    }
  },
};
</script>