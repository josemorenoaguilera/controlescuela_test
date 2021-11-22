<template>
    <div>
        <h4 class="text-center">Agregar Alumno</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addAlumno">
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
                        <input type="radio" id="masculino" value="masculino" name="sexo" v-model="alumno.genero" >
                        <label for="masculino">Masculino</label>
                        <input type="radio" id="femenino" value="femenino" name="sexo" v-model="alumno.genero">
                        <label for="femenino">Femenino</label>
                    </div>
                    <div class="form-group">
                        <label>Nacimiento</label>
                        <input type="date" class="form-control" v-model="alumno.fechanacimiento">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Alumno</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            alumno: {
                nombre:'',
                apellidos:'',
                genero:'masculino',
                fechanacimiento:Date.now()
            }
        }
    },
    methods: {
        addAlumno() {
            if(this.alumno.nombre==''||this.alumno.apellidos=='')
            {
                alert('Rellena todos los campos.')
                return null;
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/alumno/add', this.alumno)
                    .then(response => {
                        this.$router.push({name: 'alumnos'})
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