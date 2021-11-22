<template>
    <div>
        <h4 class="text-center">Alumnos</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
                <th>Nacimiento</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="alumno in alumnos" :key="alumno.id">
                <td>{{ alumno.id }}</td>
                <td>{{ alumno.nombre }}</td>
                <td>{{ alumno.apellidos }}</td>
                <td>{{ alumno.genero }}</td>
                <td>{{ alumno.fechanacimiento }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editaralumno', params: { id: alumno.id }}" class="btn btn-primary">Editar
                        </router-link>
                        <button class="btn btn-danger" @click="deleteAlumno(alumno.id)">Eliminar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/alumnos/add')">Agregar alumno</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            alumnos: []
        }
    },
    created() {
        this.getAlumnos();
    },
    methods: {
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
        deleteAlumno(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/alumno/delete/${id}`)
                    .then(response => {
                        this.getAlumnos();
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