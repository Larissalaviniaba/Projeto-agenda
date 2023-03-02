<template>
    <div class="container_form">
        <form @submit.prevent="submitForm()">
            <div class="form__group field">
                <input 
                class="form__field" 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Nome"  
                :value="name"
                @change="updateName($event.target.value)"
                >
                <label class="form_label form__label"  for="name">Nome</label>
                <span class="form_span"></span>
            </div>
    
            <div class="form__group field">
                <input 
                class="form__field" 
                type="email" 
                id="email" 
                name="email" 
                placeholder="E-mail"  
                :value="email"
                @change="updateEmail($event.target.value)"
                >
                <label class="form_label form__label" for="email">E-mail:</label>
                <span class="form_span"></span>
            </div>
    
            <div class="form__group field">
                <input 
                class="form__field" 
                type="text" 
                id="number" 
                name="number" 
                placeholder="(00) 0 00000000" 
                :value="number"
                @change="updateNumber($event.target.value)"
                >
                <label class="form_label form__label" for="number">Número:</label>
                <span class="form_span"></span>
            </div>
    
            <div class="form__group field" id="photo">
                <input 
                class="form__field"  
                type="file" 
                name="image" 
                id="image"
                :value="image"
                @change="updateImage($event.target.value)"
                >
                <label class="form_label form__label" for="image">Adicione sua foto</label>
                <span class="form_span"></span>
            </div>
            <button class="button_submit" type="submit">{{button}}</button>
        </form>
    </div>
</template>

<script>
export default {
    name:'Form',
    props: {
        button: String,
        name: {
            type:String
        },
        email: {
            type: String
        },
        number: {
            type: String
        },
        image: {
        type: File

        },
    },
    data(){
        return{
    
        }
    },
    methods:{
         updateName(value) {
            this.$emit('update:name', value);
        },
        updateEmail(value) {
            this.$emit('update:email', value);
        },
        updateNumber(value) {
            this.$emit('update:number', value);
        },
        updateImage(value) {
            this.$emit('update:image', value);
        },
        submitForm() {
            console.log(this.form.name)
            const formData = new FormData();
            // formData.append("name", this.form.name);
            // formData.append("email", this.form.email);
            // formData.append("number", this.form.number);
            // formData.append("image", this.form.image);
            // this.$emit("formSubmitted", formData);
            },
    },
    computed: {
    
        formData: {
        get() {
            return {
                name: this.name,
                email: this.email,
                number: this.number,
                image: this.image
            };
        },
            set(formData) {
            this.$emit("update:name", formData.name);
            this.$emit("update:email", formData.email);
            this.$emit("update:number", formData.number);
            this.$emit("update:image", formData.image);
            }
        }
    }
}
</script>

<style scoped>

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
</style>