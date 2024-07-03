<script setup>
import App from "../Layouts/App.vue";
import { Inertia } from '@inertiajs/inertia';
defineProps({ users: Array });

const sortByBirthdate = () => {
    Inertia.get('/', { sort: 'birthdate' });
};

const showBirthdaysThisWeek = () => {
    Inertia.get('/', { filter: 'this_week_birthdays' });
};

const defaultList = () => {
    Inertia.get('/');
};

</script>

<template>
    <App>
        <div class="page-header-container">
            <h2>
                User list
            </h2>
            <div class="header-actions">
            <span @click="defaultList"> Default </span>
            <span @click="sortByBirthdate"> Sort </span>
            <span @click="showBirthdaysThisWeek"> Show this week birthday's </span>
            </div>
        </div>
        <div class="page-content-container">
            <div class="user-list">
                <ul>
                    <li class="header-item">
                        <span>
                            Name
                        </span>
                        <span>
                            Birthdate
                        </span>
                        <span>
                            Latest purchase date
                        </span>
                    </li>
                    <li class="user-item" v-for="user in users" :key="user.id">
                        <span>
                            {{ user.name }}
                        </span>
                        <span>
                            {{ user.birth_date }}
                        </span>
                        <span>
                            {{ user.latest_purchase_date }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </App>
</template>

<style scoped>
.page-header-container {
    width: 100%;
    font-weight: bold;
    text-align: center;
    font-size: 2.5rem;

    .header-actions {
        display: flex;
        justify-content: center;
        gap: 40px;

        span {
            font-weight: 400;
            font-size: 1rem;
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }
    }
}

.page-content-container {
    width: 100%;
    display: flex;
    justify-content: center;

    .user-item, .header-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem;
        border: 1px solid black;
        margin: 1rem;
    }

    .header-item {
        font-weight: 600;
    }
}
</style>
