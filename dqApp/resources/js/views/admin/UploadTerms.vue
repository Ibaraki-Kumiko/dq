<template>
    <div>
        <input type="file" ref="fileInput" accept=".json">
        <button @click="uploadFile">Upload File</button>
    </div>
</template>

<script>
export default {
    name: "UploadTerms",
    methods: {
        uploadFile() {
            const file = this.$refs.fileInput.files[0];
            const formData = new FormData();
            formData.append('file', file);
            axios.post('/dictionary', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
}
</script>

<style scoped>

</style>
