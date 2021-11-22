<template>
    <div class="container">
        <div v-if="isLoggedIn">
            <router-link to="/alumnos" style="padding:1rem">Alumnos</router-link>
            <router-link to="/profesores" style="padding:1rem">Profesores</router-link>
            <router-link to="/grados" style="padding:1rem">Grados</router-link>
            <router-link to="/alumnosgrados" style="padding:1rem">Alumnos Grados</router-link>
        </div>
        <div v-else>
            <router-link to="/" style="padding:1rem">Home</router-link>
            <router-link to="/login" style="padding:1rem">Login</router-link>
            <router-link to="/register" style="padding:1rem">Registrar
            </router-link>
        </div>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>