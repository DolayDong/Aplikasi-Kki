<template>
    <div class="container-fluid mt-1">
        <div
            class="col position-fixed justify-content-end"
            style="max-width: 25%; right: 2%"
        >
          <slot></slot>
        </div>

        <div
            class="col position-fixed"
            style="max-width: 25%; bottom: 4%; right: 2%"
            data-toggle="modal"
            data-target="#staticBackdrop"
        >
            <div class="container-fluid list-group-item-action">
                <span
                    class="badge badge-pill badge-primary"
                    style="width: 100%"
                >
                    <svg
                        width="3em"
                        height="3em"
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
                    Upload Foto
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
};
</script>
