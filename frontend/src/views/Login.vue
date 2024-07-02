<template>
    <main>
        <section>
            <div class="logo">Logo</div>
                <div class="input">
                    <div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                            <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        
                        <div class="forgot"><p>Esqueceu sua senha?</p></div>
                        <button type="button" class="btn btn-primary">Entrar</button>

                    </div>
                </div>
        </section>
    </main>
</template>
<script ></script>

<style>
main {
    background-color: #F6F9FE;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
}

section {
    background-color: rgb(255, 255, 255);
    width: 45vw;
    height: 70vh;
    border-radius: 5px;
    box-shadow: 
            5px 5px 20px rgba(0, 0, 0, 0.055), /* sombra direita e inferior */
            -5px -5px 20px rgba(0, 0, 0, 0.048); /* sombra esquerda e superior */
        padding: 15px; /* opcional: adiciona espaço interno */
}

.logo {
    height: 30vh;
    background: red;
}
.input {
    height: 40vh;
    padding-top: 2em;

    display: flex;
    justify-content: center;
}

#floatingInput, #floatingPassword{
    height: 1vh;
    width: 30vw;
    min-height: 30px;
    border-radius: 5px;
    border: 1px solid lightgrey
}



.form-floating > label {
    padding: 0px;
    padding-top: 8px;
    font-size: 12px;
    padding-left: 10px;
    color: grey;
}

.forgot p {
    margin-top: 5px;
    font-size: 13px;
    color: grey
}

button {
    width: 30vw;
    margin-top: 1em;
}

.form-control:focus {
      border-color: #ced4da; /* cor padrão da borda focada do Bootstrap */
      box-shadow: none; /* remover sombra ao focar */
    }
</style>