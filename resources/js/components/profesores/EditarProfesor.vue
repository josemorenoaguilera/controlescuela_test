<template>
    <div>
        <h4 class="text-center">Editar Profesor</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateProfesor">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="profesor.nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" v-model="profesor.apellidos">
                    </div>
                    <div class="form-group">
                        <label>Genero</label><br>
                        <input type="radio" id="masculino" value="masculino" name="sexo" v-model="profesor.genero" >
                        <label for="masculino">Masculino</label>
                        <input type="radio" id="femenino" value="femenino" name="sexo" v-model="profesor.genero">
                        <label for="femenino">Femenino</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            profesor: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/profesor/get/${this.$route.params.id}`)
                .then(response => {
                    this.profesor = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateProfesor() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/profesor/update`, this.profesor)
                    .then(response => {
                        this.$router.push({name: 'profesores'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>