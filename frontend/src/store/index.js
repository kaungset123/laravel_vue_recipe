import { createApp } from 'vue'
import { createStore } from 'vuex'


const state = {
    user: null,
    invalidMsg: false,
    logoutMsg: false,
    resetFail: false,
    checkMail: false,
    resetSuccess: false,
    resetTwice: false
}

// Create a new store instance.
const store = createStore({
  state () {
    return {
      count: 0,
      editMsg: false,
      createMsg: false,
      deleteMsg: false,
      registerMsg: false,
      welcomeMsg: false,
    }
  },
  actions: {
    user(context, user){
        context.commit('user', user)
    },

    invalidMsg(context, invalidMsg){
        context.commit('invalidMsg', invalidMsg)
    },

    logoutMsg(context, logoutMsg){
        context.commit('logoutMsg', logoutMsg)
    },

    resetFail(context, resetFail){
        context.commit('resetFail', resetFail)
    },

    checkMail(context, checkMail){
        context.commit('checkMail', checkMail)
    },

    resetSuccess(context, resetSuccess){
        context.commit('resetSuccess', resetSuccess)
    },

    resetTwice(context, resetTwice){
        context.commit('resetTwice', resetTwice)
    }
  },
  mutations: {
    increment (state) {l
      state.count++
    },
    showEditMsg(state) {
        state.editMsg = true;
        setTimeout(() => {
            state.editMsg = false
        },"1000")
    },   

    showCreateMsg(state) {
        state.createMsg = true
        setTimeout(() => {
            state.createMsg = false
        },"1000")
    },

    showDeleteMsg(state) {
        state.deleteMsg = true
        setTimeout(() => {
            state.deleteMsg = false
        },"1000")
    },

    showRegisterMsg(state) {
        state.registerMsg = true
        setTimeout(() => {
            state.registerMsg = false
        },"1000")
    },

    showWelcomeMsg(state) {
        state.welcomeMsg = true
        setTimeout(() => {
            state.welcomeMsg = false
        },"1000")
    },

    invalidMsg(state, invalidMsg ) {
        state.invalidMsg = invalidMsg;
        setTimeout(() => {
            state.invalidMsg = false
        },"1500")
    },
    
    logoutMsg(state, logoutMsg ) {
        state.logoutMsg = logoutMsg;
        setTimeout(() => {
            state.logoutMsg = false
        },"3000")
    },

    resetFail(state, resetFail ) {
        state.resetFail = resetFail;
        setTimeout(() => {
            state.resetFail = false
        },"3000")
    },

    checkMail(state, checkMail ) {
        state.checkMail = checkMail;
        setTimeout(() => {
            state.checkMail = false
        },"3000")
    },

    resetSuccess(state, resetSuccess ) {
        state.resetSuccess = resetSuccess;
        setTimeout(() => {
            state.resetSuccess = false
        },"5000")
    },

    resetTwice(state, resetTwice ) {
        state.resetTwice = resetTwice;
        setTimeout(() => {
            state.resetTwice = false
        },"3000")
    },

    user(state, user) {
        state.user = user
    }

},
    getters: {
        user: (state) => {
            return state.user
        },
        invalidMsg: (state) => {
            return state.invalidMsg
        },
        logoutMsg: (state) => {
            return state.logoutMsg    
        },
        resetFail: (state) => {
            return state.resetFail    
        },
        checkMail: (state) => {
            return state.checkMail    
        },
        resetSuccess: (state) => {
            return state.resetSuccess    
        },
        resetTwice: (state) => {
            return state.resetTwice    
        }
    }
   
})

export default store