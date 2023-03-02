<template>
  <div class="container">
    <Header/>

    <form @submit="submitForm" class="form_search">
      <input class="input_search" type="text" name="search" id="search" placeholder="Buscar" v-model="search">
      <button class="button_search" type="submit"><i class="ph-magnifying-glass ph-xl hover"></i></button>
    </form>

    <h1 @click="teste" class="title">Lista de contatos</h1>

    <div class="card_contact">
      <div class="list_contact">
        <div @click="showContact(contact)" v-for="(contact, i) in filteredContacts()" :key="i" class="contact hover">
          <img class="contact_img" :src="'http://localhost:8000/imgs/contacts/' + contact.image"  :alt="contact.name">
          <p class="contact_name">{{contact.name}}</p>
        </div> 
      </div>
    </div>

    <ShowContact @contact-deleted="closeShowContact" :showPopup="showPopup" :selectedContact="selectedContact" @close="closePopup"/>
  </div>
</template>

<script>
import Header from '../components/Header.vue';
import ShowContact from '../components/ShowContact.vue';

export default {
  name: 'HomeView',
  components: {
    Header,
    ShowContact
  },
  data(){
    return{
      contacts:[],
      selectedContact: "",
      search: '',
     
    }
  },
  methods: {
    async getContacts(){
      const req = await fetch ('http://127.0.0.1:8000/api/contatos');
      const data = await req.json();

      this.contacts = data;
    },
    showContact(contact) {
      this.selectedContact = contact;
      this.showPopup = true;
    },
    closePopup() {
      this.showPopup = false;
      this.selectedContact = {};
    },
    closeShowContact() {
      location.reload();
    },
    filteredContacts() {
      if (this.search) {
        return this.contacts.filter(contact => {
          return contact.name.toLowerCase().includes(this.search.toLowerCase());
        });
      } else {
        return this.contacts;
      }
    },
    submitForm(e){
      e.preventDefault()
    }
  },
  
  mounted(){
    this.getContacts();
  }
}
</script>

<style scoped>

/* Search*/
.form_search{
  display: flex;
  justify-content: center;
  align-items: center;

  width: 100%;
  margin: 40px 40px 0px 0px;
  
}

.button_search{
  all: unset;
  color: var(--main-green);
  margin-left: 10px;
  cursor: pointer;
}

.input_search{
  all: unset;
  width: 30%;
  height: 39px;
  font-size: small;
  
  color: var(--medium-grey) ;
  background-color: var(--lines-dark);
  border-radius: 40px;
  padding: 0px 10px;
  
}
/* Search*/

.title{
  width: 100%;
  text-align: center;
  color: var(--main-green);
  font-weight: 700;
  padding: 40px;
}
.card_contact{
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  
}

.section_contacts{
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  background-color: var(--dark-grey);
  margin: 20px 30px;
  border-radius: 5px;
  padding: 20px 20px;

}

.title_contact{
  text-align: center;
  margin-bottom: 15px;
  font-weight: 600;
  font-size: small;
  color: var(--main-green);

}

.list_contact{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

  width: 23%;
  height: 100%;
  background-color: var(--dark-grey);
  margin: 20px 30px;
  border-radius: 5px;
  padding: 20px 20px;
  
}

.contact_title{
  font-weight: 600;
  font-size: medium;
  
  color: var(--main-green);
  padding: 10px;
}

.contact{
  width: 90%;
  display: flex;
  justify-content:flex-start;
  align-items: center;
  padding: 8px;
  margin-bottom: 8px;
  cursor: pointer;
  border-bottom: 1px solid var(--main-green);
  
}

.contact_img{
  width: 60px;
  height: 60px;
  margin-right: 13px;
  border-radius: 50px;
  padding: 2px;
  border: var(--main-green-hover) 2px solid;
}

.contact_name{
  font-size: large;
  font-weight: 500;
  color: var(--medium-grey);
}

@media only screen and (max-width: 700px) {

  .list_contact{  
    width: 80%;
  }
  .input_search{
    width: 50%;
  }
  
}
</style>
