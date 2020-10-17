<template>
  <div
    class="modal fade"
    id="staticBackdrop"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Upload Photo</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0 m-0">
          <div class="container-fluid h-25 p-0 m-0">
            <img
              :src="gambarpilihan"
              class="img-fluid w-100 p-0 m-0"
              alt="Responsive image"
              :style="{ maxHeight: '450px', display: displayImage }"
            />
          </div>
        </div>
        <div class="modal-footer">
          <div class="container-fluid p-0 m-0">
            <form enctype="multipart/form-data" action="/posting" method="post" id="formdaftar">
              <div class="form-row m-0 p-0">
                <slot></slot>
                <div class="col-md-10">
                  <input
                  autocomplete="off"
                    v-on:keyup="cek"
                    v-model="caption"
                    name="caption"
                    type="textarea"
                    class="form-control"
                    placeholder="Caption..."
                    :style="{ display: displayCaption }"
                  />
                </div>
                <div class="col-md-1">
                  <label for="add-photo" :style="{display: displayLabel}">
                    <svg
                      width="2.5em"
                      height="2.5em"
                      viewBox="0 0 16 16"
                      class="bi bi-file-earmark-image"
                      fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M12 16a2 2 0 0 0 2-2V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8zM3 2a1 1 0 0 1 1-1h5.5v2A1.5 1.5 0 0 0 11 4.5h2V10l-2.083-2.083a.5.5 0 0 0-.76.063L8 11 5.835 9.7a.5.5 0 0 0-.611.076L3 12V2z"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"
                      />
                    </svg>
                  </label>
                  <input
                    accept="image/*"
                    name="gambar-post"
                    type="file"
                    class="form-control"
                    id="add-photo"
                    style="visibility: hidden"
                    v-on:change="previewgambar"
                  />
                </div>
                <div class="col-md-1">
                  <button
                    class="btn btn-primary"
                    style="width: 100%"
                    :style="{ display: displayButton }"
                  >
                    <svg
                      width="1em"
                      height="1em"
                      viewBox="0 0 16 16"
                      class="bi bi-cursor"
                      fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"
                      />
                    </svg>
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
  data() {
    return {
      displayImage: "none",
      displayButton: "none",
      displayCaption: "none",
      gambarpilihan: undefined,
      caption: "",
      image: '',
      displayLabel: 'block',
    };
  },
  mounted() {
    $("#staticBackdrop").on("hidden.bs.modal", (e) => {
      this.displayImage = "none";
      this.displayButton = "none";
      this.displayCaption = "none";
      this.gambarpilihan = undefined;
      this.displayLabel = "block";
      document.querySelector('#formdaftar').reset();
    });
  },
  methods: {
    previewgambar(e) {
      const file = e.target.files[0];

      if (file.type.split("/")[0] !== "image") {
        return alert("harap memilih file photo");
      } else {
        if (/\.(gif|jpe?g|png)$/i.test(file.name)) {
          const readerFile = new FileReader();
          readerFile.readAsDataURL(file);
          readerFile.onload = (e) => {
            this.gambarpilihan = e.target.result;
            this.displayImage = "block";
            this.displayCaption = "block";
            this.image = file;
            this.displayLabel = 'none';
          };

          readerFile.abort;
        } else {
          return alert("harap memilih file gambar saja");
        }
      }
    },
    cek() {
      if (this.caption.trim !== "" && this.caption.length !== 0) {
        this.displayButton = "block";
      } else {
        this.displayButton = "none";
      }
    }
  },
};
</script>

