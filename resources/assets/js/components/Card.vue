<template>
    <div class="card">
        <div class="col-1"> 
          <img download :src="image"/>
        </div>
        <div class="col-2">
            <h3>Name: {{ first_name }} {{ last_name }}</h3>
            <strong>Email: {{ email }}</strong><br>
            <h4>Phone: {{ phone }}</h4>
            <h4>VCF: <a href="vcf.html" target="_blank" download>VCF Card</a></h4>
        </div>
    </div>
</template>
<script>
  export default {
    computed: {
      image() {
        //return 'https://cdn.experiencecr.com/rackazon/headshots/jodina_williams_headshot.png';
        return this.mug;
      }
    },
    props: ['first_name', 'last_name', 'email', 'phone', 'mug']
  }
</script>
<style>
    .card {
        display: flex;
        margin: 1em 1em 1em 0;
        border: 1px solid #d1d1d1;
        padding: 1em;
        max-width: 350px;
        background-color: white;
    }

    .card img {
        height: 70px;
    }

    .col-2 {
        margin-left: 1em;
    }

    .col-2 > h3 {
        margin: 0.5em 0;
    }
</style>
