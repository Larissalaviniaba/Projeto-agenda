<template>
  <section v-if="showPopup" class="show_modal">
    <div class="section_show">
      <button @click="closePopup" class="close_modal">
        <i class="ph-x"></i>
      </button>
      <div class="contact_profile">
        <img :src="'http://localhost:8000/imgs/contacts/' + selectedContact.image" :alt="selectedContact.name" />
        <h3 class="profile_name">{{ selectedContact.name }}</h3>
      </div>
      <div class="contact_info">
        <span>Número:</span>
        <p id="p_number">{{ selectedContact.number }}</p>
        <span>E-mail:</span>
        <p id="p_email">{{ selectedContact.email }}</p>
        <div class="group_buttons">
          <router-link to="/editar" @click="editContact" class="button hover">Editar</router-link>
          <button @click="deleteContact(selectedContact.id)" class="button hover" type="submit">Excluir</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "ShowContact",
  props: {
    showPopup: {
      type: Boolean,
    },
    selectedContact: {
      required: true,
    },
  },
  methods: {
    closePopup() {
      this.$emit("close");
    },
    editContact(){
        this.$router.push({
          name: 'Edit',
          params: {
            selectedContact: JSON.stringify(this.selectedContact)
          }
        })
    },
    async deleteContact(id){
            fetch(`http://127.0.0.1:8000/api/contatos/${id}`, {
                method: 'DELETE',
                headers: {
                'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                throw new Error('Erro ao excluir o recurso');
                }
                return response.json();
            })
            .then(data => {
                this.$emit('contact-deleted');
            })
            .catch(error => {
                console.error(error);
            });
    }
  },
};
</script>

<style scoped>

.show_modal{
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    z-index: 9999; 
}

.close_modal{
    position: relative;
    bottom: 135px;
    left: 441px;
    width: 71px;
    height: 55px;
    border-radius: 50px;
    text-align: center;
    font-size: xx-large;
    color: var(--lines-dark);
    background-color: var(--main-green);
    padding-top: 4px;
}
.close_modal:hover{
    transform: scale(1.09);
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0);
    background-color: var(--main-green-hover);
}
.section_show{
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 480px;
    height: 280px;
    background-color: var(--dark-grey);
    margin: 20px 30px;
    border-radius: 5px;
  }
  
  .section_show > .contact_profile{
    width: 40%;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: var(--main-green);
  }

  .profile_name{
    font-size:x-large;
  }
  .section_show > .contact_info{
    width: 65%;
    height: 30%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    
  }
  
  .contact_info > p {
    width: 100%;
    margin-bottom: 9px;
    font-size:medium;
    color: var(--medium-grey);
    font-weight: 500;
  }
  
  .contact_info > span {
    color: var(--main-green);
    font-size: large;
    margin-bottom: 2px;
  }
  
  .section_show > div>  img{
    width: 120px;
    height: 120px;
    border-radius: 20px;
    padding: 2px;
    border: var(--main-green-hover) 2px solid;
    margin-bottom: 10px;
  }
  
  .group_buttons{
    width: 85%;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 10px;
  }
  
  .group_buttons >  .button{
    all: unset;
    width: 100%;
    height: 100%;
    background-color: var(--main-green);
    cursor: pointer;
    text-align: center;
    border-radius: 4px;
    margin-right: 7px;
    padding: 3px;
  }
  
  .button:hover{
    transform: scale(1.09);
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0);
    background-color: var(--main-green-hover);
  }

  @media only screen and (max-width: 700px) {
    .section_show > .contact_profile{
      width: 35%;
      margin-right: 20px;
    }
    .section_show{
      margin: 10px 30px;
    }

    .close_modal{
      position: relative;
      bottom: 138px;
      left: 330px;
      width: 75px;
      height: 51px;
      border-radius: 50px;
      text-align: center;
      font-size: xx-large;
      color: var(--lines-dark);
      background-color: var(--main-green);
      padding-top: 4px;
  }
  }

</style>
