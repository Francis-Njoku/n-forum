<template>
  <PageComponent title="Books">
    <div v-if="loading" class="flex justify-center">Loading...</div>
    <div v-else class="grid gap-5 text-gray-700">
      <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
              <table class="min-w-full">
                <thead class="border-b">
                  <tr>
                    <th
                      scope="col"
                      class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                    >
                      Name of Book
                    </th>
                    <th
                      scope="col"
                      class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                    >
                      Author
                    </th>
                    <th
                      scope="col"
                      class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                    >
                      Comment Count
                    </th>
                    <th
                      scope="col"
                      class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                    >
                      Book Details
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <BookListItem
                    v-for="(book, ind) in books.data"
                    :key="book.id"
                    :book="book"
                    class="opacity-0 animate-fade-in-down"
                    :style="{ animationDelay: `${ind * 0.1}s` }"
                    @delete="deleteBook(book)"
                  />
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import BookListItem from "../components/BookListItem.vue";
import { computed } from "vue";
import { useStore } from "vuex";
//import BookListItem from "../components/BookListItem.vue";

const store = useStore();
const books = computed(() => store.state.books);
const loading = computed(() => store.state.books.loading);
const data = computed(() => store.state.books.data);

store.dispatch("getBooksData");
</script>

<style scoped></style>
