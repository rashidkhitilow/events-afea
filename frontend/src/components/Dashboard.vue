<template>
  <div>
    <h1>Events</h1>
    <ul>
      <li v-for="event in events" :key="event.id">
        <router-link :to="`/events/${event.id}`">{{ event.name }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  data() {
    return {
      events: [],
    };
  },
  mounted() {
    this.getEvents();
  },
  methods: {
    async getEvents() {
      try {
        const response = await api.get('/events');
        this.events = response.data;
      } catch (error) {
        console.error('Error fetching events:', error);
      }
    },
  },
};
</script>

