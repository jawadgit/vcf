<template>
    <div id="app">
        <div class="heading">
            <h1>Cards</h1>
        </div>
        <div>
            <button @click="create">Import Data</button>
        </div>
        <card-component
                v-for="card in cards"
                v-bind="card"
                :key="card.id"
                @update="update"
                @delete="del"
        ></card-component>
    </div>
</template>

<script>
  function Card({ id, first_name, last_name, email, phone, mug}) {
    this.id = id;
    this.first_name = first_name;
    this.last_name = last_name;
    this.email = email;
    this.phone = phone;
    this.mug = mug;
  }

  import CardComponent from './components/Card.vue';

  export default {
    data() {
      return {
        cards: [],
        mute: false
      }
    },
    methods: {
      async create() {
        this.mute = true;
        const { data } = await window.axios.get('/api/cards/create');
        console.log(data);
        this.cards.push(new Card(data));
        this.mute = false;
      },

      async read() {
        this.mute = true;
        const { data } = await window.axios.get('/api/cards');
        data.forEach(card => this.cards.push(new Card(card)));
        this.mute = false;
      },
      async update(id, color) {
        this.mute = true;
        await window.axios.put(`/api/cards/${id}`, { color });
        this.cards.find(card => card.id === id).color = color;
        this.mute = false;
      },
      async del(id) {
        this.mute = true;
        await window.axios.delete(`/api/cards/${id}`);
        let index = this.cards.findIndex(card => card.id === id);
        this.cards.splice(index, 1);
        this.mute = false;
      }
    },
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    },
    components: {
      CardComponent
    },
    created() {
      this.read();
    }
  }
</script>
<style>
    #app {
        margin-left: 1em;
    }

    .heading h1 {
        margin-bottom: 0;
    }
</style>
