<template>
    <header class="header_welcome">
        <router-link to="/" class="link_welcome"><p class="logo_title">MY Agenda</p></router-link>
        <router-link to="/adicionar" class="link_welcome"><i class="add ph-3x hover ph-user-circle-plus ph-xl hover"></i></router-link>
    </header>
</template>

<script>

export default{
    name: 'Header',
}

</script>

<style scoped>
.header_welcome {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--dark-grey);
    height: 80px;
    padding: 20px 50px 20px 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .logo_title {
    font-size: 24px;
    font-weight: bold;
    color: var(--main-green);
    margin: 0;
  }
  
  .link_welcome {
    text-decoration: none;
  }
  
  .link_welcome:hover .logo_title {
    color: var(--main-green-hover);
  }

  .add{
    color: var(--main-green);
  }

  @media only screen and (max-width: 700px) {

    .header_welcome {
      padding: 20px 20px 20px 20px;
    }
    
  }
</style>