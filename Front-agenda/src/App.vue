<template>
  <div>
    <router-view/>
  </div>
</template>

<style>

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700&display=swap');

*{
    display: 0px;
    margin: 0px;
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', 'open sans';
}

a, button{
    all: unset;
    cursor: pointer;
}

:root{
    --black:black;
    --very-dark-grey:#20212C;
    --dark-grey:#2B2C37;
    --lines-dark:#3E3F4E;
    --medium-grey:#828FA3;
    --lines-light:#E4EBFA;
    --light-grey:#F4F7FD;
    --white:white;
    --main-green:#00875F;
    --main-green-hover: #00B37E;
}

.container{
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 100vh;
  background-color: var(--very-dark-grey);
  padding-bottom: 30px;
}

.hover:hover {
    
  transform: scale(1.1);
  box-shadow: 0 5px 5px rgba(0, 0, 0, 0);
}

</style>
