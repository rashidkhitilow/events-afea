<template>
  <div class="events-page">
    <h1 class="page-title">Events</h1>
    <input v-model="searchQuery" placeholder="Search events..." class="search-bar" />

    <div class="events-grid">
      <div v-for="event in filteredEvents" :key="event.id" class="event-card">
        <h2>{{ event.name }}</h2>
        <p>{{ event.total_seats }}</p>
        <p>{{ event.available_seats }}</p>
        <router-link :to="{ name: 'EventDetail', params: { id: event.id }}" class="view-button btn">
          View Event
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>

import api from '@/services/api';
export default {
  data() {
    return {
      events: [],
      searchQuery: '',
    };
  },
  computed: {
    filteredEvents() {
      if (this.searchQuery.trim() === '') {
        return this.events;
      }

      return this.events.filter(event =>
          event.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
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

<style scoped>
.events-page {
  padding: 20px;
}

.page-title {
  text-align: center;
  font-size: 2rem;
  margin-bottom: 20px;
}

.search-bar {
  display: block;
  margin: 0 auto 20px;
  padding: 10px;
  width: 60%;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

.events-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
}

.event-card {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.2s;
}

.event-card:hover {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}
.btn {
  display: inline-block;
  margin-top: 10px;
  padding: 8px 16px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  text-decoration: none;
  transition: background-color 0.3s;
}
.view-button {
  background-color: #007bff;
  color: white;
}

.view-button:hover {
  background-color: #0056b3;
}
</style>
