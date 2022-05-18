<template>
  <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet"/>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
      <div class="bg-white overflow-hidden shadow sm:rounded-lg p-6">

        <h2 class="text-2xl text-center leading-7 font-semibold" v-show="wasSentSuccess">Your message was
          delivered...</h2>

        <ValidationObserver v-slot="{ handleSubmit }" v-show="!wasSentSuccess">
          <form @submit.prevent="handleSubmit(send)" ref="feedbackForm">

            <ValidationProvider v-slot="{ errors }" name="message" rules="required|min:50">
              <label class="block text-sm font-medium text-gray-700" for="message">Message</label>

              <textarea v-model="message"
                        name="message"
                        rows="5"
                        class="p-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                        placeholder="placeholder"></textarea>

              <span class="text-red-600">{{ errors[0] }}</span>
            </ValidationProvider>

            <div class="mt-5">
              <label class="block text-sm font-medium text-gray-700">Attach something</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                       aria-hidden="true">
                    <path
                      d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <ValidationProvider v-slot="{ validate, errors }"
                                        name="attachment"
                                        rules="size:10240">

                      <label for="attachment"
                             class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Upload a file</span>

                        <input type="file" ref="attachment" id="attachment" @change="validate" class="sr-only"/>

                      </label>
                      <p class="pl-1">or drag and drop</p>
                      <p class="text-red-700">{{ errors[0] }}</p>
                    </ValidationProvider>
                  </div>
                  <p class="text-xs text-gray-500">PDF up to 10MB</p>
                </div>
              </div>

              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">

                <button type="submit"
                        class="justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-indigo-500">
                  Send
                </button>
              </div>
            </div>

          </form>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import {ValidationProvider, ValidationObserver} from "vee-validate";

export default {
  name: "FeedbackPage",

  components: {
    ValidationProvider,
    ValidationObserver
  },

  data: () => ({
    message: "",
    wasSentSuccess: false
  }),

  methods: {
    send() {
      const self = this;

      const formData = new FormData(self.$refs.feedbackForm);

      if (self.$refs.attachment.files.length > 0)
        formData.append('attachment', self.$refs.attachment.files[0])

      fetch('/api/feedback', {
        method: 'POST',
        headers: {
          'Accept': 'application/json'
        },
        body: formData
      }).then(response => {
        if (response.status >= 200 && response.status < 300)
          return response.json();

        return Promise.reject(response);
      })
        .then(json => {
          self.wasSentSuccess = true;
          console.log('Success:', json);
        })
        .catch(error => {
          console.error('Error:', error);
        });

    }
  }
};
</script>
