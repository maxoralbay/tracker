<template>
  <div>
    <b-table :items="domains" :fields="fields" @row-clicked="showDomainDetails">
      <template #cell(domain)="data">
        <a href="#" @click.prevent="showDomainDetails(data.item)">{{ data.value }}</a>
      </template>
    </b-table>

    <DomainDetailsModal v-if="selectedDomain" :domain="selectedDomain" @close="selectedDomain = null" />
  </div>
</template>

<script>
import axios from 'axios';
import DomainDetailsModal from "@/components/DomainDetailsModal.vue";

export default {
  components: {DomainDetailsModal},
  data() {
    return {
      domains: [],
      selectedDomain: null,
      fields: [
        { key: 'id', label: 'Domain ID' },
        { key: 'domain', label: 'Domain' },
        { key: 'visit_count', label: 'Total Visits' },
        { key: 'last_month_visits', label: 'Visits Last Month' },
        { key: 'contact_count', label: 'Contacts' },
        { key: 'unique_visitors', label: 'Unique Visitors' },
        { key: 'last_contact_date', label: 'Last Contact Date' }
      ]
    };
  },
  mounted() {
    axios.get('/api/domains').then(response => {
      try {
        this.domains = response.data;
      } catch (e) {
        console.error(e);
      }
    });
  },
  methods: {
    showDomainDetails(domain) {
      this.selectedDomain = domain;
    }
  }
};
</script>
