<template>
    <StreamBarcodeReader
        @decode="onDecode"
        @loaded="onLoaded"
    ></StreamBarcodeReader>
</template>

<script>
import { StreamBarcodeReader } from "vue-barcode-reader";

export default {
    methods: {
        onDecode(result) {
            console.log(result);
        },
        onLoaded(result) {
            console.log(result);
        }
    },
    components: {
        StreamBarcodeReader
    }
};
</script>

<style></style>
