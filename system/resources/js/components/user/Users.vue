<template>
    <div class="container">
        <div>
            <button @click="addNewUser()" class="btn btn-primary"> 新增使用者 </button>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            使用者帳號
                        </th>
                        <th>
                            使用者Email
                        </th>
                        <th>
                            使用者權限
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for=" User in Users " :key="User.id">
                        <td>
                            {{ User.id}}
                        </td>
                        <td>
                            {{ User.user_account}}
                        </td>
                        <td>
                            {{ User.user_email}}
                        </td>
                        <td>
                            {{ User.user_role_name}}
                        </td>
                        <td>
                            <button class="btn btn-primary" @click="EditUser(User.id)"> 編輯 </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Users",
    data(){
        return {
            Users: [],
        }
    },
    created() {
        this.axios
            .get('/api/user')
            .then(response => {
                this.Users = response.data;
            });
    },
    methods:
        {
            addNewUser(){
                this.$router.push({
                    name: 'NewUser'
                });
            },
            EditUser(id)
            {
                this.$router.push({
                  name: 'EditUser',
                  params:{
                      id:id
                  }
                })
            }
        }
}
</script>

<style scoped>

</style>
