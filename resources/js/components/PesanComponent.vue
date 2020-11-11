<template>
    <div class="container-content__ shadow shadow-sm">
        <div class="header-chat">
            <img :src="teman.url_image" alt="" class="photo-profile" />
            <h4 class="nama-user">{{ teman.name }}</h4>
            <div class="fitur">
                <a
                    href="#"
                    v-on:click.prevent="panggilKe(teman.id)"
                    data-toggle="modal"
                    data-target="#modalCall"
                >
                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-video-camera fa-lg" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="content">
            <div
                class="pesan"
                v-for="pesan in pesans"
                :key="pesan.id"
            >
                <div :class="`${pesan.teman_id === teman.id ? 'gw' : ' dari'}`" v-if="pesan.user_id === user.id || pesan.teman_id === user.id">
                    <img
                        :src="pesan.url_file"
                        alt="pesan.body"
                        class="pesanimage"
                        v-if="pesan.url_file"
                    />
                    <p class="isi">{{ pesan.body }}</p>
                    <small class="waktu-pesan">{{
                        convertWaktu(pesan.dikirim)
                    }}</small>
                </div>
            </div>
        </div>
        <div class="footer__">
            <div class="container-pesan">
                <form @submit.prevent="kirimpesantext" id="pesantextform">
                    <input
                        @keyup="cek"
                        v-model="pesantext"
                        type="text"
                        placeholder="tulis pesan disini..."
                        autocomplete="off"
                    />
                    <label class="contpainer-choose">
                        <input
                            type="file"
                            id="test"
                            placeholder="tulis pesan disini..."
                            v-on:change="previewGambar"
                        />
                        <i
                            class="fa fa-file-image-o fa-2x"
                            aria-hidden="true"
                        ></i>
                    </label>
                    <button :disabled="disabled">
                        <i
                            class="fa fa-paper-plane-o fa-lg"
                            aria-hidden="true"
                        ></i>
                    </button>
                </form>
            </div>
        </div>
        <div
            id="modalpreview"
            data-toggle="modal"
            data-target="#previewPesan"
        ></div>
        <modal-preview-gambar-pesan :teman="teman" :user="user">
            <slot></slot>
        </modal-preview-gambar-pesan>
        <call-component :user="user" :teman="teman">
        </call-component>
    </div>
</template>

<script>
import CallComponent from "./CallComponent";
import Peer from "simple-peer";
import Pusher from "pusher-js";

