<template>
    <div>
        <h4 class="text-center">Profesores</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Genero</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="profesor in profesores" :key="profesor.id">
                <td>{{ profesor.id }}</td>
                <td>{{ profesor.nombre }}</td>
                <td>{{ profesor.apellidos }}</td>
                <td>{{ profesor.genero }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editarprofesor', params: { id: profesor.id }}" class="btn btn-primary">Editar
                        </router-link>
                        <button class="btn btn-danger" @click="deleteProfesor(profesor.id)">Eliminar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/profesor/add')">Agregar profesor</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
        deleteProfesor(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/profesor/delete/${id}`)
                    .then(response => {
                        this.getProfesores();
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