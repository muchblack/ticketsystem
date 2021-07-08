<template>
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <router-link :class="['nav-link']" active-class="active" to="/report"> 問題回報 </router-link>
        </li>
        <li class="nav-item" v-if="isAdmin">
            <router-link :class="['nav-link']" active-class="active" to="/user">使用者管理</router-link>
        </li>
    </ul>
    <p v-if=" isLogin "> HI, {{ userInfo.user_account }} <a href="#" @click="logout()">登出</a></p>
</template>

<script>
export default {
    name: "Nav",
    data() {
        return {
            isLogin: false,
            isAdmin: false,
            userInfo: {},
        }
    },
    created()
    {
        this.isLogin = this.$store.state.isLogin;
        this.isAdmin = this.$store.state.isAdmin;
        this.userInfo = this.$store.state.userInfo;
    },
    methods:{
        logout()
        {
            this.$store.dispatch('userLogout');
            this.$router.push('/');
        }
    }
}
</script>

<style scoped>

</style>
