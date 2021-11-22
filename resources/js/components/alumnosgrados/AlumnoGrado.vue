<template>
    <div>
        <h4 class="text-center">Alumnos Grados</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Profesor</th>
                <th>Grado</th>
                <th>Seccion</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="grado in alumnosgrados" :key="grado.id">
                <td>{{ grado.id }}</td>
                <td>{{ grado.nombrealumno +" "+grado.apellidosalumno }}</td>
                <td>{{ grado.nombreprofe +" "+grado.apellidosprofe }}</td>
                <td>{{ grado.nombregrado }}</td>
                <td>{{ grado.seccion }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editaralumnogrado', params: { id: grado.id }}" class="btn btn-primary">Editar
                        </router-link>
                        <button class="btn btn-danger" @click="deleteGrado(grado.id)">Eliminar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/alumnosgrados/add')">Agregar grado a alumno</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            alumnosgrados: []
        }
    },
    created() {
        this.getGrados();
    },
    methods: {
        getGrados() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get('/api/alumnogrado')
                    .then(response => {
                        console.log(response)
                        this.alumnosgrados = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
        deleteGrado(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/alumnogrado/delete/${id}`)
                    .then(response => {
                        this.getGrados();
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