<template>
    <div>
        <h4 class="text-center">Editar Alumno</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateAlumno">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="alumno.nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" v-model="alumno.apellidos">
                    </div>
                    <div class="form-group">
                        <label>Genero</label><br>
                        <input type="radio" id="masculino" value="masculino" name="sexo" v-model="alumno.genero" checked>
                        <label for="masculino">Masculino</label>
                        <input type="radio" id="femenino" value="femenino" name="sexo" v-model="alumno.genero">
                        <label for="femenino">Femenino</label>
                    </div>
                    <div class="form-group">
                        <label>Nacimiento</label>
                        <input type="date" class="form-control" v-model="alumno.fechanacimiento">
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
            alumno: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/alumno/getAlum/${this.$route.params.id}`)
                .then(response => {
                    this.alumno = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateAlumno() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/alumno/update`, this.alumno)
                    .then(response => {
                        this.$router.push({name: 'alumnos'});
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