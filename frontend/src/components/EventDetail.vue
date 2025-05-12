<template>
  <div class="event-details-page" v-if="event" style="margin: 0 auto; width: 800px">
    <div class="event-header">
      <h1>{{ event.name }}</h1>
      <p>{{ event.total_seats }}</p>
      <p class="badge" style="color: red; background: green" >{{ event.available_seats }}</p>
    </div>

    <div class="user_events-section">
      <h2>Events</h2>
      <div class="add-user_event-form">
        <h3>Select Available Seat</h3>
        <select v-model="selectedPlace">
          <option v-for="seat in event.available_seat_numbers" :key="seat" :value="seat">
            Seat {{ seat }}
          </option>
        </select>
        <p v-if="selectedPlace">Selected Seat: {{ selectedPlace }}</p>
        <button @click="addEvent">Add Event</button>
      </div>
    </div>
  </div>
</template>

<script>
import api from '@/services/api';

export default {
  props: {
    id: {
      type: [String, Number],
      required: true,
    },
  },
  data() {
    return {
      event: null,
      selectedPlace: null,
    };
  },
  mounted() {
    this.getEventDetails(this.id);
  },
  watch: {
    id(newId) {
      this.getEventDetails(newId);
    },
  },
  methods: {
    async getEventDetails(id) {
      try {
        const response = await api.get(`/events/${id}`);
        this.event = response.data[0];
      } catch (error) {
        console.error('Error fetching event details:', error);
      }
    },
    async addEvent() {
      if (this.event.name && this.selectedPlace) {
        try {
          const user_eventData = {
            event_id: this.id, // Ensure the event ID is passed to associate the user_event
            seat_number: this.selectedPlace
          };
          await api.post(`/user_events`, user_eventData);
          this.selectedPlace = null; // Reset the selected place after adding
          this.getEventDetails(this.id);
        } catch (error) {
          console.error('Error adding user_event:', error);
        }
      } else {
        alert('Please fill all fields');
      }
    },
  },
};
</script>
<style scoped>
.event-details-page {
  padding: 20px;
}

.event-header {
  margin-bottom: 40px;
}

.event-header h1 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

.event-header p {
  font-size: 1.2rem;
  color: #666;
}

.user_events-section {
  margin-bottom: 40px;
}

.user_event-list {
  list-style: none;
  padding: 0;
}

.user_event-item {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
}

.user_event-actions button {
  margin-left: 10px;
}

.add-user_event-form {
  margin-top: 20px;
}

.add-user_event-form input {
  display: block;
  margin: 10px 0;
  padding: 8px;
  width: 100%;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.add-user_event-form button {
  padding: 10px 20px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.add-user_event-form button:hover {
  background-color: #218838;
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

.edit-button {
  background-color: #7ee696;
  color: white;
}

.edit-button:hover {
  background-color: #106d15;
}

.delete-button {
  background-color: #df2144;
  color: white;
}

.delete-button:hover {
  background-color: #61051e;
}

/* Basic styling for the select dropdown */
select {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f9f9f9;
  color: #333;
  appearance: none; /* Remove default arrow for custom styling */
  outline: none;
  transition: border-color 0.3s ease, background-color 0.3s ease;
}

/* Add some space for a custom arrow (optional) */
select:focus {
  border-color: #007bff; /* Blue border on focus */
  background-color: #fff; /* White background on focus */
}

/* Hover effect */
select:hover {
  border-color: #007bff;
}

/* Add custom arrow icon for dropdown */
select::after {
  content: '\25BC'; /* Down arrow */
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
}

/* Optional: style the select options */
option {
  background-color: #fff;
  color: #333;
  padding: 10px;
}

/* Optional: Disabled option styles */
option[disabled] {
  color: #999;
}

</style>