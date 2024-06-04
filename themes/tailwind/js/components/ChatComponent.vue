<template>
    <div class="flex flex-col">
      <div class="flex-1 overflow-y-auto">
        <div v-for="message in messages" :key="message.id" class="flex items-start p-4 mb-2" :class="message.sender_id === currentUser.id ? 'justify-end' : 'justify-start'">
          <div class="max-w-[80%] rounded-lg p-4" :class="message.sender_id === currentUser.id ? 'bg-blue-300' : 'bg-gray-200'">
            {{ message.text }}
          </div>
        </div>
      </div>
      <div class="p-4 flex justify-between">
        <input v-model="newMessage" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Type your message...">
        <button @click="sendMessage" class="bg-blue-500 text-white px-4 py-2 rounded-lg mx-4">Send</button>
      </div>
    </div>
  </template>

  <script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';

    const props = defineProps({
        friend: {
            type: Object,
            required: true,
        },
        currentUser: {
            type: Object,
            required: true,
        }
    });

  const messages = ref([]);
  const newMessage = ref('');

  const sendMessage = () => {
    axios.post(`/messages/${props.friend.id}`, {
        text: newMessage.value,
    }).then(response => {
        messages.value.push(response.data);
        newMessage.value = '';
    });
  };

  onMounted(() => {
    axios.get(`/messages/${props.friend.id}`).then((response) => {
        console.log(response.data);
        messages.value = response.data;
    });
  });
  </script>
