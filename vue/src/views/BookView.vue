<template>
  <div class="py-5 px-8">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="container mx-auto">
      
      <form @submit.prevent="saveBook">
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

          <!---<input type="hidden" v-model="model.status" :value="'active'" />-->
          <p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
  </p>
  <ul v-if="errorb && errorb.length">
        {{ errorb }}
    </ul>
          <label
            for="comment"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400"
            >Add Comment</label
          >
          <textarea
            id="comment"
            name="comment"
            v-model="model.comment"
            @keyup="remaincharCount"
            rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Leave a comment..."
          ></textarea>
          <span class="message-counter">{{remaincharactersText}} / 500</span>

          <button
            type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
//import { comment } from "postcss";
import { computed, watch, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
import QuestionViewer from "../components/viewer/QuestionViewer.vue";

const route = useRoute();
const router = useRouter();
const store = useStore();
const errors = [];

const loading = computed(() => store.state.currentBook.loading);
const book = computed(() => store.state.currentBook.data);

const bookFinished = ref(false);
const errorb = ref({});

let remaincharactersText = "Remaining 14 characters.";
//let remainCharacters = 0;

let duel = route.params.id;

let model = ref({
  comment: "",
  errorb : [],
});

const answers = ref({});

// Watch to current survey data change and when this happens we update local model

store.dispatch("getBook", route.params.id);

function remaincharCount()
{
  let message = "";
  let maxcharacter= 14;
  
  if(model.value.comment.length > maxcharacter)
  {
    remaincharactersText = "Exceeded "+ maxcharacter+" characters limit.";
  }
  else{

   var remainCharacters = maxcharacter - message.length;
  remaincharactersText = "Remaining " + remainCharacters + " characters.";

}
}

function submitBook() {
  console.log(JSON.stringify(model.value, undefined, 2));
  store
    .dispatch("saveComment", {
      bookId: book.value.id,
      comment: model.value.comment,
      postid: duel,
      status: "active",
    })
    .then((response) => {
      if (response.status === 200 || response.status === 201) {
        router.push({
          name: "BookView",
          params: { id: book.book.id },
        });
      }
    });
}

function saveBook() {
  //let data = "chima";
  console.log(model.value);


  if (model.value.comment == "") {
    errors.push("Name required.");
    
    //console.log(errors)
  }

  if (model.value.comment.length >= 4) {
    errors.push("exceeded.");
    
   // console.log(errors)
  }
  

  store
    .dispatch("saveComment", {
      bookId: book.value.id,
      comment: model.value.comment,
      postid: duel,
      status: "active",
    })
    .then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "Comment was successfully added",
      });
      router.go();
    })
    .catch((error) => {
      console.log(error.response);
      errorb.value = error.response;
    });
}

function submitAnotherComment() {
  answers.value = {};
  commentFinished.value = false;
}
</script>

<style></style>
var