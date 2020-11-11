<template>
    <div
        class="modal fade"
        id="modalCall"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ teman.name }}
                    </h5>
                </div>
                <div class="modal-body">
                    <img
                        :src="teman.url_image"
                        class="img-fluid mx-0 my-0 border border-danger"
                        style="width: 100%; max-height: 400px"
                        alt="Responsive image"
                    />
                </div>
                <div class="modal-footer">
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <button
                        type="button"
                        v-on:click="$parent.endCall()"
                        class="btn btn-danger"
                        data-dismiss="modal">
                        <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                    </button>
                    <audio id="localaudio" autoplay></audio>
                    <audio autoplay id="temanAudio"></audio>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["user", "teman"],
    data() {
        return {
           
        };
    },
    mounted() {
        // $("#modalCall").on("shown.bs.modal", e => {
            
        // });
    },
    methods: {
        
    }
};
</script>
