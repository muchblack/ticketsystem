import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

export default new Vuex.Store({
    plugins:[createPersistedState({
        storage: window.sessionStorage,
    })],
    state: {
        userInfo: {},
        isLogin: false,
        isAdmin: false,
    },
    actions: {
        setUserData(context, User)
        {
            context.commit('updateData', User)
        },
        setUserRole(context, User)
        {
            context.commit('updateRole',User)
        },
        userLogout(context)
        {
            context.commit('Logout')
        }
    },
    mutations: {
        updateData(state, User)
        {
            state.userInfo.id = User.id;
            state.userInfo.user_account = User.user_account;
            state.userInfo.user_role = User.user_role;
            state.isLogin = true;
            if(User.user_role == 1)
            {
                state.isAdmin = true;
            }
        },
        Logout(state)
        {
            state.userInfo = {};
            state.isLogin = false;
            state.isAdmin = false;
        }
    }
})
