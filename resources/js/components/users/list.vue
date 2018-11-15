<template>
    <div class="container">

        <table class="table">
            <tr>
                <td>id</td>
                <td>name</td>
                <td>email</td>
            </tr>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                users: [],
                user : {}
            }
        },
        mounted() {
            //load users list
            this.getUsers();

        },

        methods: {
            async getUsers () {
                try {
                    const res = await axios.post(
                            '/graphql', {
                                query: '{ users { id name email} }'
                            });

                    this.users = res.data.data.users ;

                } catch (e) {
                    console.log('err', e)
                }
            }
        }
    }
</script>
