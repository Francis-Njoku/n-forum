<template>
  <div class="py-5 px-8">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <form @submit.prevent="submitBook" v-else class="container mx-auto">
      <div class="grid grid-cols-6 items-center">
        <div class="mr-4">
          <!-- <img :src="survey.image_url" :alt="survey.title" />-->
        </div>
        <div class="col-span-5">
          <h1 class="text-3xl mb-3">Name of Book: {{ book.book.name }}</h1>
          <p class="text-gray-500 text-sm" v-html="book.book.authors"></p>
          <p class="text-gray-500 text-sm">
            Number of pages: {{ book.book.numberOfPages }}
          </p>
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
        <h3>Comments</h3>
        <div v-for="(comments, ind) of book.comment" :key="comments.postid">
          <p>{{ comments.comment }}</p>
          <hr />
          <br /><br />
        </div>
        <!--<div v-for="(question, ind) of survey.questions" :key="question.id">
          <QuestionViewer
            v-model="answers[question.id]"
            :question="question"
            :index="ind"
          />
        </div>-->
        <input type="hidden" name="postid" value="{{ book.book.id }}" />
        <input type="hidden" name="status" value="active" />

        <label
          for="comment"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
          >Add Comment</label
        >
        <textarea
          id="comment"
          name="comment"
          rows="4"
          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Leave a comment..."
        ></textarea>

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
//import { comment } from "postcss";
import { computed, ref } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import QuestionViewer from "../components/viewer/QuestionViewer.vue";
const route = useRoute();
const store = useStore();

const loading = computed(() => store.state.currentBook.loading);
const book = computed(() => store.state.currentBook.data);

console.log(book);

const bookFinished = ref(false);

const answers = ref({});

store.dispatch("getBook", route.params.id);

function submitBook() {
  console.log(JSON.stringify(answers.value, undefined, 2));
  store
    .dispatch("saveComment", {
      bookId: book.value.id,
      postid: book.value.id,
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
