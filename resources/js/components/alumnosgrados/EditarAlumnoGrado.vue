<template>
    <div>
        <h4 class="text-center">Editar Alumno Grado</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addGrados">
                    <div class="form-group">
                        <label style="font-weight: bolder">Grado</label><br>
                        <div v-for="grad in grados" :key="grad.id">
                            <input type="radio" :id="grad.id+''+grad.nombre" :value="grad.id" name="rb1"
                            v-model="grado.gradoId" >
                            <label style="padding:0.5rem" :for="grad.id+''+grad.nombre"> 
                                {{grad.gradonombre}}
                            </label><br>
                        </div>

                        <label style="font-weight: bolder">Alumno</label><br>
                        <div v-for="alumno in alumnos" :key="alumno.id">
                            <input type="radio" :id="alumno.id+alumno.nombre" :value="alumno.id" name="rb2"
                            v-model="grado.alumnoId" >
                            <label style="padding:0.5rem" :for="alumno.id+alumno.nombre"> 
                                {{alumno.nombre + " " + alumno.apellidos}}
                            </label><br>
                        </div>
                        
                        <div class="form-group">
                            <label>Seccion</label>
                            <input type="text" class="form-control" v-model="grado.seccion">
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar grado al alumno</button>
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
                gradoId:'',
                alumnoId:'',
                seccion: ''
            },
            alumnos: [],
            grados: []
        }
    },
    created() {
        this.getGrados();
        this.getAlumnos();
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/alumnogrado/get/${this.$route.params.id}`)
                .then(response => {
                    console.log(response.data)
                    this.grado = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        getGrados() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/grado')
                    .then(response => {
                        this.grados = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        getAlumnos() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/alumno')
                    .then(response => {
                        this.alumnos = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        addGrados() {
            if(this.grado.gradoId==''||this.grado.alumnoId==''||this.grado.seccion=='')
            {
                alert('Rellena todos los campos.')
                return null;
            }
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/alumnogrado/add', this.grado)
                    .then(response => {
                        this.$router.push({name: 'alumnosgrados'})
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