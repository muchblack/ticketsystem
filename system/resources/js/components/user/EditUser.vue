<template>
    <div class="container">
        <div>
            {{ page_title }}
        </div>
        <div class="row">
            <div class="col-md-8">
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <label>使用者帳號</label>
                        <input type="text" :disabled=" actions == 'edit' " class="form-control" :class="{'is-invalid' : !! error.user_account}" v-model="Users.user_account">
                        <div :class="{'invalid-feedback' : !! error.user_account }" v-if=" !! error.user_account">{{ error.user_account}}</div>
                    </div>
                    <div class="form-group">
                        <label>使用者密碼</label>
                        <input type="text" class="form-control" :class="{'is-invalid' : !! error.user_pwd}" v-model="Users.user_pwd">
                    </div>
                    <div class="form-group">
                        <label>使用者密碼確認</label>
                        <input type="text" class="form-control" :class="{'is-invalid' : !! error.user_pwd}" v-model="Users.check_user_pwd">
                        <p :class="{'invalid-feedback' : !! error.user_pwd }" v-if=" !! error.user_pwd">{{ error.user_pwd}}</p>
                    </div>
                    <div class="form-group">
                        <label> 請選擇使用者權限 </label>
                        <select class="form-select" v-model="Users.user_role" :class="{'is-invalid' : !! error.user_role}" >
                            <option v-for="userRole in user_roles" :value="userRole.id">
                                {{ userRole.user_role_name}}
                            </option>
                        </select>
                        <p :class="{'invalid-feedback' : !! error.user_role }" v-if=" !! error.user_role">{{ error.user_role}}</p>
                    </div>
                    <div class="form-group">
                        <label>使用者Email</label>
                        <input type="email" class="form-control" :class="{'is-invalid' : !! error.user_email}" v-model="Users.user_email">
                        <p :class="{'invalid-feedback' : !! error.user_email }" v-if=" !! error.user_email">{{ error.user_email}}</p>
                    </div>
                    <button class="btn btn-primary" type="submit">送出</button>
                    <button class="btn btn-secondary" type="button" @click="$router.go(-1);">返回上一頁</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditUser",
    data() {
        return {
            Users: {},
            page_title: '',
            user_roles: [],
            actions: '',
            error: {},
        }
    },
    created() {
        if(this.$route.params.id)
        {
            this.page_title = '使用者編輯頁面';
            this.actions = 'edit';
            this.axios
            .get(`/api/user/${this.$route.params.id}`)
            .then( response => {
                this.Users = response.data;
            })
        }
        else
        {
            this.page_title = '新增使用者';
            this.actions = 'new'
        }

        //取得使用者權限
        this.axios
            .get('/api/userrole')
            .then(response => {
                this.user_roles = response.data;
            })
    },
    methods:{
        onSubmit(){
            this.error = {};
            if(!this.Users.user_account) this.error.user_account = '帳號不能為空';
            if(this.actions =='new')
            {
                if(!this.Users.user_pwd) this.error.user_pwd = '請輸入密碼';
                if(this.Users.user_pwd != this.Users.check_user_pwd ) this.error.user_pwd = '密碼不符';
            }
            if(!this.Users.user_role) this.error.user_role = '請選擇權限';
            if(!this.Users.user_email) this.error.user_email = '請輸入電子郵件';
            if(JSON.stringify(this.error) !== '{}' ) return;

            if(this.actions == 'new')
            {
                //新增使用者
                this.axios
                    .post('/api/user',this.Users)
                    .then(response => {
                        this.$router.push({
                            name: 'Users'
                        })
                    })
                    .catch( err => console.log(err))
                    .finally( () => this.loading = false)
            }
            else
            {
                //編輯使用者
                this.axios
                    .patch(`/api/user/${this.$route.params.id}`,this.Users)
                    .then(response => {
                        this.$router.push({
                            name: 'Users'
                        })
                    })
                    .catch( err => console.log(err))
                    .finally( () => this.loading = false)
            }
        }
    }

}
</script>

<style scoped>

</style>