export default {
    data() {
        return {
            pesans: [],
            pesantext: "",
            disabled: true,

            // batas
            tersedia: false,
            temanId: null,
            audioTeman: {},
            channel: {},
            pusher: undefined,
            peers: {},
            peer: {},
            stream: null
        };
    },
    props: ["user", "teman"],
    mounted() {
        window.APP_KEY = "4c08e21f32b2ed3689f9";
        const localaudio = document.querySelector("#localaudio");
        const temanAudio = document.querySelector("#temanAudio");

        this.getPesan();
        this.listenEvent();
        this.pusherSetup();

        this.panggilKe = this.panggilKe.bind(this);
        this.pusherSetup = this.pusherSetup.bind(this);
        this.startPeer = this.startPeer.bind(this);
    },

    methods: {
        previewGambar(e) {
            const file = e.target.files[0];

            if (file.type.split("/")[0] !== "image") {
                return alert("harap memilih file photo");
            } else {
                if (/\.(gif|jpe?g|png)$/i.test(file.name)) {
                    const readerFile = new FileReader();
                    readerFile.readAsDataURL(file);
                    readerFile.onload = e => {
                        $("#previewPesan").modal("show");
                        $("#previewPesan").on("shown.bs.modal", function(ev) {
                            const preview = document.querySelector("#preview");
                            const test = document.querySelector("#test");
                            preview.setAttribute("src", e.target.result);
                        });
                    };

                    readerFile.abort;
                } else {
                    return alert("harap memilih file gambar saja");
                }
            }
        },
        getPesan() {
            axios
                .get(`/api/pesans/${this.teman.id}`, {
                    params: { api_token: this.user.api_token }
                })
                .then(response => {
                    this.pesans = response.data;
                })
                .catch(error => {
                    console.log("Error : " + error);
                });
        },
        convertWaktu(timestamp) {
            return new Date(timestamp * 1000).toDateString();
        },
        kirimpesantext() {
            axios
                .post(`/api/pesan/${this.teman.id}/kirimpesan`, {
                    api_token: this.user.api_token,
                    deskripsi: this.pesantext
                })
                .then(response => {
                    this.pesans.unshift(response.data);
                    this.disabled = true;
                    this.pesantext = "";
                    document.querySelector("#pesantextform").reset();
                })
                .catch(error => {
                    console.log("error : " + error);
                });
        },
        cek() {
            if (this.pesantext.trim() !== "") {
                this.disabled = false;
            }
        },
        listenEvent() {
            Echo.private(`pesan.${this.user.id}`).listen(
                "PesanBaru",
                response => {
                    this.pesans.unshift(response.pesan);
                }
            );
        },
        call() {
            // const audio = document.createElement("audio");
            console.log("call method");

            this.getPermission().then(stream => {
                this.tersedia = true;
                this.stream = stream;
                try {
                    localaudio.srcObject = stream;
                    // this.audioTeman.srcObject = stream;
                } catch (e) {
                    localaudio.src = URL.createObjectURL(stream);
                    // this.audioTeman.src = URL.createObjectURL(stream);
                }
                // this.audioTeman.play();
                // this.localaudio.play();
            });
        },
        getPermission() {
            console.log("get permissions method");
            return new Promise((resolve, reject) => {
                navigator.mediaDevices
                    .getUserMedia({
                        audio: true,
                        video: false
                    })
                    .then(stream => {
                        console.log("stream " + stream.getAudioTracks());
                        resolve(stream);
                    })
                    .catch(e => {
                        throw new Error("error getPermision() :" + e);
                    });
            });
        },
        nadaDering(audio) {
            audio.setAttribute("src", "/storage/nadaDering.mp3");
            audio.setAttribute("loop", true);
            audio.play();

            setTimeout((e) => {
                audio.pause();
                audio.remove();
            }, 10000);
        },
        pusherSetup() {
            console.log("pusherSetup method");
            this.pusher = new Pusher(APP_KEY, {
                authEndpoint: "/pusher/auth",
                cluster: "ap4",
                auth: {
                    params: this.user.id,
                    headers: {
                        "X-CSRF-Token": window.csrfToken
                    }
                }
            });

            this.channel = this.pusher.subscribe(`presence-audio-channel`);

            this.channel.bind(`client-signal-${this.user.id}`, (signal) => {
                let peer = this.peers[signal.userId];

                if (peer === undefined) {
                    this.temanId = signal.userId;
                    peer = this.startPeer(this.temanId, false);
                    const terima = confirm(signal.userId + " memanggil");
                    // if (terima) {
                    //     this.call();
                    // } 
                }
            });
        },
        startPeer(userId, initiator = true) {
            console.log("startPeer");
            const peer = new Peer({
                initiator,
                stream: this.stream,
                trickle: false
            });
            this.peer = peer;
            peer.on("signal", (data) => {
                console.log("peer on signal");
                this.channel.trigger(`client-signal-${userId}`, {
                    type: "signal",
                    userId: this.user.id,
                    data: data
                });
            });

            peer.on("stream", (stream) => {
                console.log("peer on stream");
                try {
                    // this.audioTeman.srcObject = stream;
                    temanAudio.srcObject = stream;
                } catch (e) {
                    // this.audioTeman.src = URL.createObjectURL(stream);
                    temanAudio.src = URL.createObjectURL(stream);
                }
                console.log("on stream startPeer" + this.audioTeman);

                // this.audioTeman.play();
            });

            peer.on("close", (userId) => {
                console.log("peer on close");
                let peer = this.peers[userId];

                if (peer !== undefined) {
                    peer.destroy();
                    alert("peer destroyed");
                }
                this.peers[userId] = null;
            });

            peer.on("destroy", (e) => {
                console.log("on destroy peer" + e);
            })
        },
        panggilKe(userId) {
            this.peers[userId] = this.startPeer(userId);
            const audio = document.createElement("audio");
            this.nadaDering(audio);
        },
        endCall(){
            this.peer.destroy();
        }
    },
    components: { CallComponent }
};
</script>
