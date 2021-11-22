<template>
    <div>
        <h4 class="text-center">Agregar Profesor</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addProfesor">
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
                    <button type="submit" class="btn btn-primary">Agregar Profesor</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            profesor: {
                nombre:'',
                apellidos:'',
                genero:'masculino'
            }
        }
    },
    methods: {
        addProfesor() {
            if(this.profesor.nombre==''||this.profesor.apellidos=='')
            {
                alert('Rellena todos los campos.')
                return null;
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/profesor/add', this.profesor)
                    .then(response => {
                        this.$router.push({name: 'profesores'})
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