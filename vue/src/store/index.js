//import axios from "axios";
import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
    },
    dashboard: {
      loading: false,
      data: {},
    },
    books: {
      loading: false,
      data: {},
    },
    currentBook: {
      loading: false,
      data: {},
    },
    notification: {
      show: false,
      type: null,
      message: null,
    },
  },
  getters: {},
  actions: {
    getDashboardData({ commit }) {
      commit("dashboardLoading", true);
      return axiosClient
        .get("/dashboard")
        .then((res) => {
          commit("dashboardLoading", false);
          commit("setDashboardData", res.data);
          return res;
        })
        .catch((error) => {
          commit("dashboardLoading", false);
          return error;
        });
    },
    getBooksData({ commit }) {
      commit("booksLoading", true);
      return axiosClient
        .get("/books")
        .then((res) => {
          commit("booksLoading", false);
          commit("setBooksData", res.data);
          return res;
        })
        .catch((error) => {
          commit("booksLoading", false);
          return error;
        });
    },
    getBook({ commit }, id) {
      commit("setCurrentBookLoading", true);
      return axiosClient
        .get(`/book/${id}`)
        .then((res) => {
          commit("setCurrentBook", res.data);
          commit("setCurrentBookLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentBookLoading", false);
          throw err;
        });
    },
    getSurvey({ commit }, id) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey/${id}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    saveComment({ commit }, book) {
      let response;
      if (book.id) {
        response = axiosClient.put(`/book/${book.id}`, book).then((res) => {
          commit("setCurrentBook", res.data);
          return res;
        });
      } else {
        response = axiosClient.post("/comment", book).then((res) => {
          commit("setCurrentBook", res.data);
          return res;
        });
      }
      return response;
    },
    register({ commit }, user) {
      return axiosClient.post("/register", user).then(({ data }) => {
        commit("setUser", data);
        return data;
      });
    },
    login({ commit }, user) {
      return axiosClient.post("/login", user).then(({ data }) => {
        commit("setUser", data);
        return data;
      });
    },
    logout({ commit }) {
      return axiosClient.post("/logout").then((response) => {
        commit("logout");
        return response;
      });
    },
  },
  mutations: {
    booksLoading: (state, loading) => {
      state.books.loading = loading;
    },
    setDashboardData: (state, data) => {
      state.dashboard.data = data;
    },
    setBooksData: (state, data) => {
      state.books.data = data;
    },
    setCurrentBook: (state, book) => {
      state.currentBook.data = book;
    },
    setCurrentBookLoading: (state, loading) => {
      state.currentBook.loading = loading;
    },
    logout: (state) => {
      state.user.data = {};
      state.user.token = null;
      sessionStorage.removeItem("TOKEN");
    },
    setUser: (state, userData) => {
      state.user.token = userData.token;
      state.user.data = userData.user;
      sessionStorage.setItem("TOKEN", userData.token);
    },
    notify: (state, { message, type }) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 3000);
    },
  },
  modules: {},
});

export default store;
