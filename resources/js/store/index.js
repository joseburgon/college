import Vuex from 'vuex'
import Vue from 'vue'

import Students from '@/apis/Students'
import Transactions from '@/apis/Transactions'
import References from '@/apis/References'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    students: [],
    studentsMeta: {},
    studentsCount: '',
    transactions: [],
    transactionsMeta: {},
    transactionsCount: '',
    references: [],
    referencesMeta: {},
    referencesCount: '',
  },

  getters: {
    //
  },

  actions: {
    fetchStudents({ commit }, page = 1) {
      return new Promise((resolve, reject) => {
        Students.get(page).then((res) => {
          commit('setStudents', res.data.data)
          commit('setStudentsMeta', res.data.meta.page)
          commit('setStudentsCount', res.data.meta.page.total)
          resolve()
        })
      })
    },

    searchStudents({ commit }, { searchTerms, page }) {
      return new Promise((resolve, reject) => {
        Students.search(searchTerms, page).then((res) => {
          commit('setStudents', res.data.data)
          commit('setStudentsMeta', res.data.meta.page)
          resolve()
        })
      })
    },

    fetchTransactions({ commit }, page = 1) {
      return new Promise((resolve, reject) => {
        Transactions.get(page).then((res) => {
          commit('setTransactions', res.data.data)
          commit('setTransactionsMeta', res.data.meta.page)
          resolve()
        })
      })
    },

    searchTransactions({ commit }, { searchTerms, page }) {
      return new Promise((resolve, reject) => {
        Transactions.search(searchTerms, page).then((res) => {
          commit('setTransactions', res.data.data)
          commit('setTransactionsMeta', res.data.meta.page)
          resolve()
        })
      })
    },

    countApprovedTransactions({ commit }) {
      return new Promise((resolve, reject) => {
        axios.get(`api/transactions/count-approved`).then((res) => {
          commit('setTransactionsCount', res.data)
        })
      })
    },

    fetchReferences({ commit }, page = 1) {
      return new Promise((resolve, reject) => {
        References.get(page).then((res) => {
          commit('setReferences', res.data.data)
          commit('setReferencesMeta', res.data.meta.page)
          commit('setStudentsCount', res.data.meta.page.total)
          resolve()
        })
      })
    },

    searchReferences({ commit }, { searchTerms, page }) {
      return new Promise((resolve, reject) => {
        References.search(searchTerms, page).then((res) => {
          commit('setReferences', res.data.data)
          commit('setReferencesMeta', res.data.meta.page)
          resolve()
        })
      })
    },
  },

  mutations: {
    setStudents(state, students) {
      state.students = students
    },

    setStudentsMeta(state, meta) {
      state.studentsMeta = meta
    },

    setStudentsCount(state, count) {
      state.studentsCount = count
    },

    setTransactions(state, transactions) {
      state.transactions = transactions
    },

    setTransactionsMeta(state, meta) {
      state.transactionsMeta = meta
    },

    setTransactionsCount(state, count) {
      state.transactionsCount = count
    },

    setReferences(state, references) {
      state.references = references
    },

    setReferencesMeta(state, meta) {
      state.referencesMeta = meta
    },

    setReferencesCount(state, count) {
      state.referencesCount = count
    },
  },
})
