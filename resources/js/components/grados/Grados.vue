<template>
    <div>
        <h4 class="text-center">Grados</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Profesor</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="grado in grados" :key="grado.id">
                <td>{{ grado.id }}</td>
                <td>{{ grado.gradonombre }}</td>
                <td>{{ grado.profenombre +" "+grado.apellidos }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editargrado', params: { id: grado.id }}" class="btn btn-primary">Editar
                        </router-link>
                        <button class="btn btn-danger" @click="deleteGrado(grado.id)">Eliminar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/grado/add')">Agregar grado</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            grados: []
        }
    },
    created() {
        this.getGrados();
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
        deleteGrado(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/grado/delete/${id}`)
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