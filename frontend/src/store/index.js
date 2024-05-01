import { createApp } from 'vue'
import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
  state () {
    return {
      count: 0,
      editMsg: false,
      createMsg: false,
      deleteMsg: false
    }
  },
  mutations: {
    increment (state) {
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


}
})

export default store