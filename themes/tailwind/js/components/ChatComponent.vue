<template>
    <div class="flex flex-col">
      <div class="flex-1 overflow-y-auto">
        <div v-for="message in messages" :key="message.id" class="flex items-start p-4 mb-2" :class="message.sender === 'user' ? 'justify-end' : 'justify-start'">
          <div class="max-w-[80%] rounded-lg p-4" :class="message.sender === 'user' ? 'bg-blue-200' : 'bg-gray-200'">
            {{ message.content }}
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
  import { ref } from 'vue';

  const messages = ref([
    { id: 1, content: 'Hello!', sender: 'bot' },
    { id: 2, content: 'How can I help you?', sender: 'bot' }
  ]);
  const newMessage = ref('');

  const sendMessage = () => {
    if (newMessage.value.trim() !== '') {
      messages.value.push({ id: Date.now(), content: newMessage.value, sender: 'user' });
      newMessage.value = '';
    }
  };
  </script>
