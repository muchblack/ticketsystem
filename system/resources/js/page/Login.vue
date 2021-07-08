<template>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form role="form" @submit.prevent="onSubmit()">
                <div class="form-group">
                    <label>
                        使用者帳號
                    </label>
                    <input type="text" class="form-control" id="user_account" v-model="user_account" :class="{'is-invalid' : !! error.user_account}" />
                    <p :class="{'invalid-feedback' : !! error.user_account }" v-if=" !! error.user_account">{{ error.user_account}}</p>
                </div>
                <div class="form-group">
                    <label>
                        使用者密碼
                    </label>
                    <input type="password" class="form-control" id="user_pwd" v-model="user_pwd" :class="{'is-invalid' : !! error.user_pwd}"/>
                    <p :class="{'invalid-feedback' : !! error.user_pwd }" v-if=" !! error.user_pwd">{{ error.user_pwd}}</p>
                </div>
                <button type="submit" class="btn btn-primary">
                    登入
                </button>
            </form>
            <div class="form-group">
                {{ error.message }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data()
    {
        return {
            user_account: '',
            user_pwd: '',
            error: {},
            isLogin: false,
        }
    },
    methods:
        {
            async onSubmit(){
                this.error = {};
                if(this.user_account === '') this.error.user_account = "必須填入使用者帳號";
                if(this.user_pwd === '') this.error.user_pwd = "必須填入使用者密碼";
                if(JSON.stringify(this.error) !== '{}' ) return;

                this.axios
                    .post('/api/login',{ user_account: this.user_account, user_pwd: this.user_pwd})
                    .then(response => {
                        console.log(response)
                        this.$store.dispatch('setUserData', response.data);
                        this.testUser = this.$store.state.userInfo;
                        this.isLogin = this.$store.state.isLogin;
                        this.$router.push({name: 'Report'});
                    })
                    .catch(err =>{
                        console.log(err.response.data);
                        // this.error.message = err.response.data.Msg;
                    })
                    .finally(() => this.loading = false)
            }
        }
}
</script>

<style scoped>

</style>
