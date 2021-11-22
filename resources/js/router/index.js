import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';

import Alumnos from '../components/alumnos/Alumnos';
import AgregarAlumno from '../components/alumnos/AgregarAlumno';
import EditarAlumno from '../components/alumnos/EditarAlumno';

import Profesores from '../components/profesores/Profesores';
import AgregarProfesor from '../components/profesores/AgregarProfesor';
import EditarProfesor from '../components/profesores/EditarProfesor';

import Grados from '../components/grados/Grados';
import AgregarGrado from '../components/grados/AgregarGrado';
import EditarGrado from '../components/grados/EditarGrado';

import AlumnoGrado from '../components/alumnosgrados/AlumnoGrado';
import AgregarAlumnoGrado from '../components/alumnosgrados/AgregarAlumnoGrado';
import EditarAlumnoGrado from '../components/alumnosgrados/EditarAlumnoGrado';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    //links para alumnos
    {
        name: 'alumnos',
        path: '/alumnos',
        component: Alumnos
    },
    {
        name: 'agregaralumno',
        path: '/alumnos/add',
        component: AgregarAlumno
    },
    {
        name: 'editaralumno',
        path: '/alumnos/edit/:id',
        component: EditarAlumno
    },
    //links para Profesores
    {
        name: 'profesores',
        path: '/profesores',
        component: Profesores
    },
    {
        name: 'agregarprofesor',
        path: '/profesor/add',
        component: AgregarProfesor
    },
    {
        name: 'editarprofesor',
        path: '/profesor/edit/:id',
        component: EditarProfesor
    },
    //links para Grados
    {
        name: 'grados',
        path: '/grados',
        component: Grados
    },
    {
        name: 'agregargrado',
        path: '/grado/add',
        component: AgregarGrado
    },
    {
        name: 'editargrado',
        path: '/grado/edit/:id',
        component: EditarGrado
    },
    //links para alumnosgrados
    {
        name: 'alumnosgrados',
        path: '/alumnosgrados',
        component: AlumnoGrado
    },
    {
        name: 'agregaralumnogrado',
        path: '/alumnosgrados/add',
        component: AgregarAlumnoGrado
    },
    {
        name: 'editaralumnogrado',
        path: '/alumnosgrados/edit/:id',
        component: EditarAlumnoGrado
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
