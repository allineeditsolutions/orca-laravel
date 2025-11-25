import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import PrimeVue from 'primevue/config';
import Aura from '@primevue/themes/aura';
import App from './App.vue';
import Home from './pages/Home.vue';
import Advertising from './pages/Advertising.vue';
import NewbizOrganic from './pages/NewbizOrganic.vue';
import Newbiz from './pages/Newbiz.vue';
import ApplicationForm from './pages/ApplicationForm.vue';
import ScheduleAVisit from './pages/ScheduleAVisit.vue';

// PrimeIcons
import 'primeicons/primeicons.css';

const routes = [
    { path: '/', component: Home },
    { path: '/advertising', component: Advertising },
    { path: '/newbiz-organic', component: NewbizOrganic },
    { path: '/newbiz', component: Newbiz },
    { path: '/application-form', component: ApplicationForm },
    { path: '/schedule-a-visit', component: ScheduleAVisit },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

document.addEventListener('DOMContentLoaded', () => {
    const app = createApp(App);
    app.use(router);
    app.use(PrimeVue, {
        theme: {
            preset: Aura,
            options: {
                darkModeSelector: false,
                cssLayer: false
            }
        }
    });
    app.mount('#app');
});
