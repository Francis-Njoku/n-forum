<template>
  <div class="py-5 px-8">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <form @submit.prevent="submitSurvey" v-else class="container mx-auto">
      <div class="grid grid-cols-6 items-center">
        <div class="mr-4">
          <!-- <img :src="survey.image_url" :alt="survey.title" />-->
        </div>
        <div class="col-span-5">
          <h1 class="text-3xl mb-3">{{ data.url }}</h1>
          <p class="text-gray-500 text-sm" v-html="data"></p>
        </div>
      </div>
      <div
        v-if="bookFinished"
        class="py-8 px-6 bg-emerald-400 text-white w-[600px] mx-auto"
      >
        <div class="text-xl mb-3 font-semibold">Comment has been sent.</div>
        <button
          @click="submitAnotherComment"
          type="button"
          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit another comment
        </button>
      </div>
      <div v-else>
        <hr class="my-3" />
        <!--<div v-for="(question, ind) of survey.questions" :key="question.id">
          <QuestionViewer
            v-model="answers[question.id]"
            :question="question"
            :index="ind"
          />
        </div>-->
        <button
          type="submit"
          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { computed, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import QuestionViewer from "../components/viewer/QuestionViewer.vue";
const route = useRoute();
const store = useStore();

const loading = computed(() => store.state.currentBook.loading);
const data = computed(() => store.state.currentBook.data);

const bookFinished = ref(false);

const answers = ref({});

store.dispatch("getBook", route.params.id);

function submitBook() {
  console.log(JSON.stringify(answers.value, undefined, 2));
  store
    .dispatch("saveBook", {
      bookId: book.value.id,
      answers: answers.value,
    })
    .then((response) => {
      if (response.status === 200 || response.status === 201) {
        bookFinished.value = true;
      }
    });
}

function submitAnotherComment() {
  answers.value = {};
  commentFinished.value = false;
}
</script>

<style></style>
