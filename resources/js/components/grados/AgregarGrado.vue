<template>
    <div>
        <h4 class="text-center">Agregar Grado</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addGrados">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="grado.nombre">
                    </div>
                    <div class="form-group">
                        <label>Profesor</label><br>
                        <div v-for="profesor in profesores" :key="profesor.id">
                            <input type="radio" :id="profesor.id" :value="profesor.id" name="rb1"
                            v-model="grado.profesorId" >
                            <label style="padding:0.5rem" :for="profesor.id"> 
                                {{profesor.nombre + " " + profesor.apellidos}}
                            </label><br>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar grado</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            grado: {
                nombre:'',
                profesorId:''
            },
            profesores: []
        }
    },
    created() {
        this.getProfesores();
    },
    methods: {
        getProfesores() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/profesor')
                    .then(response => {
                        this.profesores = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        addGrados() {
            if(this.grado.nombre==''||this.grado.profesorId=='')
            {
                alert('Rellena todos los campos.')
                return null;
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/grado/add', this.grado)
                    .then(response => {
                        this.$router.push({name: 'grados'})
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