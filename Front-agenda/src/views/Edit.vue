<template>
    <div class="container">
        <Header/>
        <h1 @click="teste" class="title">Editando contato: {{this.selectedContact.name}}</h1>
        <div class="container_form">
            <form action="/contatos" method="" @submit="updateContact" enctype="multipart/form-data">
                <div class="form__group field">
                    <input class="form__field" type="text" id="name" name="name" placeholder="Nome"  v-model="this.selectedContact.name" require>
                    <label class="edit_label form__label"  for="name">Nome</label>
                    <span class="edit_span"></span>
                </div>
        
                <div class="form__group field">
                    <input class="form__field" type="email" id="email" name="email" placeholder="E-mail" v-model="this.selectedContact.email" require>
                    <label class="edit_label form__label" for="email">E-mail:</label>
                    <span class="edit_span"></span>
                </div>
        
                <div class="form__group field">
                    <input class="form__field" type="text" id="number" name="number" placeholder="(00) 0 00000000" v-model="this.selectedContact.number" require>
                    <label class="edit_label form__label" for="number">Número:</label>
                    <span class="edit_span"></span>
                </div>
        
                <div class="form__group field" id="photo">
                    <input class="form__field" type="file" name="image" id="image" @change=" onFileSelected" require>
                    <label class="edit_label form__label" for="image">Adicione sua foto</label>
                    <span class="edit_span"></span>
                </div>
                <button class="button_submit" type="submit">Atualizar</button>
              </form>
          </div>
    </div>
    
</template>

<script>
import Header from "../components/Header.vue";
import Form from "../components/Form.vue";

export default{
    name: 'Edit',
    components: {
        Header,
        Form
    },
    props: {
        selectedContact: {
            type: Object,
            required: true,
        }
    },
    created() {
        this.selectedContact = JSON.parse(this.$route.params.selectedContact)
    },
    data(){
        return{
            selectedContact: {},
            name: '',
            email: '',
            number: '',
            image: ''
        }
    },
    methods:{
        onFileSelected(event) {
            const file = event.target.files[0]
            this.selectedContact.image = file

        },
        async updateContact(e){
            e.preventDefault()
            const formData = new FormData();
            formData.append("id", this.selectedContact.id);
            formData.append("name", this.selectedContact.name);
            formData.append("email", this.selectedContact.email);
            formData.append("number", this.selectedContact.number);
            formData.append("image", this.selectedContact.image);
    
            
            try {

                // const response = await fetch(`http://127.0.0.1:8000/api/contatos/${this.selectedContact.id}`, {
                //     method: "PUT",
                //     headers: {'Content-Type': 'application/json'
                //     },
                //     body: formData
                // });
                // const responseData = await response.json();



                const responseDelete = await fetch(`http://127.0.0.1:8000/api/contatos/${this.selectedContact.id}`,{
                    method: 'DELETE',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                })

                const responsePost = await fetch(`http://127.0.0.1:8000/api/contatos/adicionar`,{
                    method: "POST",
                    body: formData,
                })
                const response = await responsePost.json();
                console.log(response)
                history.replaceState(null, null, '/')
                this.$router.replace('/')
                
            } catch (error) {
                console.error(error)
            }
        },
    },
}
</script>

<style scoped>

.container{
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100vh;
    background-color: var(--very-dark-grey);
}
.title{
    width: 100%;
    text-align: center;
    color: var(--main-green);
    font-weight: 700;
    padding-top: 40px;
  }

  .container_form{
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100vw;
    height: 100vh;
    background-color: var(--very-dark-grey);
    color: var(--white);
    padding-top: 40px;
}
.container_form > form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 30%;
    background-color: var(--dark-grey);
    border-radius: 5px;
    padding: 20px 0px;
}

.form__group {
    position: relative;
    padding: 15px 0 0;
    margin-top: 20px;
    width: 50%;
    height: 40px;
    margin-bottom: 12px;
}
  
.form__field {
    font-family: inherit;
    width: 100%;
    border: 0;
    border-bottom: 2px solid #9b9b9b;
    outline: 0;
    font-size:medium;
    color: #fff;
    padding: 7px 0;
    background: transparent;
    transition: border-color 0.2s;
}

.form__field::placeholder {
    color: transparent;
}

.form__field:placeholder-shown ~ .form__label {
    font-size:medium;
    cursor: text;
    top: 20px;
}
  
.form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size:medium;
    color: #9b9b9b;
}
  
.form__field:focus {
    padding-bottom: 6px;
    font-weight: 700;
    border-width: 2px;
    border-image: linear-gradient(to right, #11998e, #38ef7d);
    border-image-slice: 1;
}

.form__field:focus ~ .form__label {
    position: absolute;
    top: 0;
    display: block;
    transition: 0.2s;
    font-size:medium;
    color: #11998e;
    font-weight: 700;
}
  

.form__field:required, .form__field:invalid {
    box-shadow: none;
}

.button_submit{
    width: 45%;
    height: 30px;
    background-color: var(--main-green);
    cursor: pointer;
    font-size:medium;
    font-weight: 500;
    text-align: center;
    border-radius: 4px;
    margin: 30px 0px; 
    padding: 3px;
}

.button_submit:hover{
    color: var(--lines-light);
    background-color:var(--main-green-hover);
}

 /* Form */

 @media only screen and (max-width: 700px) {
    .container_form > form{
        width: 90%;
    }
    
  }
</style>